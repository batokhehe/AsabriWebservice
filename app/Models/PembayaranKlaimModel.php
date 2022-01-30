<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranKlaimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_pembayaran_klaim';
    protected $primaryKey       = 'pembayaran_klaim_id';
    protected $uniqueCode       = 'pembayaran_klaim_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pembayaran_klaim_id',
        'pembayaran_klaim_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'pangkat_peserta',
        'klaim_id',
        'nomor_klaim',
        'mitra_bayar_id',
        'nama_mitra_bayar',
        'tipe_pembayaran_id',
        'nama_tipe_pembayaran',
        'manfaat_id',
        'nama_manfaat',
        'tanggal_aju',
        'tanggal_validasi',
        'no_skep_cacat',
        'tgl_skep_cacat',
        'unor_skep_cacat',
        'deskripsi',
        'no_sp',
        'tanggal_sp',
        'tanggal_pembayaran',
        'jumlah_klaim',
        'jumlah_pembayaran',
        'is_asuransi',
        'is_aktif',
        'is_edit',
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
        'pembayaran_klaim_unique_code' => 'required',
        'peserta_id'                   => 'required|is_peserta_exists[peserta_id]',
        'pangkat_peserta'              => 'required',
        'klaim_id'                     => 'required|is_klaim_exists[klaim_id]',
        'mitra_bayar_id'               => 'required|is_mitra_bayar_exists[mitra_bayar_id]',
        'tipe_pembayaran_id'           => 'required|is_tipe_pembayaran_exists[tipe_pembayaran_id]',
        'manfaat_id'                   => 'required|is_manfaat_exists[manfaat_id]',
        'tanggal_aju'                  => 'required',
        'tanggal_validasi'             => 'required',
        'no_skep_cacat'                => 'required',
        'tgl_skep_cacat'               => 'required',
        'unor_skep_cacat'              => 'required',
        'deskripsi'                    => 'required',
        'no_sp'                        => 'required',
        'tanggal_sp'                   => 'required',
        'tanggal_pembayaran'           => 'required',
        'jumlah_klaim'                 => 'required',
        'jumlah_pembayaran'            => 'required',
        'is_asuransi'                  => 'required',
        'is_aktif'                     => 'required',
        'is_edit'                      => 'required',
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
        $model = new PembayaranKlaimModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PembayaranKlaimModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta        = PesertaModel::findById($request->getVar('peserta_id'));
        $klaim          = KlaimModel::findById($request->getVar('klaim_id'));
        $mitraBayar     = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $tipePembayaran = TipePembayaranModel::findById($request->getVar('tipe_pembayaran_id'));
        $manfaat        = ManfaatModel::findById($request->getVar('manfaat_id'));

        return $model->insert([
            'pembayaran_klaim_unique_code' => $request->getVar('pembayaran_klaim_unique_code'),
            'peserta_id'                   => $request->getVar('peserta_id'),
            'peserta_unique_code'          => $peserta['peserta_unique_code'],
            'nama_peserta'                 => $peserta['nama_peserta'],
            'pangkat_peserta'              => $request->getVar('pangkat_peserta'),
            'klaim_id'                     => $request->getVar('klaim_id'),
            'nomor_klaim'                  => $klaim['nomor_klaim'],
            'mitra_bayar_id'               => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'             => $mitraBayar['nama_mitra_bayar'],
            'tipe_pembayaran_id'           => $request->getVar('tipe_pembayaran_id'),
            'nama_tipe_pembayaran'         => $tipePembayaran['nama_tipe_pembayaran'],
            'manfaat_id'                   => $request->getVar('manfaat_id'),
            'nama_manfaat'                 => $manfaat['nama_manfaat'],
            'tanggal_aju'                  => $request->getVar('tanggal_aju'),
            'tanggal_validasi'             => $request->getVar('tanggal_validasi'),
            'no_skep_cacat'                => $request->getVar('no_skep_cacat'),
            'tgl_skep_cacat'               => $request->getVar('tgl_skep_cacat'),
            'unor_skep_cacat'              => $request->getVar('unor_skep_cacat'),
            'deskripsi'                    => $request->getVar('deskripsi'),
            'no_sp'                        => $request->getVar('no_sp'),
            'tanggal_sp'                   => $request->getVar('tanggal_sp'),
            'tanggal_pembayaran'           => $request->getVar('tanggal_pembayaran'),
            'jumlah_klaim'                 => $request->getVar('jumlah_klaim'),
            'jumlah_pembayaran'            => $request->getVar('jumlah_pembayaran'),
            'is_asuransi'                  => $request->getVar('is_asuransi'),
            'is_aktif'                     => $request->getVar('is_aktif'),
            'is_edit'                      => $request->getVar('is_edit'),

            'created_date'                 => date('Y-m-d H:i:s'),
            'created_by'                   => $user->data->email,
            'deleted_status'               => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta        = PesertaModel::findById($request->getVar('peserta_id'));
        $klaim          = KlaimModel::findById($request->getVar('klaim_id'));
        $mitraBayar     = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $tipePembayaran = TipePembayaranModel::findById($request->getVar('tipe_pembayaran_id'));
        $manfaat        = ManfaatModel::findById($request->getVar('manfaat_id'));

        return $model->update($id, [
            'pembayaran_klaim_unique_code' => $request->getVar('pembayaran_klaim_unique_code'),
            'peserta_id'                   => $request->getVar('peserta_id'),
            'peserta_unique_code'          => $peserta['peserta_unique_code'],
            'nama_peserta'                 => $peserta['nama_peserta'],
            'pangkat_peserta'              => $request->getVar('pangkat_peserta'),
            'klaim_id'                     => $request->getVar('klaim_id'),
            'nomor_klaim'                  => $klaim['nomor_klaim'],
            'mitra_bayar_id'               => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'             => $mitraBayar['nama_mitra_bayar'],
            'tipe_pembayaran_id'           => $request->getVar('tipe_pembayaran_id'),
            'nama_tipe_pembayaran'         => $tipePembayaran['nama_tipe_pembayaran'],
            'manfaat_id'                   => $request->getVar('manfaat_id'),
            'nama_manfaat'                 => $manfaat['nama_manfaat'],
            'tanggal_aju'                  => $request->getVar('tanggal_aju'),
            'tanggal_validasi'             => $request->getVar('tanggal_validasi'),
            'no_skep_cacat'                => $request->getVar('no_skep_cacat'),
            'tgl_skep_cacat'               => $request->getVar('tgl_skep_cacat'),
            'unor_skep_cacat'              => $request->getVar('unor_skep_cacat'),
            'deskripsi'                    => $request->getVar('deskripsi'),
            'no_sp'                        => $request->getVar('no_sp'),
            'tanggal_sp'                   => $request->getVar('tanggal_sp'),
            'tanggal_pembayaran'           => $request->getVar('tanggal_pembayaran'),
            'jumlah_klaim'                 => $request->getVar('jumlah_klaim'),
            'jumlah_pembayaran'            => $request->getVar('jumlah_pembayaran'),
            'is_asuransi'                  => $request->getVar('is_asuransi'),
            'is_aktif'                     => $request->getVar('is_aktif'),
            'is_edit'                      => $request->getVar('is_edit'),

            'last_update_by'               => $user->data->email,
            'last_update_date'             => date('Y-m-d H:i:s'),
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
