<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_user_menu';
    protected $primaryKey       = 'user_menu_id';
    protected $uniqueCode       = 'user_menu_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_menu_id',
        'user_menu_unique_code',
        'kode_user_menu',
        'user_id',
        'user_login',
        'nama_user',
        'app_menu_id',
        'nama_app_menu',
        'created_by',
        'created_date',
        'last_udpate_by',
        'last_update_date',
        'deleted_by',
        'deleted_date',
        'deleted_status',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'user_menu_unique_code' => 'required',
        'kode_user_menu'        => 'required',
        'user_id'               => 'required|is_user_exists[user_id]',
        'app_menu_id'           => 'required|is_app_menu_exists[app_menu_id]',

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

    public static function getAll()
    {
        $model = new UserMenuModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new UserMenuModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $UserModel    = UserModel::findById($request->getVar('user_id'));
        $appMenu = AppMenuModel::findById($request->getVar('app_menu_id'));

        return $model->insert([
            $model->primaryKey      => $model->getAvailableId($model),
            'user_menu_unique_code' => $request->getVar('user_menu_unique_code'),
            'kode_user_menu'        => $request->getVar('kode_user_menu'),
            'user_id'               => $request->getVar('user_id'),
            'user_login'            => $UserModel['user_login'],
            'nama_user'             => $UserModel['nama_user'],
            'app_menu_id'           => $request->getVar('app_menu_id'),
            'nama_app_menu'         => $appMenu['nama_app_menu'],

            'created_by'            => $user->data->email,
            'created_date'          => date('Y-m-d H:i:s'),
            'deleted_status'        => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $UserModel    = UserModel::findById($request->getVar('user_id'));
        $appMenu = AppMenuModel::findById($request->getVar('app_menu_id'));

        return $model->update($id, [
            'user_menu_unique_code' => $request->getVar('user_menu_unique_code'),
            'kode_user_menu'        => $request->getVar('kode_user_menu'),
            'user_id'               => $request->getVar('user_id'),
            'user_login'            => $UserModel['user_login'],
            'nama_user'             => $UserModel['nama_user'],
            'app_menu_id'           => $request->getVar('app_menu_id'),
            'nama_app_menu'         => $appMenu['nama_app_menu'],

            'last_update_by'        => $user->data->email,
            'last_update_date'      => date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user)
    {
        return $model->update($id, [
            'deleted_status' => 1,
            'deleted_by'     => $user->data->email,
            'deleted_date'   => date('Y-m-d H:i:s'),
        ]);
    }

    public function getAvailableId($model)
    {
        $result = $model->orderBy($model->primaryKey, 'ASC')->findColumn($model->primaryKey);
        if (!empty($result) > 0) {
            return $result[count($result) - 1] + 1;
        } else {
            return 1;
        }

    }

    public function isUniqueCode($model, $uniqueCode, $id)
    {
        $model->where($this->uniqueCode, $uniqueCode);
        if ($id != null) {
            $model->where($this->primaryKey . ' !=', $id);
        }
        $result = $model->findAll();
        return count($result);
    }
}
