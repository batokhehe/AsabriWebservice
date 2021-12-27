<?php

namespace App\Models;

use CodeIgniter\Model;

class GolonganPangkatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='ref_golongan_pangkat';
    protected $primaryKey       ='golongan_pangkat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'golongan_pangkat_id',
        'nama_golongan_pangkat',
        'kode_golongan_pangkat',
        'golongan_pangkat_unique_code',
        'keterangan',
        'status',
        'created_date',
        'created_by',
        'deleted_date',
        'deleted_by',
        'deleted_status',
        'last_update_date',
        'last_update_by',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_golongan_pangkat'=>'required',
        'kode_golongan_pangkat'=>'required',
        'golongan_pangkat_unique_code'=>'required',
        'keterangan'=>'required',
        'status'=>'required',

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
        $model = new GolonganPangkatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new GolonganPangkatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'nama_golongan_pangkat'=> $request->getVar('nama_golongan_pangkat'),
            'kode_golongan_pangkat'=> $request->getVar('kode_golongan_pangkat'),
            'golongan_pangkat_unique_code'=> $request->getVar('golongan_pangkat_unique_code'),
            'keterangan'=> $request->getVar('keterangan'),
            'status'=> $request->getVar('status'),


            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'nama_golongan_pangkat'=> $request->getVar('nama_golongan_pangkat'),
            'kode_golongan_pangkat'=> $request->getVar('kode_golongan_pangkat'),
            'golongan_pangkat_unique_code'=> $request->getVar('golongan_pangkat_unique_code'),
            'keterangan'=> $request->getVar('keterangan'),
            'status'=> $request->getVar('status'),
                
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
