<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisKlaimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_klaim';
    protected $primaryKey       = 'jenis_klaim_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_klaim_id',
        'jenis_klaim_unique_code',
        'nama_jenis_klaim',
        'kode_jenis_klaim',
        'kode_pembayaran',
        'is_provider',
        'is_peserta',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
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
        $model = new JenisKlaimModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisKlaimModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new JenisKlaimModel();
        return $model->insert([
            'jenis_klaim_unique_code' => $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim' => $request->getVar('nama_jenis_klaim'),
            'kode_jenis_klaim' => $request->getVar('kode_jenis_klaim'),
            'kode_pembayaran' => $request->getVar('kode_pembayaran'),
            'is_provider' => $request->getVar('is_provider'),
            'is_peserta' => $request->getVar('is_peserta'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new JenisKlaimModel();
        return $model->update($id, [
            'jenis_klaim_unique_code' => $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim' => $request->getVar('nama_jenis_klaim'),
            'kode_jenis_klaim' => $request->getVar('kode_jenis_klaim'),
            'kode_pembayaran' => $request->getVar('kode_pembayaran'),
            'is_provider' => $request->getVar('is_provider'),
            'is_peserta' => $request->getVar('is_peserta'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new JenisKlaimModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
