<?php

namespace App\Models;

use CodeIgniter\Model;

class KantorCabangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_kantor_cabang';
    protected $primaryKey       = 'kantor_cabang_id';
    protected $uniqueCode       = 'kantor_cabang_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kantor_cabang_id',
        'kantor_cabang_unique_code',
        'nama_kantor_cabang',
        'kode_kantor_cabang',
        'alamat',
        'keterangan',
        'status',
        'provinsi_id',
        'nama_provinsi',
        'kota_id',
        'nama_kota',
        'kecamatan_id',
        'nama_kecamatan',
        'kelurahan_id',
        'nama_kelurahan',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'pimpinan',
        'telephone',
        'postal_code',
        'longitude',
        'latitude',
        'faximile',
        'email',
        'kabid_pelayanan',
        'staff_pelayanan',
        'kepala_bidadum',
        'staff_bidadum',
        'pulau',
        'is_plt',
        'tanggal_mulai_plt',
        'tanggal_selesai_plt',
        'kantor_cabang_induk_id',
        'nama_kantor_cabang_induk',
        'kantor_cabang_induk_unique_code',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'kantor_cabang_unique_code'       => 'required',
        'nama_kantor_cabang'              => 'required',
        'kode_kantor_cabang'              => 'required',
        'alamat'                          => 'required',
        'keterangan'                      => 'required',
        'status'                          => 'required',
        'provinsi_id'                     => 'required|is_provinsi_exists[provinsi_id]',
        'kota_id'                         => 'required|is_kota_exists[kota_id]',
        'kecamatan_id'                    => 'required|is_kecamatan_exists[kecamatan_id]',
        'kelurahan_id'                    => 'required|is_kelurahan_exists[kelurahan_id]',
        'pimpinan'                        => 'required',
        'telephone'                       => 'required',
        'postal_code'                     => 'required',
        'longitude'                       => 'required',
        'latitude'                        => 'required',
        'faximile'                        => 'required',
        'email'                           => 'required',
        'kabid_pelayanan'                 => 'required',
        'staff_pelayanan'                 => 'required',
        'kepala_bidadum'                  => 'required',
        'staff_bidadum'                   => 'required',
        'pulau'                           => 'required',
        'is_plt'                          => 'required',
        'tanggal_mulai_plt'               => 'required',
        'tanggal_selesai_plt'             => 'required'

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
        $model = new KantorCabangModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KantorCabangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelurahan = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota      = KotaModel::findById($request->getVar('kota_id'));
        $provinsi  = ProvinsiModel::findById($request->getVar('provinsi_id'));
        return $model->insert([
            $model->primaryKey                => $model->getAvailableId($model),
            'kantor_cabang_unique_code'       => $request->getVar('kantor_cabang_unique_code'),
            'nama_kantor_cabang'              => $request->getVar('nama_kantor_cabang'),
            'kode_kantor_cabang'              => $request->getVar('kode_kantor_cabang'),
            'alamat'                          => $request->getVar('alamat'),
            'keterangan'                      => $request->getVar('keterangan'),
            'status'                          => $request->getVar('status'),
            'kelurahan_id'                    => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                  => $kelurahan['nama_kelurahan'],
            'kecamatan_id'                    => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                  => $kecamatan['nama_kecamatan'],
            'kota_id'                         => $request->getVar('kota_id'),
            'nama_kota'                       => $kota['nama_kota'],
            'provinsi_id'                     => $request->getVar('provinsi_id'),
            'nama_provinsi'                   => $provinsi['nama_provinsi'],
            'pimpinan'                        => $request->getVar('pimpinan'),
            'telephone'                       => $request->getVar('telephone'),
            'postal_code'                     => $request->getVar('postal_code'),
            'longitude'                       => $request->getVar('longitude'),
            'latitude'                        => $request->getVar('latitude'),
            'faximile'                        => $request->getVar('faximile'),
            'email'                           => $request->getVar('email'),
            'kabid_pelayanan'                 => $request->getVar('kabid_pelayanan'),
            'staff_pelayanan'                 => $request->getVar('staff_pelayanan'),
            'kepala_bidadum'                  => $request->getVar('kepala_bidadum'),
            'staff_bidadum'                   => $request->getVar('staff_bidadum'),
            'pulau'                           => $request->getVar('pulau'),
            'is_plt'                          => $request->getVar('is_plt'),
            'tanggal_mulai_plt'               => $request->getVar('tanggal_mulai_plt'),
            'tanggal_selesai_plt'             => $request->getVar('tanggal_selesai_plt'),
            'kantor_cabang_induk_id'          => $request->getVar('kantor_cabang_induk_id'),
            'nama_kantor_cabang_induk'        => $request->getVar('nama_kantor_cabang_induk'),
            'kantor_cabang_induk_unique_code' => $request->getVar('kantor_cabang_induk_unique_code'),

            'created_date'                    => date('Y-m-d H:i:s'),
            'created_by'                      => $user->data->email,
            'deleted_status'                  => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $kelurahan = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota      = KotaModel::findById($request->getVar('kota_id'));
        $provinsi  = ProvinsiModel::findById($request->getVar('provinsi_id'));
        return $model->update($id, [
            'kantor_cabang_unique_code'       => $request->getVar('kantor_cabang_unique_code'),
            'nama_kantor_cabang'              => $request->getVar('nama_kantor_cabang'),
            'kode_kantor_cabang'              => $request->getVar('kode_kantor_cabang'),
            'alamat'                          => $request->getVar('alamat'),
            'keterangan'                      => $request->getVar('keterangan'),
            'status'                          => $request->getVar('status'),
            'kelurahan_id'                    => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                  => $kelurahan['nama_kelurahan'],
            'kecamatan_id'                    => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                  => $kecamatan['nama_kecamatan'],
            'kota_id'                         => $request->getVar('kota_id'),
            'nama_kota'                       => $kota['nama_kota'],
            'provinsi_id'                     => $request->getVar('provinsi_id'),
            'nama_provinsi'                   => $provinsi['nama_provinsi'],
            'pimpinan'                        => $request->getVar('pimpinan'),
            'telephone'                       => $request->getVar('telephone'),
            'postal_code'                     => $request->getVar('postal_code'),
            'longitude'                       => $request->getVar('longitude'),
            'latitude'                        => $request->getVar('latitude'),
            'faximile'                        => $request->getVar('faximile'),
            'email'                           => $request->getVar('email'),
            'kabid_pelayanan'                 => $request->getVar('kabid_pelayanan'),
            'staff_pelayanan'                 => $request->getVar('staff_pelayanan'),
            'kepala_bidadum'                  => $request->getVar('kepala_bidadum'),
            'staff_bidadum'                   => $request->getVar('staff_bidadum'),
            'pulau'                           => $request->getVar('pulau'),
            'is_plt'                          => $request->getVar('is_plt'),
            'tanggal_mulai_plt'               => $request->getVar('tanggal_mulai_plt'),
            'tanggal_selesai_plt'             => $request->getVar('tanggal_selesai_plt'),
            'kantor_cabang_induk_id'          => $request->getVar('kantor_cabang_induk_id'),
            'nama_kantor_cabang_induk'        => $request->getVar('nama_kantor_cabang_induk'),
            'kantor_cabang_induk_unique_code' => $request->getVar('kantor_cabang_induk_unique_code'),

            'last_update_by'                  => $user->data->email,
            'last_update_date'                => date('Y-m-d H:i:s'),
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
