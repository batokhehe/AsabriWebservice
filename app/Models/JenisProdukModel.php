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
        'nama_jenis_produk',
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
    protected $validationRules      = [
        'nama_jenis_produk' => 'required', 
        'kode_jenis_produk' => 'required',
        'jenis_produk_unique_code' => 'required|is_unique[ref_jenis_produk.jenis_produk_unique_code]',
        'deskripsi' => 'required',
    ];
    protected $validationMessages   = [
        'nama_jenis_produk' => [
            'required' => 'Nama Jenis Produk is required'
        ],
        'kode_jenis_produk' => [
            'required' => 'Kode Jenis Produk is required',
        ],
        'jenis_produk_unique_code' => [
            'required' => 'Kode Unik Jenis Produk is required'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Jenis Produk is required'
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
        $model = new JenisProdukModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisProdukModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'jenis_produk_unique_code' => $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk' => $request->getVar('nama_jenis_produk'),
            'kode_jenis_produk' => $request->getVar('kode_jenis_produk'),
            'deskripsi' => $request->getVar('deskripsi'),

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'jenis_produk_unique_code' => $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk' => $request->getVar('nama_jenis_produk'),
            'kode_jenis_produk' => $request->getVar('kode_jenis_produk'),
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
