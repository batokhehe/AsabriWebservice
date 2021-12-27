<?php

namespace App\Models;

use CodeIgniter\Model;

class TipePembayaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_tipe_pembayaran';
    protected $primaryKey       = 'tipe_pembayaran_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tipe_pembayaran_id',
        'tipe_pembayaran_unique_code',
        'nama_tipe_pembayaran',
        'kode_tipe_pembayaran',
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
        'nama_tipe_pembayaran' => 'required', 
        'kode_tipe_pembayaran' => 'required',
        'tipe_pembayaran_unique_code' => 'required|is_unique[ref_tipe_pembayaran.tipe_pembayaran_unique_code]',
        'deskripsi' => 'required',
    ];
    protected $validationMessages   = [
        'nama_tipe_pembayaran' => [
            'required' => 'Nama Tipe Pembayaran is required'
        ],
        'kode_tipe_pembayaran' => [
            'required' => 'Kode Tipe Pembayaran is required',
        ],
        'tipe_pembayaran_unique_code' => [
            'required' => 'Kode Unik Tipe Pembayaran is required'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Tipe Pembayaran is required'
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
        $model = new TipePembayaranModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new TipePembayaranModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'tipe_pembayaran_unique_code' => $request->getVar('tipe_pembayaran_unique_code'),
            'nama_tipe_pembayaran' => $request->getVar('nama_tipe_pembayaran'),
            'kode_tipe_pembayaran' => $request->getVar('kode_tipe_pembayaran'),
            'deskripsi' => $request->getVar('deskripsi'),

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'tipe_pembayaran_unique_code' => $request->getVar('tipe_pembayaran_unique_code'),
            'nama_tipe_pembayaran' => $request->getVar('nama_tipe_pembayaran'),
            'kode_tipe_pembayaran' => $request->getVar('kode_tipe_pembayaran'),
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
