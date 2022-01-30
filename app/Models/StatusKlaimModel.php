<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusKlaimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_status_klaim';
    protected $primaryKey       = 'status_klaim_id';
    protected $uniqueCode       = 'status_klaim_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_klaim_id',
        'status_klaim_unique_code',
        'nama_status_klaim',
        'kode_status_klaim',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_date',
        'last_update_by',
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
    protected $validationRules = [
        'nama_status_klaim'        => 'required',
        'kode_status_klaim'        => 'required',
        'status_klaim_unique_code' => 'required',
        'deskripsi'                => 'required',
    ];
    protected $validationMessages = [
        'nama_status_klaim'        => [
            'required' => 'Nama Status Klaim is required',
        ],
        'kode_status_klaim'        => [
            'required' => 'Kode Status Klaim is required',
        ],
        'status_klaim_unique_code' => [
            'required' => 'Kode Unik Status Klaim is required',
        ],
        'deskripsi'                => [
            'required' => 'Deskripsi Status Klaim is required',
        ],
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

    public static function getAll()
    {
        $model = new StatusKlaimModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new StatusKlaimModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey         => $model->getAvailableId($model),
            'status_klaim_unique_code' => $request->getVar('status_klaim_unique_code'),
            'nama_status_klaim'        => $request->getVar('nama_status_klaim'),
            'kode_status_klaim'        => $request->getVar('kode_status_klaim'),
            'deskripsi'                => $request->getVar('deskripsi'),

            'created_by'               => $user->data->email,
            'created_date'             => date('Y-m-d H:i:s'),
            'deleted_status'           => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'status_klaim_unique_code' => $request->getVar('status_klaim_unique_code'),
            'nama_status_klaim'        => $request->getVar('nama_status_klaim'),
            'kode_status_klaim'        => $request->getVar('kode_status_klaim'),
            'deskripsi'                => $request->getVar('deskripsi'),

            'last_update_by'           => $user->data->email,
            'last_update_date'         => date('Y-m-d H:i:s'),
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
