<?php

namespace App\Models;

use CodeIgniter\Model;

class CacatTingkatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_cacat_tingkat';
    protected $primaryKey       = 'cacat_tingkat_id';
    protected $uniqueCode       = 'cacat_tingkat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cacat_tingkat_id',
        'cacat_tingkat_unique_code',
        'nama_cacat_tingkat',
        'kode_cacat_tingkat',
        'keterangan',
        'STATUS',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'cacat_tingkat_unique_code' => 'required',
        'nama_cacat_tingkat'        => 'required',
        'kode_cacat_tingkat'        => 'required',
        'keterangan'                => 'required',
        'STATUS'                    => 'required',
    ];
    protected $validationMessages = [
        'cacat_tingkat_unique_code' => [
            'required' => 'Kode Unik is required',
        ],
        'nama_cacat_tingkat'        => [
            'required' => 'Nama is required',
        ],
        'kode_cacat_tingkat'        => [
            'required' => 'Kode is required',
        ],
        'keterangan'                => [
            'required' => 'Keterangan is required',
        ],
        'STATUS'                    => [
            'required' => 'Status is required',
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
        $model = new CacatTingkatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new CacatTingkatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey          => $model->getAvailableId($model),
            'cacat_tingkat_unique_code' => $request->getVar('cacat_tingkat_unique_code'),
            'nama_cacat_tingkat'        => $request->getVar('nama_cacat_tingkat'),
            'kode_cacat_tingkat'        => $request->getVar('kode_cacat_tingkat'),
            'keterangan'                => $request->getVar('keterangan'),
            'STATUS'                    => $request->getVar('STATUS'),

            'created_by'                => $user->data->email,
            'created_date'              => date('Y-m-d H:i:s'),
            'deleted_status'            => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'cacat_tingkat_unique_code' => $request->getVar('cacat_tingkat_unique_code'),
            'nama_cacat_tingkat'        => $request->getVar('nama_cacat_tingkat'),
            'kode_cacat_tingkat'        => $request->getVar('kode_cacat_tingkat'),
            'keterangan'                => $request->getVar('keterangan'),
            'STATUS'                    => $request->getVar('STATUS'),

            'last_update_by'            => $user->data->email,
            'last_update_date'          => date('Y-m-d H:i:s'),
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
