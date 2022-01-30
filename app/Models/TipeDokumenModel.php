<?php

namespace App\Models;

use CodeIgniter\Model;

class TipeDokumenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_tipe_dokumen';
    protected $primaryKey       = 'tipe_dokumen_id';
    protected $uniqueCode       = 'tipe_dokumen_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tipe_dokumen_id',
        'tipe_dokumen_unique_code',
        'nama_tipe_dokumen',
        'kode_tipe_dokumen',
        'deskripsi',
        'status',
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
        'nama_tipe_dokumen'        => 'required',
        'kode_tipe_dokumen'        => 'required',
        'tipe_dokumen_unique_code' => 'required',
        'deskripsi'                => 'required',
        'status'                   => 'required',
    ];
    protected $validationMessages = [
        'nama_tipe_dokumen'        => [
            'required' => 'Nama Tipe Dokumen is required',
        ],
        'kode_tipe_dokumen'        => [
            'required' => 'Kode Tipe Dokumen is required',
        ],
        'tipe_dokumen_unique_code' => [
            'required' => 'Kode Unik Tipe Dokumen is required',
        ],
        'deskripsi'                => [
            'required' => 'Deskripsi Tipe Dokumen is required',
        ],
        'status'                   => [
            'required' => 'Status Tipe Dokumen is required',
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
        $model = new TipeDokumenModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new TipeDokumenModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey         => $model->getAvailableId($model),
            'tipe_dokumen_unique_code' => $request->getVar('tipe_dokumen_unique_code'),
            'nama_tipe_dokumen'        => $request->getVar('nama_tipe_dokumen'),
            'kode_tipe_dokumen'        => $request->getVar('kode_tipe_dokumen'),
            'deskripsi'                => $request->getVar('deskripsi'),
            'status'                   => $request->getVar('status'),

            'created_by'               => $user->data->email,
            'created_date'             => date('Y-m-d H:i:s'),
            'deleted_status'           => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'tipe_dokumen_unique_code' => $request->getVar('tipe_dokumen_unique_code'),
            'nama_tipe_dokumen'        => $request->getVar('nama_tipe_dokumen'),
            'kode_tipe_dokumen'        => $request->getVar('kode_tipe_dokumen'),
            'deskripsi'                => $request->getVar('deskripsi'),
            'status'                   => $request->getVar('status'),

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
