<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_produk';
    protected $primaryKey       = 'jenis_produk_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_produk_id',
        'jenis_produk_unique_code',
        'nam_jenis_produk',
        'kode_jenis_produk',
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
        $model = new JenisProdukModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisProdukModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new JenisProdukModel();
        return $model->insert([
            'jenis_produk_unique_code' => $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk' => $request->getVar('nama_jenis_produk'),
            'kode_jenis_produk' => $request->getVar('kode_jenis_produk'),
            'deskripsi' => $request->getVar('deskripsi'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new JenisProdukModel();
        return $model->update($id, [
            'jenis_produk_unique_code' => $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk' => $request->getVar('nama_jenis_produk'),
            'kode_jenis_produk' => $request->getVar('kode_jenis_produk'),
            'deskripsi' => $request->getVar('deskripsi'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new JenisProdukModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
