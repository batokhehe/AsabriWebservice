<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaIuranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_peserta_iuran';
    protected $primaryKey       = 'peserta_iuran_id';
    protected $uniqueCode       = 'peserta_iuran_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_iuran_id',
        'peserta_iuran_unique_code',
        'bulan',
        'tahun',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'nomor_peserta',
        'pembayaran_peserta',
        'pemberi_kerja_peserta',
        'jumlah_pembayaran',
        'peserta_produk_id',
        'peserta_produk_unique_code',
        'nama_produk',
        'status',
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
        'peserta_iuran_unique_code' => 'required',
        'bulan'                     => 'required',
        'tahun'                     => 'required',
        'peserta_id'                => 'required|is_peserta_exists[peserta_id]',
        'pembayaran_peserta'        => 'required',
        'pemberi_kerja_peserta'     => 'required',
        'jumlah_pembayaran'         => 'required',
        'peserta_produk_id'         => 'required|is_peserta_produk_exists[peserta_produk_id]',
        'status'                    => 'required',

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
        $model = new PesertaIuranModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaIuranModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta       = PesertaModel::findById($request->getVar('peserta_id'));
        $pesertaProduk = PesertaProdukModel::findById($request->getVar('peserta_produk_id'));

        return $model->insert([
            $model->primaryKey           => $model->getAvailableId($model),
            'peserta_iuran_unique_code'  => $request->getVar('peserta_iuran_unique_code'),
            'bulan'                      => $request->getVar('bulan'),
            'tahun'                      => $request->getVar('tahun'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $peserta['peserta_unique_code'],
            'nama_peserta'               => $peserta['nama_peserta'],
            'nomor_peserta'              => $peserta['nomor_pensiun_peserta'],
            'pembayaran_peserta'         => $request->getVar('pembayaran_peserta'),
            'pemberi_kerja_peserta'      => $request->getVar('pemberi_kerja_peserta'),
            'jumlah_pembayaran'          => $request->getVar('jumlah_pembayaran'),
            'peserta_produk_id'          => $request->getVar('peserta_produk_id'),
            'peserta_produk_unique_code' => $pesertaProduk['peserta_produk_unique_code'],
            'nama_produk'                => $pesertaProduk['nama_produk'],
            'status'                     => $request->getVar('status'),

            'created_date'               => date('Y-m-d H:i:s'),
            'created_by'                 => $user->data->email,
            'deleted_status'             => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'peserta_iuran_unique_code'  => $request->getVar('peserta_iuran_unique_code'),
            'bulan'                      => $request->getVar('bulan'),
            'tahun'                      => $request->getVar('tahun'),
            'peserta_id'                 => $request->getVar('peserta_id'),
            'peserta_unique_code'        => $request->getVar('peserta_unique_code'),
            'nama_peserta'               => $request->getVar('nama_peserta'),
            'nomor_peserta'              => $request->getVar('nomor_peserta'),
            'pembayaran_peserta'         => $request->getVar('pembayaran_peserta'),
            'pemberi_kerja_peserta'      => $request->getVar('pemberi_kerja_peserta'),
            'jumlah_pembayaran'          => $request->getVar('jumlah_pembayaran'),
            'peserta_produk_id'          => $request->getVar('peserta_produk_id'),
            'peserta_produk_unique_code' => $request->getVar('peserta_produk_unique_code'),
            'nama_produk'                => $request->getVar('nama_produk'),
            'status'                     => $request->getVar('status'),

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
