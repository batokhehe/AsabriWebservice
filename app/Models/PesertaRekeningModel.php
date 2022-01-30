<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaRekeningModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_peserta_rekening';
    protected $primaryKey       = 'peserta_rekening_id';
    protected $uniqueCode       = 'peserta_rekening_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_rekening_id',
        'peserta_rekening_unique_code',
        'peserta_id',
        'nama_peserta',
        'peserta_unique_code',
        'nama_bank',
        'nama_cabang_bank',
        'nomor_rekening',
        'nama_rekening',
        'status',
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
        'cabang_mitra_bayar_id',
        'nama_cabang_mitra_bayar',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'peserta_rekening_unique_code' => 'required',
        'peserta_id'                   => 'required|is_peserta_exists[peserta_id]',
        'nama_bank'                    => 'required',
        'nama_cabang_bank'             => 'required',
        'nomor_rekening'               => 'required',
        'nama_rekening'                => 'required',
        'status'                       => 'required',
        'deskripsi'                    => 'required',
        'mitra_bayar_id'               => 'required|is_mitra_bayar_exists[mitra_bayar_id]',
        'cabang_mitra_bayar_id'        => 'required|is_mitra_bayar_cabang_exists[cabang_mitra_bayar_id]',

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
        $model = new PesertaRekeningModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaRekeningModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta          = PesertaModel::findById($request->getVar('peserta_id'));
        $mitraBayar       = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $mitraBayarCabang = MitraBayarCabangModel::findById($request->getVar('cabang_mitra_bayar_id'));

        return $model->insert([
            $model->primaryKey             => $model->getAvailableId($model),
            'peserta_rekening_unique_code' => $request->getVar('peserta_rekening_unique_code'),
            'peserta_id'                   => $request->getVar('peserta_id'),
            'nama_peserta'                 => $peserta['nama_peserta'],
            'peserta_unique_code'          => $peserta['peserta_unique_code'],
            'nama_bank'                    => $request->getVar('nama_bank'),
            'nama_cabang_bank'             => $request->getVar('nama_cabang_bank'),
            'nomor_rekening'               => $request->getVar('nomor_rekening'),
            'nama_rekening'                => $request->getVar('nama_rekening'),
            'status'                       => $request->getVar('status'),
            'deskripsi'                    => $request->getVar('deskripsi'),
            'mitra_bayar_id'               => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'             => $mitraBayar['nama_mitra_bayar'],
            'cabang_mitra_bayar_id'        => $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'      => $mitraBayarCabang['nama_mitra_bayar_cabang'],

            'created_date'                 => date('Y-m-d H:i:s'),
            'created_by'                   => $user->data->email,
            'deleted_status'               => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
    	$peserta          = PesertaModel::findById($request->getVar('peserta_id'));
        $mitraBayar       = MitraBayarModel::findById($request->getVar('mitra_bayar_id'));
        $mitraBayarCabang = MitraBayarCabangModel::findById($request->getVar('cabang_mitra_bayar_id'));
        
        return $model->update($id, [
            'peserta_rekening_unique_code' => $request->getVar('peserta_rekening_unique_code'),
            'peserta_id'                   => $request->getVar('peserta_id'),
            'nama_peserta'                 => $peserta['nama_peserta'],
            'peserta_unique_code'          => $peserta['peserta_unique_code'],
            'nama_bank'                    => $request->getVar('nama_bank'),
            'nama_cabang_bank'             => $request->getVar('nama_cabang_bank'),
            'nomor_rekening'               => $request->getVar('nomor_rekening'),
            'nama_rekening'                => $request->getVar('nama_rekening'),
            'status'                       => $request->getVar('status'),
            'deskripsi'                    => $request->getVar('deskripsi'),
            'mitra_bayar_id'               => $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'             => $mitraBayar['nama_mitra_bayar'],
            'cabang_mitra_bayar_id'        => $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'      => $mitraBayarCabang['nama_mitra_bayar_cabang'],

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
