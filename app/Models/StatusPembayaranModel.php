<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPembayaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_status_pembayaran';
    protected $primaryKey       = 'status_pembayaran_id';
    protected $uniqueCode       = 'status_pembayaran_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_pembayaran_id',
        'nama_status_pembayaran',
        'kode_status_pembayaran',
        'status_pembayaran_unique_code',
        'keterangan',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_by',
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
        'nama_status_pembayaran'        => 'required',
        'kode_status_pembayaran'        => 'required',
        'status_pembayaran_unique_code' => 'required',
        'keterangan'                    => 'required',

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
        $model = new StatusPembayaranModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new StatusPembayaranModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey              => $model->getAvailableId($model),
            'nama_status_pembayaran'        => $request->getVar('nama_status_pembayaran'),
            'kode_status_pembayaran'        => $request->getVar('kode_status_pembayaran'),
            'status_pembayaran_unique_code' => $request->getVar('status_pembayaran_unique_code'),
            'keterangan'                    => $request->getVar('keterangan'),

            'created_by'                    => $user->data->email,
            'created_date'                  => date('Y-m-d H:i:s'),
            'deleted_status'                => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'nama_status_pembayaran'        => $request->getVar('nama_status_pembayaran'),
            'kode_status_pembayaran'        => $request->getVar('kode_status_pembayaran'),
            'status_pembayaran_unique_code' => $request->getVar('status_pembayaran_unique_code'),
            'keterangan'                    => $request->getVar('keterangan'),

            'last_update_by'                => $user->data->email,
            'last_update_date'              => date('Y-m-d H:i:s'),
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
