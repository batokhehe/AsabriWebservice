<?php

namespace App\Models;

use CodeIgniter\Model;

class KlaimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_klaim';
    protected $primaryKey       = 'klaim_id';
    protected $uniqueCode       = 'klaim_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'klaim_id',
        'klaim_unique_code',
        'nomor_klaim',
        'tanggal_klaim',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'jenis_klaim_id',
        'klaim_status_id',
        'klaim_status',
        'keluarga_id',
        'keluarga_unique_code',
        'nama_keluarga',
        'faskes_id',
        'nama_faskes',
        'faskes_unique_code',
        'peserta_cacat_id',
        'peserta_cacat_unique_code',
        'is_mitra',
        'is_asuransi',
        'is_pensiun',
        'jumlah_pengajuan',
        'jumlah_potongan',
        'jumlah_verifikasi',
        'jumlah_persetujuan',
        'jumlah_pembulatan',
        'jumlah_pembayaran',
        'is_cancel',
        'is_paid',
        'is_retur',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'mitra_bayar_id',
        'nama_mitra_bayar',
        'mitra_bayar_unique_code',
        'cabang_mitra_bayar_id',
        'nama_cabang_mitra_bayar',
        'cabang_mitra_bayar_unique_code',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'kode_kantor_cabang',
        'nama_penerima_pembayaran',
        'alamat_penerima',
        'nomor_rekening',
        'nama_rekening',
        'peserta_produk_id',
        'peserta_produk_perawatan_id',
        'peserta_produk_cacat_id',
        'keterangan',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'klaim_unique_code'           => 'required',
        'nomor_klaim'                 => 'required',
        'tanggal_klaim'               => 'required',
        'peserta_id'                  => 'required|is_peserta_exists[peserta_id]',
        'jenis_klaim_id'              => 'required|is_jenis_klaim_exists[jenis_klaim_id]',
        'klaim_status_id'             => 'required|is_status_klaim_exists[klaim_status_id]',
        'keluarga_id'                 => 'required|is_keluarga_exists[keluarga_id]',
        'faskes_id'                   => 'required|is_faskes_exists[faskes_id]',
        'peserta_cacat_id'            => 'required|is_peserta_cacat_exists[peserta_cacat_id]',
        'is_mitra'                    => 'required',
        'is_asuransi'                 => 'required',
        'is_pensiun'                  => 'required',
        'jumlah_pengajuan'            => 'required',
        'jumlah_potongan'             => 'required',
        'jumlah_verifikasi'           => 'required',
        'jumlah_persetujuan'          => 'required',
        'jumlah_pembulatan'           => 'required',
        'jumlah_pembayaran'           => 'required',
        'is_cancel'                   => 'required',
        'is_paid'                     => 'required',
        'is_retur'                    => 'required',
        'deskripsi'                   => 'required',
        'mitra_bayar_id'              => 'required|is_mitra_bayar_exists[mitra_bayar_id]',
        'cabang_mitra_bayar_id'       => 'required|is_mitra_bayar_cabang_exists[cabang_mitra_bayar_id]',
        'kantor_cabang_id'            => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        'nama_penerima_pembayaran'    => 'required',
        'alamat_penerima'             => 'required',
        'nomor_rekening'              => 'required',
        'nama_rekening'               => 'required',
        'peserta_produk_id'           => 'required|is_peserta_produk_exists[peserta_produk_id]',
        'peserta_produk_perawatan_id' => 'required',
        'peserta_produk_cacat_id'     => 'required',
        'keterangan'                  => 'required',
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
        $model = new KlaimModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KlaimModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta          = PesertaModel::findById($request->getVar('peserta_id'));
        $jenisKlaim       = JenisKlaimModel::findById($request->getVar('jenis_klaim_id'));
        $statusKlaim      = StatusKlaimModel::findById($request->getVar('klaim_status_id'));
        $keluarga         = KeluargaModel::findById($request->getVar('keluarga_id'));
        $kantorCabang     = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));
        $pesertaCacat     = PesertaCacatModel::findById($request->getVar('peserta_cacat_id'));
        $mitraBayar       = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $cabangMitraBayar = MitraBayarCabangModel::findById($request->getVar('cabang_mitra_bayar_id'));
        $pesertaProduk    = PesertaProdukModel::findById($request->getVar('peserta_produk_id'));
        $faskes           = FaskesModel::findById($request->getVar('faskes_id'));

        return $model->insert([
            'klaim_unique_code'              => $request->getVar('klaim_unique_code'),
            'nomor_klaim'                    => $request->getVar('nomor_klaim'),
            'tanggal_klaim'                  => $request->getVar('tanggal_klaim'),
            'peserta_id'                     => $request->getVar('peserta_id'),
            'peserta_unique_code'            => $peserta['peserta_unique_code'],
            'nama_peserta'                   => $peserta['nama_peserta'],
            'jenis_klaim_id'                 => $request->getVar('jenis_klaim_id'),
            'klaim_status_id'                => $request->getVar('klaim_status_id'),
            'klaim_status'                   => $statusKlaim['nama_status_klaim'],
            'keluarga_id'                    => $request->getVar('keluarga_id'),
            'keluarga_unique_code'           => $keluarga['keluarga_unique_code'],
            'nama_keluarga'                  => $keluarga['nama_keluarga'],
            'faskes_id'                      => $request->getVar('faskes_id'),
            'nama_faskes'                    => $faskes['nama_faskes'],
            'faskes_unique_code'             => $faskes['faskes_unique_code'],
            'peserta_cacat_id'               => $request->getVar('peserta_cacat_id'),
            'peserta_cacat_unique_code'      => $pesertaCacat['peserta_cacat_unique_code'],
            'is_mitra'                       => $request->getVar('is_mitra'),
            'is_asuransi'                    => $request->getVar('is_asuransi'),
            'is_pensiun'                     => $request->getVar('is_pensiun'),
            'jumlah_pengajuan'               => $request->getVar('jumlah_pengajuan'),
            'jumlah_potongan'                => $request->getVar('jumlah_potongan'),
            'jumlah_verifikasi'              => $request->getVar('jumlah_verifikasi'),
            'jumlah_persetujuan'             => $request->getVar('jumlah_persetujuan'),
            'jumlah_pembulatan'              => $request->getVar('jumlah_pembulatan'),
            'jumlah_pembayaran'              => $request->getVar('jumlah_pembayaran'),
            'is_cancel'                      => $request->getVar('is_cancel'),
            'is_paid'                        => $request->getVar('is_paid'),
            'is_retur'                       => $request->getVar('is_retur'),
            'deskripsi'                      => $request->getVar('deskripsi'),
            'mitra_bayar_id'                 => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'               => $mitraBayar['nama_mitra_bayar'],
            'mitra_bayar_unique_code'        => $mitraBayar['mitra_bayar_unique_code'],
            'cabang_mitra_bayar_id'          => $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'        => $cabangMitraBayar['nama_mitra_bayar_cabang'],
            'cabang_mitra_bayar_unique_code' => $cabangMitraBayar['mitra_bayar_cabang_unique_code'],
            'kantor_cabang_id'               => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'             => $kantorCabang['nama_kantor_cabang'],
            'kode_kantor_cabang'             => $kantorCabang['kode_kantor_cabang'],
            'nama_penerima_pembayaran'       => $request->getVar('nama_penerima_pembayaran'),
            'alamat_penerima'                => $request->getVar('alamat_penerima'),
            'nomor_rekening'                 => $request->getVar('nomor_rekening'),
            'nama_rekening'                  => $request->getVar('nama_rekening'),
            'peserta_produk_id'              => $request->getVar('peserta_produk_id'),
            'peserta_produk_perawatan_id'    => $request->getVar('peserta_produk_perawatan_id'),
            'peserta_produk_cacat_id'        => $request->getVar('peserta_produk_cacat_id'),
            'keterangan'                     => $request->getVar('keterangan'),

            'created_date'                   => date('Y-m-d H:i:s'),
            'created_by'                     => $user->data->email,
            'deleted_status'                 => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'klaim_unique_code'              => $request->getVar('klaim_unique_code'),
            'nomor_klaim'                    => $request->getVar('nomor_klaim'),
            'tanggal_klaim'                  => $request->getVar('tanggal_klaim'),
            'peserta_id'                     => $request->getVar('peserta_id'),
            'peserta_unique_code'            => $request->getVar('peserta_unique_code'),
            'nama_peserta'                   => $request->getVar('nama_peserta'),
            'jenis_klaim_id'                 => $request->getVar('jenis_klaim_id'),
            'klaim_status_id'                => $request->getVar('klaim_status_id'),
            'klaim_status'                   => $request->getVar('klaim_status'),
            'keluarga_id'                    => $request->getVar('keluarga_id'),
            'keluarga_unique_code'           => $request->getVar('keluarga_unique_code'),
            'nama_keluarga'                  => $request->getVar('nama_keluarga'),
            'faskes_id'                      => $request->getVar('faskes_id'),
            'nama_faskes'                    => $request->getVar('nama_faskes'),
            'faskes_unique_code'             => $request->getVar('faskes_unique_code'),
            'peserta_cacat_id'               => $request->getVar('peserta_cacat_id'),
            'peserta_cacat_unique_code'      => $request->getVar('peserta_cacat_unique_code'),
            'is_mitra'                       => $request->getVar('is_mitra'),
            'is_asuransi'                    => $request->getVar('is_asuransi'),
            'is_pensiun'                     => $request->getVar('is_pensiun'),
            'jumlah_pengajuan'               => $request->getVar('jumlah_pengajuan'),
            'jumlah_potongan'                => $request->getVar('jumlah_potongan'),
            'jumlah_verifikasi'              => $request->getVar('jumlah_verifikasi'),
            'jumlah_persetujuan'             => $request->getVar('jumlah_persetujuan'),
            'jumlah_pembulatan'              => $request->getVar('jumlah_pembulatan'),
            'jumlah_pembayaran'              => $request->getVar('jumlah_pembayaran'),
            'is_cancel'                      => $request->getVar('is_cancel'),
            'is_paid'                        => $request->getVar('is_paid'),
            'is_retur'                       => $request->getVar('is_retur'),
            'deskripsi'                      => $request->getVar('deskripsi'),
            'mitra_bayar_id'                 => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'               => $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'        => $request->getVar('mitra_bayar_unique_code'),
            'cabang_mitra_bayar_id'          => $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'        => $request->getVar('nama_cabang_mitra_bayar'),
            'cabang_mitra_bayar_unique_code' => $request->getVar('cabang_mitra_bayar_unique_code'),
            'kantor_cabang_id'               => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'             => $request->getVar('nama_kantor_cabang'),
            'kode_kantor_cabang'             => $request->getVar('kode_kantor_cabang'),
            'nama_penerima_pembayaran'       => $request->getVar('nama_penerima_pembayaran'),
            'alamat_penerima'                => $request->getVar('alamat_penerima'),
            'nomor_rekening'                 => $request->getVar('nomor_rekening'),
            'nama_rekening'                  => $request->getVar('nama_rekening'),
            'peserta_produk_id'              => $request->getVar('peserta_produk_id'),
            'peserta_produk_perawatan_id'    => $request->getVar('peserta_produk_perawatan_id'),
            'peserta_produk_cacat_id'        => $request->getVar('peserta_produk_cacat_id'),
            'keterangan'                     => $request->getVar('keterangan'),

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
