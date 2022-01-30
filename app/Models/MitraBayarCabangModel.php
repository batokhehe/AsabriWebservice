<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraBayarCabangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_mitra_bayar_cabang';
    protected $primaryKey       = 'mitra_bayar_cabang_id';
    protected $uniqueCode       = 'mitra_bayar_cabang_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'mitra_bayar_cabang_id',
        'mitra_bayar_cabang_unique_code',
        'nama_mitra_bayar_cabang',
        'kode_mitra_bayar_cabang',
        'deskripsi',
        'alamat_cabang_mitra_bayar',
        'longitude',
        'latitude',
        'mitra_bayar_id',
        'nama_mitra_bayar',
        'mitra_bayar_unique_code',
        'provinsi_id',
        'nama_provinsi',
        'provinsi_unique_code',
        'kota_id',
        'nama_kota',
        'kota_unique_code',
        'kecamatan_id',
        'nama_kecamatan',
        'kecamatan_unique_code',
        'kelurahan_id',
        'nama_kelurahan',
        'kelurahan_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'telephone',
        'kode_kantor_cabang',
        'nama_kantor_cabang',
        'kantor_cabang_id',
        'kantor_cabang_unique_code',
        'parent_id',
        'child_id',
        'faximile',
        'email',
        'mitra_media_id',
        'mitra_main_acc',
        'status',
        'is_online',
        'is_pks',
        'level_mitra',
        'approve_status',
        'keterangan_pks',
        'nomor_pks',
        'mitra_edi',
        'tanggal_pks',
        'is_pp_102',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'mitra_bayar_cabang_unique_code' => 'required',
        'nama_mitra_bayar_cabang'        => 'required',
        'kode_mitra_bayar_cabang'        => 'required',
        'deskripsi'                      => 'required',
        'alamat_cabang_mitra_bayar'      => 'required',
        'longitude'                      => 'required',
        'latitude'                       => 'required',
        'mitra_bayar_id'                 => 'required|is_mitra_bayar_exists[mitra_bayar_id]',
        'provinsi_id'                    => 'required|is_provinsi_exists[provinsi_id]',
        'kota_id'                        => 'required|is_kota_exists[kota_id]',
        'kecamatan_id'                   => 'required|is_kecamatan_exists[kecamatan_id]',
        'kelurahan_id'                   => 'required|is_kelurahan_exists[kelurahan_id]',
        'telephone'                      => 'required',
        'kode_kantor_cabang'             => 'required',
        'nama_kantor_cabang'             => 'required',
        'kantor_cabang_id'               => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        'parent_id'                      => 'required',
        'child_id'                       => 'required',
        'faximile'                       => 'required',
        'email'                          => 'required',
        'mitra_media_id'                 => 'required',
        'mitra_main_acc'                 => 'required',
        'status'                         => 'required',
        'is_online'                      => 'required',
        'is_pks'                         => 'required',
        'level_mitra'                    => 'required',
        'approve_status'                 => 'required',
        'keterangan_pks'                 => 'required',
        'nomor_pks'                      => 'required',
        'mitra_edi'                      => 'required',
        'tanggal_pks'                    => 'required',
        'is_pp_102'                      => 'required',

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
        $model = new MitraBayarCabangModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new MitraBayarCabangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelurahan    = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan    = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota         = KotaModel::findById($request->getVar('kota_id'));
        $provinsi     = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $mitraBayar   = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $kantorCabang = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));

        return $model->insert([
            $model->primaryKey               => $model->getAvailableId($model),
            'mitra_bayar_cabang_unique_code' => $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar_cabang'        => $request->getVar('nama_mitra_bayar_cabang'),
            'kode_mitra_bayar_cabang'        => $request->getVar('kode_mitra_bayar_cabang'),
            'deskripsi'                      => $request->getVar('deskripsi'),
            'alamat_cabang_mitra_bayar'      => $request->getVar('alamat_cabang_mitra_bayar'),
            'longitude'                      => $request->getVar('longitude'),
            'latitude'                       => $request->getVar('latitude'),
            'mitra_bayar_id'                 => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'               => $mitraBayar['nama_mitra_bayar'],
            'mitra_bayar_unique_code'        => $mitraBayar['mitra_bayar_unique_code'],
            'provinsi_id'                    => $request->getVar('provinsi_id'),
            'nama_provinsi'                  => $provinsi['nama_provinsi'],
            'provinsi_unique_code'           => $provinsi['provinsi_unique_code'],
            'kota_id'                        => $request->getVar('kota_id'),
            'nama_kota'                      => $kota['nama_kota'],
            'kota_unique_code'               => $kota['kota_unique_code'],
            'kecamatan_id'                   => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                 => $kecamatan['nama_kecamatan'],
            'kecamatan_unique_code'          => $kecamatan['kecamatan_unique_code'],
            'kelurahan_id'                   => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                 => $kelurahan['nama_kelurahan'],
            'kelurahan_unique_code'          => $kelurahan['kelurahan_unique_code'],
            'telephone'                      => $request->getVar('telephone'),
            'kode_kantor_cabang'             => $kantorCabang['kode_kantor_cabang'],
            'nama_kantor_cabang'             => $kantorCabang['nama_kantor_cabang'],
            'kantor_cabang_id'               => $request->getVar('kantor_cabang_id'),
            'kantor_cabang_unique_code'      => $kantorCabang['kantor_cabang_unique_code'],
            'parent_id'                      => $request->getVar('parent_id'),
            'child_id'                       => $request->getVar('child_id'),
            'faximile'                       => $request->getVar('faximile'),
            'email'                          => $request->getVar('email'),
            'mitra_media_id'                 => $request->getVar('mitra_media_id'),
            'mitra_main_acc'                 => $request->getVar('mitra_main_acc'),
            'status'                         => $request->getVar('status'),
            'is_online'                      => $request->getVar('is_online'),
            'is_pks'                         => $request->getVar('is_pks'),
            'level_mitra'                    => $request->getVar('level_mitra'),
            'approve_status'                 => $request->getVar('approve_status'),
            'keterangan_pks'                 => $request->getVar('keterangan_pks'),
            'nomor_pks'                      => $request->getVar('nomor_pks'),
            'mitra_edi'                      => $request->getVar('mitra_edi'),
            'tanggal_pks'                    => $request->getVar('tanggal_pks'),
            'is_pp_102'                      => $request->getVar('is_pp_102'),

            'created_date'                   => date('Y-m-d H:i:s'),
            'created_by'                     => $user->data->email,
            'deleted_status'                 => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'mitra_bayar_cabang_unique_code' => $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar_cabang'        => $request->getVar('nama_mitra_bayar_cabang'),
            'kode_mitra_bayar_cabang'        => $request->getVar('kode_mitra_bayar_cabang'),
            'deskripsi'                      => $request->getVar('deskripsi'),
            'alamat_cabang_mitra_bayar'      => $request->getVar('alamat_cabang_mitra_bayar'),
            'longitude'                      => $request->getVar('longitude'),
            'latitude'                       => $request->getVar('latitude'),
            'mitra_bayar_id'                 => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'               => $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'        => $request->getVar('mitra_bayar_unique_code'),
            'provinsi_id'                    => $request->getVar('provinsi_id'),
            'nama_provinsi'                  => $request->getVar('nama_provinsi'),
            'provinsi_unique_code'           => $request->getVar('provinsi_unique_code'),
            'kota_id'                        => $request->getVar('kota_id'),
            'nama_kota'                      => $request->getVar('nama_kota'),
            'kota_unique_code'               => $request->getVar('kota_unique_code'),
            'kecamatan_id'                   => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                 => $request->getVar('nama_kecamatan'),
            'kecamatan_unique_code'          => $request->getVar('kecamatan_unique_code'),
            'kelurahan_id'                   => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                 => $request->getVar('nama_kelurahan'),
            'kelurahan_unique_code'          => $request->getVar('kelurahan_unique_code'),
            'telephone'                      => $request->getVar('telephone'),
            'kode_kantor_cabang'             => $request->getVar('kode_kantor_cabang'),
            'nama_kantor_cabang'             => $request->getVar('nama_kantor_cabang'),
            'kantor_cabang_id'               => $request->getVar('kantor_cabang_id'),
            'kantor_cabang_unique_code'      => $request->getVar('kantor_cabang_unique_code'),
            'parent_id'                      => $request->getVar('parent_id'),
            'child_id'                       => $request->getVar('child_id'),
            'faximile'                       => $request->getVar('faximile'),
            'email'                          => $request->getVar('email'),
            'mitra_media_id'                 => $request->getVar('mitra_media_id'),
            'mitra_main_acc'                 => $request->getVar('mitra_main_acc'),
            'status'                         => $request->getVar('status'),
            'is_online'                      => $request->getVar('is_online'),
            'is_pks'                         => $request->getVar('is_pks'),
            'level_mitra'                    => $request->getVar('level_mitra'),
            'approve_status'                 => $request->getVar('approve_status'),
            'keterangan_pks'                 => $request->getVar('keterangan_pks'),
            'nomor_pks'                      => $request->getVar('nomor_pks'),
            'mitra_edi'                      => $request->getVar('mitra_edi'),
            'tanggal_pks'                    => $request->getVar('tanggal_pks'),
            'is_pp_102'                      => $request->getVar('is_pp_102'),

            'last_update_by'                 => $user->data->email,
            'last_update_date'               => date('Y-m-d H:i:s'),
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
