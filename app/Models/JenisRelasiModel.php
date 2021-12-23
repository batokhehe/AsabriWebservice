<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRelasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_relasi';
    protected $primaryKey       = 'jenis_relasi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_relasi_id',
        'jenis_relasi_unique_code',
        'nama_jenis_relasi',
        'kode_jenis_relasi',
        'kode_jiwa',
        'deskripsi',
        'status',
        'created_by',
        'created_date',
        'last_update_date',
        'last_update_by',
        'deleted_status',
        'deleted_by',
        'deleted_date'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'last_update_date';
    protected $deletedField  = 'deleted_date';

    // Validation
    protected $validationRules      = [ 
        'nama_jenis_relasi' => 'required', 
        'kode_jenis_relasi' => 'required',
        'jenis_relasi_unique_code' => 'required|is_unique[ref_jenis_relasi.jenis_relasi_unique_code]',
        'kode_jiwa' => 'required',
        'deskripsi' => 'required',
        'status' => 'required'
    ];
    protected $validationMessages   = [
        'nama_jenis_relasi' => [
            'required' => 'Nama Jenis Relasi is required'
        ],
        'kode_jenis_relasi' => [
            'required' => 'Kode Jenis Relasi is required',
        ],
        'jenis_relasi_unique_code' => [
            'required' => 'Kode Unik Jenis Relasi is required'
        ],
        'kode_jiwa' => [
            'required' => 'Kode Jiwa Jenis Relasi is required'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Jenis Relasi is required'
        ],
        'status' => [
            'required' => 'Status Jenis Relasi is required'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

     public static function getAll(){
        $model = new JenisRelasiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisRelasiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'jenis_relasi_unique_code' => $request->getVar('jenis_relasi_unique_code'),
            'nama_jenis_relasi' => $request->getVar('nama_jenis_relasi'),
            'kode_jenis_relasi' => $request->getVar('kode_jenis_relasi'),
            'kode_jiwa' => $request->getVar('kode_jiwa'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            
            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'jenis_relasi_unique_code' => $request->getVar('jenis_relasi_unique_code'),
            'nama_jenis_relasi' => $request->getVar('nama_jenis_relasi'),
            'kode_jenis_relasi' => $request->getVar('kode_jenis_relasi'),
            'kode_jiwa' => $request->getVar('kode_jiwa'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            
            'last_update_by' => $user->data->email, 
            'last_update_date' => date('Y-m-d H:i:s'),
        ]);
    }

     public static function softDelete($id, $model, $user){
        return $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }

    public function getAvailableId($model){
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }

}
