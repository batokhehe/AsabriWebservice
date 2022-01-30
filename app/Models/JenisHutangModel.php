<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisHutangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_hutang';
    protected $primaryKey       = 'jenis_hutang_id';
    protected $uniqueCode       = 'jenis_hutang_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_hutang_id',
        'jenis_hutang_unique_code',
        'nama_jenis_hutang',
        'kode_jenis_hutang',
        'is_mitra',
        'is_product',
        'is_retur',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_dated',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'is_potongan_pensiun',
        'sort_number',
        'is_potongan_santunan',
        'dps_status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'last_update_date';
    protected $deletedField  = 'deleted_date';

    // Validation
    protected $validationRules = [
        'nama_jenis_hutang'        => 'required',
        'kode_jenis_hutang'        => 'required',
        'jenis_hutang_unique_code' => 'required',
        'is_mitra'                 => 'required',
        'is_product'               => 'required',
        'is_retur'                 => 'required',
        'deskripsi'                => 'required',
        'is_potongan_pensiun'      => 'required',
        'sort_number'              => 'required',
        'is_potongan_santunan'     => 'required',
        'dps_status'               => 'required',
    ];
    protected $validationMessages = [
        'nama_jenis_hutang'        => [
            'required' => 'Nama Jenis Hutang is required',
        ],
        'kode_jenis_hutang'        => [
            'required' => 'Kode Jenis Hutang is required',
        ],
        'jenis_hutang_unique_code' => [
            'required' => 'Kode Unik Jenis Hutang is required',
        ],
        'is_mitra'                 => [
            'required' => 'Is Mitra Jenis Hutang is required',
        ],
        'is_product'               => [
            'required' => 'Is Product Jenis Hutang is required',
        ],
        'deskripsi'                => [
            'required' => 'Deskripsi Jenis Hutang is required',
        ],
        'is_potongan_pensiun'      => [
            'required' => 'Is Potongan Pensiun Jenis Hutang is required',
        ],
        'sort_number'              => [
            'required' => 'Sort Number Jenis Hutang is required',
        ],
        'is_potongan_santunan'     => [
            'required' => 'Is Potongan Santunan Jenis Hutang is required',
        ],
        'dps_status'               => [
            'required' => 'DPS Status Jenis Hutang is required',
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
        $model = new JenisHutangModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new JenisHutangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey         => $model->getAvailableId($model),
            'jenis_hutang_unique_code' => $request->getVar('jenis_hutang_unique_code'),
            'nama_jenis_hutang'        => $request->getVar('nama_jenis_hutang'),
            'kode_jenis_hutang'        => $request->getVar('kode_jenis_hutang'),
            'is_mitra'                 => $request->getVar('is_mitra'),
            'is_product'               => $request->getVar('is_product'),
            'is_retur'                 => $request->getVar('is_retur'),
            'deskripsi'                => $request->getVar('deskripsi'),
            'is_potongan_pensiun'      => $request->getVar('is_potongan_pensiun'),
            'sort_number'              => $request->getVar('sort_number'),
            'is_potongan_santunan'     => $request->getVar('is_potongan_santunan'),
            'dps_status'               => $request->getVar('dps_status'),

            'created_by'               => $user->data->email,
            'created_date'             => date('Y-m-d H:i:s'),
            'deleted_status'           => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'jenis_hutang_unique_code' => $request->getVar('jenis_hutang_unique_code'),
            'nama_jenis_hutang'        => $request->getVar('nama_jenis_hutang'),
            'kode_jenis_hutang'        => $request->getVar('kode_jenis_hutang'),
            'is_mitra'                 => $request->getVar('is_mitra'),
            'is_product'               => $request->getVar('is_product'),
            'is_retur'                 => $request->getVar('is_retur'),
            'deskripsi'                => $request->getVar('deskripsi'),
            'is_potongan_pensiun'      => $request->getVar('is_potongan_pensiun'),
            'sort_number'              => $request->getVar('sort_number'),
            'is_potongan_santunan'     => $request->getVar('is_potongan_santunan'),
            'dps_status'               => $request->getVar('dps_status'),

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
