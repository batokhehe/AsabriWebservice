<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_kota';
    protected $primaryKey       = 'kota_id';
    protected $uniqueCode       = 'kota_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kota_id',
        'kota_unique_code',
        'nama_kota',
        'kode_kota',
        'deskripsi',
        'provinsi_id',
        'nama_provinsi',
        'provinsi_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'kantor_cabang_unique_code',
        'kode_kantor_cabang',
        'kode_kppn',
        'kode_provinsi',
        'other_kode_kota',
        'other_kode_provinsi',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'kota_unique_code' => 'required',
        'nama_kota'        => 'required',
        'kode_kota'        => 'required',
        'deskripsi'        => 'required',
        'provinsi_id'      => 'required|is_provinsi_exists[provinsi_id]',
        'other_kode_kota'  => 'required',
    ];
    protected $validationMessages = [
        'kota_unique_code' => [
            'required' => 'Kode Unik Kota is required',
        ],
        'nama_kota'        => [
            'required' => 'Nama Kota is required',
        ],
        'kode_kota'        => [
            'required' => 'Kode Kota is required',
        ],
        'deskripsi'        => [
            'required' => 'Deskripsi Kota is required',
        ],
        'provinsi_id'      => [
            'required'           => 'Provinsi is required',
            'is_provinsi_exists' => 'Provinsi is not exists',
        ],
        'other_kode_kota'  => [
            'required' => 'Kode Lain Kota is required',
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
        $model = new KotaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KotaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $provinsi = ProvinsiModel::findById($request->getVar('provinsi_id'));

        return $model->insert([
            $model->primaryKey     => $model->getAvailableId($model),
            'kota_unique_code'     => $request->getVar('kota_unique_code'),
            'nama_kota'            => $request->getVar('nama_kota'),
            'kode_kota'            => $request->getVar('kode_kota'),
            'deskripsi'            => $request->getVar('deskripsi'),
            'provinsi_id'          => $request->getVar('provinsi_id'),
            'nama_provinsi'        => $provinsi['nama_provinsi'],
            'provinsi_unique_code' => $provinsi['provinsi_unique_code'],
            'other_kode_kota'      => $request->getVar('other_kode_kota'),
            'created_by'           => $user->data->email,
            'created_date'         => date('Y-m-d H:i:s'),
            'deleted_status'       => 0,
            'other_kode_provinsi'  => $request->getVar('other_kode_provinsi'),
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $provinsi = ProvinsiModel::findById($request->getVar('provinsi_id'));

        return $model->update($id, [
            'kota_unique_code'     => $request->getVar('kota_unique_code'),
            'nama_kota'            => $request->getVar('nama_kota'),
            'kode_kota'            => $request->getVar('kode_kota'),
            'deskripsi'            => $request->getVar('deskripsi'),
            'provinsi_id'          => $request->getVar('provinsi_id'),
            'nama_provinsi'        => $provinsi['nama_provinsi'],
            'provinsi_unique_code' => $provinsi['provinsi_unique_code'],
            'other_kode_kota'      => $request->getVar('other_kode_kota'),
            'last_update_by'       => $user->data->email,
            'last_update_date'     => date('Y-m-d H:i:s'),
            'other_kode_provinsi'  => $request->getVar('other_kode_provinsi'),
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
