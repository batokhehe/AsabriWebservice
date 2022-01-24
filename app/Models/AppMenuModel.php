<?php

namespace App\Models;

use CodeIgniter\Model;

class AppMenuModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_app_menu';
    protected $primaryKey       ='app_menu_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'app_menu_id',
        'app_menu_unique_code',
        'kode_app_menu',
        'nama_app_menu',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_by',
        'deleted_date',
        'deleted_status',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'app_menu_unique_code'=>'required',
        'kode_app_menu'=>'required',
        'nama_app_menu'=>'required',

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
        $model = new AppMenuModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new AppMenuModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'app_menu_unique_code'=> $request->getVar('app_menu_unique_code'),
            'kode_app_menu'=> $request->getVar('kode_app_menu'),
            'nama_app_menu'=> $request->getVar('nama_app_menu'),


            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'app_menu_unique_code'=> $request->getVar('app_menu_unique_code'),
            'kode_app_menu'=> $request->getVar('kode_app_menu'),
            'nama_app_menu'=> $request->getVar('nama_app_menu'),

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
