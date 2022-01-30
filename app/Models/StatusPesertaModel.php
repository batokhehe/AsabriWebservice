<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_status_peserta';
    protected $primaryKey       = 'status_peserta_id';
    protected $uniqueCode       = 'status_peserta_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_peserta_id',
        'status_peserta_unique_code',
        'nama_status_peserta',
        'kode_status_peserta',
        'keterangan',
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
        'nama_status_peserta'        => 'required',
        'kode_status_peserta'        => 'required',
        'status_peserta_unique_code' => 'required',
        'keterangan'                 => 'required',
    ];
    protected $validationMessages = [
        'nama_status_peserta'        => [
            'required' => 'Nama Status Peserta is required',
        ],
        'kode_status_peserta'        => [
            'required' => 'Kode Status Peserta is required',
        ],
        'status_peserta_unique_code' => [
            'required' => 'Kode Unik Status Peserta is required',
        ],
        'keterangan'                 => [
            'required' => 'Keterangan Status Peserta is required',
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
        $model = new StatusPesertaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new StatusPesertaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey           => $model->getAvailableId($model),
            'status_peserta_unique_code' => $request->getVar('status_peserta_unique_code'),
            'nama_status_peserta'        => $request->getVar('nama_status_peserta'),
            'kode_status_peserta'        => $request->getVar('kode_status_peserta'),
            'keterangan'                 => $request->getVar('keterangan'),

            'created_by'                 => $user->data->email,
            'created_date'               => date('Y-m-d H:i:s'),
            'deleted_status'             => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'status_peserta_unique_code' => $request->getVar('status_peserta_unique_code'),
            'nama_status_peserta'        => $request->getVar('nama_status_peserta'),
            'kode_status_peserta'        => $request->getVar('kode_status_peserta'),
            'keterangan'                 => $request->getVar('keterangan'),

            'last_update_by'             => $user->data->email,
            'last_update_date'           => date('Y-m-d H:i:s'),
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
