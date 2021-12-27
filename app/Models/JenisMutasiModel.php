<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisMutasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_mutasi';
    protected $primaryKey       = 'jenis_mutasi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_mutasi_id',
        'jenis_mutasi_unique_code',
        'nama_jenis_mutasi',
        'kode_jenis_mutasi',
        'deskripsi',
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
        'nama_jenis_mutasi' => 'required', 
        'kode_jenis_mutasi' => 'required',
        'jenis_mutasi_unique_code' => 'required|is_unique[ref_jenis_mutasi.jenis_mutasi_unique_code]',
        'deskripsi' => 'required',
    ];
    protected $validationMessages   = [
        'nama_jenis_mutasi' => [
            'required' => 'Nama Jenis Mutasi is required'
        ],
        'kode_jenis_mutasi' => [
            'required' => 'Kode Jenis Mutasi is required',
        ],
        'jenis_mutasi_unique_code' => [
            'required' => 'Kode Unik Jenis Mutasi is required'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Jenis Mutasi is required'
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
        $model = new JenisMutasiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisMutasiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'jenis_mutasi_unique_code' => $request->getVar('jenis_mutasi_unique_code'),
            'nama_jenis_mutasi' => $request->getVar('nama_jenis_mutasi'),
            'kode_jenis_mutasi' => $request->getVar('kode_jenis_mutasi'),
            'deskripsi' => $request->getVar('deskripsi'),

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'jenis_mutasi_unique_code' => $request->getVar('jenis_mutasi_unique_code'),
            'nama_jenis_mutasi' => $request->getVar('nama_jenis_mutasi'),
            'kode_jenis_mutasi' => $request->getVar('kode_jenis_mutasi'),
            'deskripsi' => $request->getVar('deskripsi'),
            
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
