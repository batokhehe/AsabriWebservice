<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisKlaimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_klaim';
    protected $primaryKey       = 'jenis_klaim_id';
    protected $uniqueCode        = 'jenis_klaim_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_klaim_id',
        'jenis_klaim_unique_code',
        'nama_jenis_klaim',
        'kode_jenis_klaim',
        'kode_pembayaran',
        'is_provider',
        'is_peserta',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
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
        'nama_jenis_klaim'        => 'required',
        'kode_jenis_klaim'        => 'required',
        'jenis_klaim_unique_code' => 'required',
        'deskripsi'               => 'required',
        'kode_pembayaran'         => 'required',
        'is_provider'             => 'required',
        'is_peserta'              => 'required',
    ];
    protected $validationMessages = [
        'nama_jenis_klaim'        => [
            'required' => 'Nama Jenis Klaim is required',
        ],
        'kode_jenis_klaim'        => [
            'required' => 'Kode Jenis Klaim is required',
        ],
        'jenis_klaim_unique_code' => [
            'required' => 'Kode Unik Jenis Klaim is required',
        ],
        'deskripsi'               => [
            'required' => 'Deskripsi Jenis Klaim is required',
        ],
        'kode_pemnbayaran'        => [
            'required' => 'Kode Pembayaran Jenis Klaim is required',
        ],
        'is_provider'             => [
            'required' => 'Is Provider Jenis Klaim is required',
        ],
        'is_peserta'              => [
            'required' => 'Is Peserta Jenis Klaim is required',
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
        $model = new JenisKlaimModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new JenisKlaimModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            'jenis_klaim_unique_code' => $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'        => $request->getVar('nama_jenis_klaim'),
            'kode_jenis_klaim'        => $request->getVar('kode_jenis_klaim'),
            'kode_pembayaran'         => $request->getVar('kode_pembayaran'),
            'is_provider'             => $request->getVar('is_provider'),
            'is_peserta'              => $request->getVar('is_peserta'),
            'deskripsi'               => $request->getVar('deskripsi'),

            'created_by'              => $user->data->email,
            'created_date'            => date('Y-m-d H:i:s'),
            'deleted_status'          => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'jenis_klaim_unique_code' => $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'        => $request->getVar('nama_jenis_klaim'),
            'kode_jenis_klaim'        => $request->getVar('kode_jenis_klaim'),
            'kode_pembayaran'         => $request->getVar('kode_pembayaran'),
            'is_provider'             => $request->getVar('is_provider'),
            'is_peserta'              => $request->getVar('is_peserta'),
            'deskripsi'               => $request->getVar('deskripsi'),

            'last_update_by'          => $user->data->email,
            'last_update_date'        => date('Y-m-d H:i:s'),
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
