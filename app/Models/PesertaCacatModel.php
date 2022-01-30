<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaCacatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_peserta_cacat';
    protected $primaryKey       = 'peserta_cacat_id';
    protected $uniqueCode       = 'peserta_cacat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_cacat_id',
        'peserta_cacat_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'cacat_golongan_id',
        'cacat_golongan_unique_code',
        'nama_cacat_golongan',
        'cacat_tingkat_id',
        'cacat_tingkat_unique_code',
        'nama_cacat_tingkat',
        'status',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'peserta_mutasi_id',
        'peserta_mutasi_unique_code',
        'deskripsi',
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
        'peserta_cacat_unique_code' => 'required',
        'peserta_id'                => 'required|is_peserta_exists[peserta_id]',
        'cacat_golongan_id'         => 'required|is_cacat_golongan_exists[cacat_golongan_id]',
        'cacat_tingkat_id'          => 'required|is_cacat_tingkat_exists[cacat_tingkat_id]',
        'status'                    => 'required',
        'tanggal_pengajuan'         => 'required',
        'tanggal_persetujuan'       => 'required',
        'peserta_mutasi_id'         => 'required|is_peserta_mutasi_exists[peserta_mutasi_id]',
        'deskripsi'                 => 'required',

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
        $model = new PesertaCacatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaCacatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta       = PesertaModel::findById($request->getVar('peserta_id'));
        $cacatGolongan = CacatGolonganModel::findById($request->getVar('cacat_golongan_id'));
        $cacatTingkat  = CacatTingkatModel::findById($request->getVar('cacat_tingkat_id'));
        $pesertaMutasi = PesertaMutasiModel::findById($request->getVar('peserta_mutasi_id'));

        return $model->insert([
            'peserta_cacat_unique_code'  => $request->getVar('peserta_cacat_unique_code'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $peserta['peserta_unique_code'],
            'nama_peserta'               => $peserta['nama_peserta'],
            'cacat_golongan_id'          => $request->getVar('cacat_golongan_id'),
            'cacat_golongan_unique_code' => $cacatGolongan['cacat_golongan_unique_code'],
            'nama_cacat_golongan'        => $cacatGolongan['nama_cacat_golongan'],
            'cacat_tingkat_id'           => $request->getVar('cacat_tingkat_id'),
            'cacat_tingkat_unique_code'  => $cacatTingkat['cacat_tingkat_unique_code'],
            'nama_cacat_tingkat'         => $cacatTingkat['nama_cacat_tingkat'],
            'status'                     => $request->getVar('status'),
            'tanggal_pengajuan'          => $request->getVar('tanggal_pengajuan'),
            'tanggal_persetujuan'        => $request->getVar('tanggal_persetujuan'),
            'peserta_mutasi_id'          => $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code' => $pesertaMutasi['peserta_mutasi_unique_code'],
            'deskripsi'                  => $request->getVar('deskripsi'),

            'created_date'               => date('Y-m-d H:i:s'),
            'created_by'                 => $user->data->email,
            'deleted_status'             => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta       = PesertaModel::findById($request->getVar('peserta_id'));
        $cacatGolongan = CacatGolonganModel::findById($request->getVar('cacat_golongan_id'));
        $cacatTingkat  = CacatTingkatModel::findById($request->getVar('cacat_tingkat_id'));
        $pesertaMutasi = PesertaMutasiModel::findById($request->getVar('peserta_mutasi_id'));
        return $model->update($id, [
            'peserta_cacat_unique_code'  => $request->getVar('peserta_cacat_unique_code'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $peserta['peserta_unique_code'],
            'nama_peserta'               => $peserta['nama_peserta'],
            'cacat_golongan_id'          => $request->getVar('cacat_golongan_id'),
            'cacat_golongan_unique_code' => $cacatGolongan['cacat_golongan_unique_code'],
            'nama_cacat_golongan'        => $cacatGolongan['nama_cacat_golongan'],
            'cacat_tingkat_id'           => $request->getVar('cacat_tingkat_id'),
            'cacat_tingkat_unique_code'  => $cacatTingkat['cacat_tingkat_unique_code'],
            'nama_cacat_tingkat'         => $cacatTingkat['nama_cacat_tingkat'],
            'status'                     => $request->getVar('status'),
            'tanggal_pengajuan'          => $request->getVar('tanggal_pengajuan'),
            'tanggal_persetujuan'        => $request->getVar('tanggal_persetujuan'),
            'peserta_mutasi_id'          => $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code' => $pesertaMutasi['peserta_mutasi_unique_code'],
            'deskripsi'                  => $request->getVar('deskripsi'),

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
