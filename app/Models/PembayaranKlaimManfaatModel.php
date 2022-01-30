<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranKlaimManfaatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_pembayaran_klaim_manfaat';
    protected $primaryKey       = 'pembayaran_klaim_manfaat_id';
    protected $uniqueCode       = 'pembayaran_klaim_manfaat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pembayaran_klaim_manfaat_id',
        'pembayaran_klaim_manfaat_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'pangkat_peserta',
        'nomor_pembayaran',
        'tanggal_pembayaran',
        'klaim_id',
        'nomor_klaim',
        'status',
        'jumlah_pengajuan',
        'jumlah_pembayaran',
        'deskripsi',
        'jumlah_deskripsi',
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
        'pembayaran_klaim_manfaat_unique_code' => 'required',
        'peserta_id'                           => 'required|is_peserta_exists[peserta_id]',
        'pangkat_peserta'                      => 'required',
        'nomor_pembayaran'                     => 'required',
        'tanggal_pembayaran'                   => 'required',
        'klaim_id'                             => 'required|is_klaim_exists[klaim_id]',
        'status'                               => 'required',
        'jumlah_pengajuan'                     => 'required',
        'jumlah_pembayaran'                    => 'required',
        'deskripsi'                            => 'required',
        'jumlah_deskripsi'                     => 'required',
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
        $model = new PembayaranKlaimManfaatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PembayaranKlaimManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta = PesertaModel::findById($request->getVar('peserta_id'));
        $klaim   = KlaimModel::findById($request->getVar('klaim_id'));

        return $model->insert([
            'pembayaran_klaim_manfaat_unique_code' => $request->getVar('pembayaran_klaim_manfaat_unique_code'),
            'peserta_id'                           => $request->getVar('peserta_id'),
            'peserta_unique_code'                  => $peserta['peserta_unique_code'],
            'nama_peserta'                         => $peserta['nama_peserta'],
            'pangkat_peserta'                      => $request->getVar('pangkat_peserta'),
            'nomor_pembayaran'                     => $request->getVar('nomor_pembayaran'),
            'tanggal_pembayaran'                   => $request->getVar('tanggal_pembayaran'),
            'klaim_id'                             => $request->getVar('klaim_id'),
            'nomor_klaim'                          => $klaim['nomor_klaim'],
            'status'                               => $request->getVar('status'),
            'jumlah_pengajuan'                     => $request->getVar('jumlah_pengajuan'),
            'jumlah_pembayaran'                    => $request->getVar('jumlah_pembayaran'),
            'deskripsi'                            => $request->getVar('deskripsi'),
            'jumlah_deskripsi'                     => $request->getVar('jumlah_deskripsi'),

            'created_date'                         => date('Y-m-d H:i:s'),
            'created_by'                           => $user->data->email,
            'deleted_status'                       => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta = PesertaModel::findById($request->getVar('peserta_id'));
        $klaim   = KlaimModel::findById($request->getVar('klaim_id'));
        return $model->update($id, [
            'pembayaran_klaim_manfaat_unique_code' => $request->getVar('pembayaran_klaim_manfaat_unique_code'),
            'peserta_id'                           => $request->getVar('peserta_id'),
            'peserta_unique_code'                  => $peserta['peserta_unique_code'],
            'nama_peserta'                         => $peserta['nama_peserta'],
            'pangkat_peserta'                      => $request->getVar('pangkat_peserta'),
            'nomor_pembayaran'                     => $request->getVar('nomor_pembayaran'),
            'tanggal_pembayaran'                   => $request->getVar('tanggal_pembayaran'),
            'klaim_id'                             => $request->getVar('klaim_id'),
            'nomor_klaim'                          => $klaim['nomor_klaim'],
            'status'                               => $request->getVar('status'),
            'jumlah_pengajuan'                     => $request->getVar('jumlah_pengajuan'),
            'jumlah_pembayaran'                    => $request->getVar('jumlah_pembayaran'),
            'deskripsi'                            => $request->getVar('deskripsi'),
            'jumlah_deskripsi'                     => $request->getVar('jumlah_deskripsi'),

            'last_update_by'                       => $user->data->email,
            'last_update_date'                     => date('Y-m-d H:i:s'),
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
