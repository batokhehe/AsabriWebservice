<?php

namespace App\Models;

use CodeIgniter\Model;

class PendelegasianWewenangModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='ref_pendelegasian_wewenang';
    protected $primaryKey       ='pendelegasian_wewenang_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pendelegasian_wewenang_id',
        'nama_pendelegasian_wewenang',
        'kode_pendelegasian_wewenang',
        'pendelegasian_wewenang_unique_code',
        'keterangan',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_status',
        'deleted_by',
        'deleted_date',


    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_pendelegasian_wewenang'=>'required',
        'kode_pendelegasian_wewenang'=>'required',
        'pendelegasian_wewenang_unique_code'=>'required',
        'keterangan'=>'required',

    ];
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
        $model = new PendelegasianWewenangModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PendelegasianWewenangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'nama_pendelegasian_wewenang'=> $request->getVar('nama_pendelegasian_wewenang'),
            'kode_pendelegasian_wewenang'=> $request->getVar('kode_pendelegasian_wewenang'),
            'pendelegasian_wewenang_unique_code'=> $request->getVar('pendelegasian_wewenang_unique_code'),
            'keterangan'=> $request->getVar('keterangan'),

            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'nama_pendelegasian_wewenang'=> $request->getVar('nama_pendelegasian_wewenang'),
            'kode_pendelegasian_wewenang'=> $request->getVar('kode_pendelegasian_wewenang'),
            'pendelegasian_wewenang_unique_code'=> $request->getVar('pendelegasian_wewenang_unique_code'),
            'keterangan'=> $request->getVar('keterangan'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user){
        return $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
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
