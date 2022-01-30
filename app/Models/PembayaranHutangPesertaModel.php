<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranHutangPesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_pembayaran_hutang_peserta';
    protected $primaryKey       = 'pembayaran_hutang_peserta_id';
    protected $uniqueCode       = 'pembayaran_hutang_peserta_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pembayaran_hutang_peserta_id',
        'pembayaran_hutang_peserta_unique_code',
        'peserta_hutang_id',
        'peserta_hutang_unique_code',
        'jumlah_pembayaran',
        'jumlah_persetujuan',
        'nilai_hutang_sebelum_pembayaran',
        'nilai_sisa_hutang_setelah_pembayaran',
        'tanggal_pembayaran',
        'tanggal_persetujuan',
        'status',
        'keterangan',
        'created_by',
        'created_date',
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
        'pembayaran_hutang_peserta_unique_code' => 'required',
        'peserta_hutang_id'                     => 'required|is_peserta_hutang_exists[peserta_hutang_id]',
        'jumlah_pembayaran'                     => 'required',
        'jumlah_persetujuan'                    => 'required',
        'nilai_hutang_sebelum_pembayaran'       => 'required',
        'nilai_sisa_hutang_setelah_pembayaran'  => 'required',
        'tanggal_pembayaran'                    => 'required',
        'tanggal_persetujuan'                   => 'required',
        'status'                                => 'required',
        'keterangan'                            => 'required',

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
        $model = new PembayaranHutangPesertaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PembayaranHutangPesertaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $pesertaHutang = PesertaHutangModel::findById($request->getVar('peserta_hutang_id'));

        return $model->insert([
            $model->primaryKey                      => $model->getAvailableId($model),
            'pembayaran_hutang_peserta_unique_code' => $request->getVar('pembayaran_hutang_peserta_unique_code'),
            'peserta_hutang_id'                     => $request->getVar('peserta_hutang_id'),
            'peserta_hutang_unique_code'            => $pesertaHutang['peserta_hutang_unique_code'],
            'jumlah_pembayaran'                     => $request->getVar('jumlah_pembayaran'),
            'jumlah_persetujuan'                    => $request->getVar('jumlah_persetujuan'),
            'nilai_hutang_sebelum_pembayaran'       => $request->getVar('nilai_hutang_sebelum_pembayaran'),
            'nilai_sisa_hutang_setelah_pembayaran'  => $request->getVar('nilai_sisa_hutang_setelah_pembayaran'),
            'tanggal_pembayaran'                    => $request->getVar('tanggal_pembayaran'),
            'tanggal_persetujuan'                   => $request->getVar('tanggal_persetujuan'),
            'status'                                => $request->getVar('status'),
            'keterangan'                            => $request->getVar('keterangan'),

            'created_by'                            => $user->data->email,
            'created_date'                          => date('Y-m-d H:i:s'),
            'deleted_status'                        => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $pesertaHutang = PesertaHutangModel::findById($request->getVar('peserta_hutang_id'));

        return $model->update($id, [
            'pembayaran_hutang_peserta_unique_code' => $request->getVar('pembayaran_hutang_peserta_unique_code'),
            'peserta_hutang_id'                     => $request->getVar('peserta_hutang_id'),
            'peserta_hutang_unique_code'            => $pesertaHutang['peserta_hutang_unique_code'],
            'jumlah_pembayaran'                     => $request->getVar('jumlah_pembayaran'),
            'jumlah_persetujuan'                    => $request->getVar('jumlah_persetujuan'),
            'nilai_hutang_sebelum_pembayaran'       => $request->getVar('nilai_hutang_sebelum_pembayaran'),
            'nilai_sisa_hutang_setelah_pembayaran'  => $request->getVar('nilai_sisa_hutang_setelah_pembayaran'),
            'tanggal_pembayaran'                    => $request->getVar('tanggal_pembayaran'),
            'tanggal_persetujuan'                   => $request->getVar('tanggal_persetujuan'),
            'status'                                => $request->getVar('status'),
            'keterangan'                            => $request->getVar('keterangan'),

            'last_update_by'                        => $user->data->email,
            'last_update_date'                      => date('Y-m-d H:i:s'),
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
