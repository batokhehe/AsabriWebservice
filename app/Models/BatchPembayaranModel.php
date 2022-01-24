<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchPembayaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_batch_pembayaran';
    protected $primaryKey       = 'batch_pembayaran_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'batch_pembayaran_id',
        'batch_pembayaran_unique_code',
        'nomor_batch_pembayaran',
        'bulan_tahun',
        'bulan',
        'tahun',
        'status_pembayaran',
        'nama_status_pembayaran',
        'deskripsi',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'jumlah_pembayaran',
        'jumlah_potongan',
        'jumlah_penerima',
        'jumlah_retur',
        'jumlah_nilai_retur',
        'jumlah_reversal',
        'jumlah_nilai_reversal',
        'jumlah_transaksi_berhasil',
        'jumlah_nilai_berhasil',
        'jumlah_estimasi_penerima',
        'nilai_estimasi_pembayaran',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'batch_pembayaran_unique_code' => 'required',
        'nomor_batch_pembayaran'       => 'required',
        'bulan_tahun'                  => 'required',
        'bulan'                        => 'required',
        'tahun'                        => 'required',
        'status_pembayaran'            => 'required',
        'deskripsi'                    => 'required',
        'jumlah_pembayaran'            => 'required',
        'jumlah_potongan'              => 'required',
        'jumlah_penerima'              => 'required',
        'jumlah_retur'                 => 'required',
        'jumlah_nilai_retur'           => 'required',
        'jumlah_reversal'              => 'required',
        'jumlah_nilai_reversal'        => 'required',
        'jumlah_transaksi_berhasil'    => 'required',
        'jumlah_nilai_berhasil'        => 'required',
        'jumlah_estimasi_penerima'     => 'required',
        'nilai_estimasi_pembayaran'    => 'required',

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
        $model = new BatchPembayaranModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new BatchPembayaranModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $status_pembayaran = StatusPembayaranModel::findById($request->getVar('status_pembayaran'));

        return $model->insert([
            'batch_pembayaran_unique_code' => $request->getVar('batch_pembayaran_unique_code'),
            'nomor_batch_pembayaran'       => $request->getVar('nomor_batch_pembayaran'),
            'bulan_tahun'                  => $request->getVar('bulan_tahun'),
            'bulan'                        => $request->getVar('bulan'),
            'tahun'                        => $request->getVar('tahun'),
            'status_pembayaran'            => $request->getVar('status_pembayaran'),
            'nama_status_pembayaran'       => $status_pembayaran['nama_status_pembayaran'],
            'deskripsi'                    => $request->getVar('deskripsi'),
            'jumlah_pembayaran'            => $request->getVar('jumlah_pembayaran'),
            'jumlah_potongan'              => $request->getVar('jumlah_potongan'),
            'jumlah_penerima'              => $request->getVar('jumlah_penerima'),
            'jumlah_retur'                 => $request->getVar('jumlah_retur'),
            'jumlah_nilai_retur'           => $request->getVar('jumlah_nilai_retur'),
            'jumlah_reversal'              => $request->getVar('jumlah_reversal'),
            'jumlah_nilai_reversal'        => $request->getVar('jumlah_nilai_reversal'),
            'jumlah_transaksi_berhasil'    => $request->getVar('jumlah_transaksi_berhasil'),
            'jumlah_nilai_berhasil'        => $request->getVar('jumlah_nilai_berhasil'),
            'jumlah_estimasi_penerima'     => $request->getVar('jumlah_estimasi_penerima'),
            'nilai_estimasi_pembayaran'    => $request->getVar('nilai_estimasi_pembayaran'),

            'created_date'                 => date('Y-m-d H:i:s'),
            'created_by'                   => $user->data->email,
            'deleted_status'               => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $status_pembayaran = StatusPembayaranModel::findById($request->getVar('status_pembayaran'));

        return $model->update($id, [
            'batch_pembayaran_unique_code' => $request->getVar('batch_pembayaran_unique_code'),
            'nomor_batch_pembayaran'       => $request->getVar('nomor_batch_pembayaran'),
            'bulan_tahun'                  => $request->getVar('bulan_tahun'),
            'bulan'                        => $request->getVar('bulan'),
            'tahun'                        => $request->getVar('tahun'),
            'status_pembayaran'            => $request->getVar('status_pembayaran'),
            'nama_status_pembayaran'       => $status_pembayaran['nama_status_pembayaran'],
            'deskripsi'                    => $request->getVar('deskripsi'),
            'jumlah_pembayaran'            => $request->getVar('jumlah_pembayaran'),
            'jumlah_potongan'              => $request->getVar('jumlah_potongan'),
            'jumlah_penerima'              => $request->getVar('jumlah_penerima'),
            'jumlah_retur'                 => $request->getVar('jumlah_retur'),
            'jumlah_nilai_retur'           => $request->getVar('jumlah_nilai_retur'),
            'jumlah_reversal'              => $request->getVar('jumlah_reversal'),
            'jumlah_nilai_reversal'        => $request->getVar('jumlah_nilai_reversal'),
            'jumlah_transaksi_berhasil'    => $request->getVar('jumlah_transaksi_berhasil'),
            'jumlah_nilai_berhasil'        => $request->getVar('jumlah_nilai_berhasil'),
            'jumlah_estimasi_penerima'     => $request->getVar('jumlah_estimasi_penerima'),
            'nilai_estimasi_pembayaran'    => $request->getVar('nilai_estimasi_pembayaran'),

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
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}
