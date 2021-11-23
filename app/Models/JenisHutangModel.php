<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisHutangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_hutang';
    protected $primaryKey       = 'jenis_hutang_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_hutang_id',
        'jenis_hutang_unique_code',
        'nama_jenis_hutang',
        'kode_jenis_hutang',
        'is_mitra',
        'is_product',
        'is_retur',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_dated',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'is_potongan_pesiun',
        'sort_number',
        'is_potongan_santunan',
        'dps_status'
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
        $model = new JenisHutangModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisHutangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new JenisHutangModel();
        return $model->insert([
            'jenis_hutang_unique_code' => $request->getVar('jenis_hutang_unique_code'),
            'nama_jenis_hutang' => $request->getVar('nama_jenis_hutang'),
            'kode_jenis_hutang' => $request->getVar('kode_jenis_hutang'),
            'kode_jenis_hutang' => $request->getVar(),
            'is_mitra' => $request->getVar('is_mitra'),
            'is_product' => $request->getVar('is_product'),
            'is_retur' => $request->getVar('is_retur'),
            'deskripsi' => $request->getVar('deskripsi'),
            'is_potongan_pesiun' => $request->getVar('is_potongan_pesiun'),
            'sort_number' => $request->getVar('sort_number'),
            'is_potongan_santunan' => $request->getVar('is_potongan_santunan'),
            'dps_status' => $request->getVar('dps_status'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new JenisHutangModel();
        return $model->update($id, [
            'jenis_hutang_unique_code' => $request->getVar('jenis_hutang_unique_code'),
            'nama_jenis_hutang' => $request->getVar('nama_jenis_hutang'),
            'kode_jenis_hutang' => $request->getVar('kode_jenis_hutang'),
            'is_mitra' => $request->getVar('is_mitra'),
            'is_product' => $request->getVar('is_product'),
            'is_retur' => $request->getVar('is_retur'),
            'deskripsi' => $request->getVar('deskripsi'),
            'is_potongan_pesiun' => $request->getVar('is_potongan_pesiun'),
            'sort_number' => $request->getVar('sort_number'),
            'is_potongan_santunan' => $request->getVar('is_potongan_santunan'),
            'dps_status' => $request->getVar('dps_status'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new JenisHutangModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
