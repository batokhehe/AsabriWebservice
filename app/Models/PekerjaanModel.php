<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_pekerjaan';
    protected $primaryKey       = 'pekerjaan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pekerjaan_id',
        'pekerjaan_unique_code',
        'nama_pekerjaan',
        'kode_pekerjaan',
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
    protected $validationRules      = [];
    protected $validationMessages   = [];
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
        $model = new PekerjaanModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new PekerjaanModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new PekerjaanModel();
        return $model->insert([
            'pekerjaan_unique_code' => $request->getVar('pekerjaan_unique_code'),
            'nama_pekerjaan' => $request->getVar('nama_pekerjaan'),
            'kode_pekerjaan' => $request->getVar('kode_pekerjaan'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new PekerjaanModel();
        return $model->update($id, [
            'pekerjaan_unique_code' => $request->getVar('pekerjaan_unique_code'),
            'nama_pekerjaan' => $request->getVar('nama_pekerjaan'),
            'kode_pekerjaan' => $request->getVar('kode_pekerjaan'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new PekerjaanModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
