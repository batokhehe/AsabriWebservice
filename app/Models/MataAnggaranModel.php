<?php

namespace App\Models;

use CodeIgniter\Model;

class MataAnggaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_mata_anggaran';
    protected $primaryKey       = 'mata_anggaran_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'mata_anggaran_id',
        'mata_anggaran_unique_code',
        'nama_mata_anggaran',
        'kode_mata_anggaran',
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
        'nama_mata_anggaran' => 'required', 
        'kode_mata_anggaran' => 'required',
        'mata_anggaran_unique_code' => 'required|is_unique[ref_mata_anggaran.mata_anggaran_unique_code]',
        'deskripsi' => 'required',
    ];
    protected $validationMessages   = [
        'nama_mata_anggaran' => [
            'required' => 'Nama Mata Anggaran is required'
        ],
        'kode_mata_anggaran' => [
            'required' => 'Kode Mata Anggaran is required',
        ],
        'mata_anggaran_unique_code' => [
            'required' => 'Kode Unik Mata Anggaran is required'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Mata Anggaran is required'
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
        $model = new MataAnggaranModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new MataAnggaranModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'mata_anggaran_unique_code' => $request->getVar('mata_anggaran_unique_code'),
            'nama_mata_anggaran' => $request->getVar('nama_mata_anggaran'),
            'kode_mata_anggaran' => $request->getVar('kode_mata_anggaran'),
            'deskripsi' => $request->getVar('deskripsi'),

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'mata_anggaran_unique_code' => $request->getVar('mata_anggaran_unique_code'),
            'nama_mata_anggaran' => $request->getVar('nama_mata_anggaran'),
            'kode_mata_anggaran' => $request->getVar('kode_mata_anggaran'),
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
