<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_status_peserta';
    protected $primaryKey       = 'status_peserta_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_peserta_id',
        'status_peserta_unique_code',
        'nam_status_peserta',
        'kode_status_peserta',
        'keterangan',
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
        $model = new StatusPesertaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new StatusPesertaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new StatusPesertaModel();
        return $model->insert([
            'status_peserta_unique_code' => $request->getVar('status_peserta_unique_code'),
            'nama_status_peserta' => $request->getVar('nama_status_peserta'),
            'kode_status_peserta' => $request->getVar('kode_status_peserta'),
            'keterangan' => $request->getVar('keterangan'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new StatusPesertaModel();
        return $model->update($id, [
            'status_peserta_unique_code' => $request->getVar('status_peserta_unique_code'),
            'nama_status_peserta' => $request->getVar('nama_status_peserta'),
            'kode_status_peserta' => $request->getVar('kode_status_peserta'),
            'keterangan' => $request->getVar('keterangan'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new StatusPesertaModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
