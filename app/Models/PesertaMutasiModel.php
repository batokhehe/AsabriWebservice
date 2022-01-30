<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaMutasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_peserta_mutasi';
    protected $primaryKey       = 'peserta_mutasi_id';
    protected $uniqueCode       = 'peserta_mutasi_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_mutasi_id',
        'peserta_mutasi_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'tanggal_permohonan',
        'tanggal_persetujuan',
        'status',
        'jenis_mutasi_id',
        'nama_jenis_mutasi',
        'jenis_mutasi_unique_code',
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
        'peserta_mutasi_unique_code' => 'required',
        'peserta_id'                 => 'required|is_peserta_exists[peserta_id]',
        'tanggal_permohonan'         => 'required',
        'tanggal_persetujuan'        => 'required',
        'status'                     => 'required',
        'jenis_mutasi_id'            => 'required|is_jenis_mutasi_exists[jenis_mutasi_id]',

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
        $model = new PesertaMutasiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaMutasiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta     = PesertaModel::findById($request->getVar('peserta_id'));
        $jenisMutasi = JenisMutasiModel::findById($request->getVar('jenis_mutasi_id'));
        return $model->insert([
            'peserta_mutasi_unique_code' => $request->getVar('peserta_mutasi_unique_code'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $peserta['peserta_unique_code'],
            'nama_peserta'               => $peserta['nama_peserta'],
            'tanggal_permohonan'         => $request->getVar('tanggal_permohonan'),
            'tanggal_persetujuan'        => $request->getVar('tanggal_persetujuan'),
            'status'                     => $request->getVar('status'),
            'jenis_mutasi_id'            => $request->getVar('jenis_mutasi_id'),
            'nama_jenis_mutasi'          => $jenisMutasi['nama_jenis_mutasi'],
            'jenis_mutasi_unique_code'   => $jenisMutasi['jenis_mutasi_unique_code'],

            'created_date'               => date('Y-m-d H:i:s'),
            'created_by'                 => $user->data->email,
            'deleted_status'             => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta     = PesertaModel::findById($request->getVar('peserta_id'));
        $jenisMutasi = JenisKlaimModel::findById($request->getVar('jenis_mutasi_id'));
        return $model->update($id, [
            'peserta_mutasi_unique_code' => $request->getVar('peserta_mutasi_unique_code'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $peserta['peserta_unique_code'],
            'nama_peserta'               => $peserta['nama_peserta'],
            'tanggal_permohonan'         => $request->getVar('tanggal_permohonan'),
            'tanggal_persetujuan'        => $request->getVar('tanggal_persetujuan'),
            'status'                     => $request->getVar('status'),
            'jenis_mutasi_id'            => $request->getVar('jenis_mutasi_id'),
            'nama_jenis_mutasi'          => $jenisMutasi['nama_jenis_mutasi'],
            'jenis_mutasi_unique_code'   => $jenisMutasi['jenis_mutasi_unique_code'],

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
