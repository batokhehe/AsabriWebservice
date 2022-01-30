<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_pangkat';
    protected $primaryKey       = 'pangkat_id';
    protected $uniqueCode       = 'pangkat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pangkat_id',
        'pangkat_unique_code',
        'nama_pangkat',
        'kode_pangkat',
        'keterangan',
        'status',
        'kelompok_pangkat_id',
        'nama_kelompok_pangkat',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'kelompok_pangkat_unique_code',
        'unit_organisasi_id',
        'nama_unit_organisasi',
        'unit_organisasi_unique_code',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'pangkat_unique_code' => 'required',
        'nama_pangkat'        => 'required',
        'kode_pangkat'        => 'required',
        'keterangan'          => 'required',
        'status'              => 'required',
        'kelompok_pangkat_id' => 'required|is_kelompok_pangkat_exists[kelompok_pangkat_id]',
        'unit_organisasi_id'  => 'required|is_unit_organisasi_exists[unit_organisasi_id]',
    ];
    protected $validationMessages = [
        'pangkat_unique_code' => [
            'required' => 'Kode Pangkat is required',
        ],
        'nama_pangkat'        => [
            'required' => 'Nama Pangkat is required',
        ],
        'kode_pangkat'        => [
            'required' => 'Kode Pangkat is required',
        ],
        'keterangan'          => [
            'required' => 'Keterangan Pangkat is required',
        ],
        'status'              => [
            'required' => 'Status Pangkat is required',
        ],
        'kelompok_pangkat_id' => [
            'required' => 'Status Pangkat is required',
        ],
        'unit_organisasi_id'  => [
            'required'            => 'Unit Organisasi is required',
            'is_kelurahan_exists' => 'Unit Organisasi is not exists',
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
        $model = new PangkatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PangkatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelompokPangkat = KelompokPangkatModel::findById($request->getVar('kelompok_pangkat_id'));
        $unitOrganisasi  = UnitOrganisasiModel::findById($request->getVar('unit_organisasi_id'));

        return $model->insert([
            $model->primaryKey             => $model->getAvailableId($model),
            'pangkat_unique_code'          => $request->getVar('pangkat_unique_code'),
            'nama_pangkat'                 => $request->getVar('nama_pangkat'),
            'kode_pangkat'                 => $request->getVar('kode_pangkat'),
            'keterangan'                   => $request->getVar('keterangan'),
            'status'                       => $request->getVar('status'),
            'kelompok_pangkat_id'          => $request->getVar('kelompok_pangkat_id'),
            'nama_kelompok_pangkat'        => $kelompokPangkat['nama_kelompok_pangkat'],
            'kelompok_pangkat_unique_code' => $kelompokPangkat['kelompok_pangkat_unique_code'],

            'unit_organisasi_id'           => $request->getVar('unit_organisasi_id'),
            'nama_unit_organisasi'         => $unitOrganisasi['nama_unit_organisasi'],
            'unit_organisasi_unique_code'  => $unitOrganisasi['unit_organisasi_unique_code'],

            'created_by'                   => $user->data->email,
            'created_date'                 => date('Y-m-d H:i:s'),
            'deleted_status'               => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'pangkat_unique_code' => $request->getVar('pangkat_unique_code'),
            'nama_pangkat'        => $request->getVar('nama_pangkat'),
            'kode_pangkat'        => $request->getVar('kode_pangkat'),
            'keterangan'          => $request->getVar('keterangan'),
            'status'              => $request->getVar('status'),
            'kelompok_pangkat_id' => $request->getVar('kelompok_pangkat_id'),
            'kelompok_pangkat_id' => $request->getVar('kelompok_pangkat_id'),
            'unit_organisasi_id'  => $request->getVar('unit_organisasi_id'),

            'last_update_by'      => $user->data->email,
            'last_update_date'    => date('Y-m-d H:i:s'),
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
