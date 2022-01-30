<?php

namespace App\Models;

use CodeIgniter\Model;

class KlaimBatchModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_klaim_batch';
    protected $primaryKey       = 'klaim_batch_id';
    protected $uniqueCode       = 'klaim_batch_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'klaim_batch_id',
        'klaim_batch_unique_code',
        'nomor_klaim_batch',
        'faskes_id',
        'nama_faskes',
        'faskes_unique_code',
        'nama_pengantar',
        'nomor_surat_pengantar',
        'tanggal_surat_pengantar',
        'nama_kesatuan',
        'kesatuan_id',
        'kesatuan_unique_code',
        'nomor_identitas_pengantar',
        'alamat_pengantar',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'kantor_cabang_unique_code',
        'jumlah_dokumen_klaim',
        'jumlah_nilai_klaim',
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
        'klaim_batch_unique_code'   => 'required',
        'nomor_klaim_batch'         => 'required',
        'faskes_id'                 => 'required|is_faskes_exists[faskes_id]',
        'nama_pengantar'            => 'required',
        'nomor_surat_pengantar'     => 'required',
        'tanggal_surat_pengantar'   => 'required',
        'nama_kesatuan'             => 'required',
        'kesatuan_id'               => 'required|is_kesatuan_exists[kesatuan_id]',
        'nomor_identitas_pengantar' => 'required',
        'alamat_pengantar'          => 'required',
        'kantor_cabang_id'          => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        'jumlah_dokumen_klaim'      => 'required',
        'jumlah_nilai_klaim'        => 'required',

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
        $model = new KlaimBatchModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KlaimBatchModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $faskes       = FaskesModel::findById($request->getVar('faskes_id'));
        $kesatuan     = KesatuanModel::findById($request->getVar('kesatuan_id'));
        $kantorCabang = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));

        return $model->insert([
            $model->primaryKey          => $model->getAvailableId($model),
            'klaim_batch_unique_code'   => $request->getVar('klaim_batch_unique_code'),
            'nomor_klaim_batch'         => $request->getVar('nomor_klaim_batch'),
            'faskes_id'                 => $request->getVar('faskes_id'),
            'nama_faskes'               => $faskes['nama_faskes'],
            'faskes_unique_code'        => $faskes['faskes_unique_code'],
            'nama_pengantar'            => $request->getVar('nama_pengantar'),
            'nomor_surat_pengantar'     => $request->getVar('nomor_surat_pengantar'),
            'tanggal_surat_pengantar'   => $request->getVar('tanggal_surat_pengantar'),
            'nama_kesatuan'             => $request->getVar('nama_kesatuan'),
            'kesatuan_id'               => $request->getVar('kesatuan_id'),
            'kesatuan_unique_code'      => $kesatuan['kesatuan_unique_code'],
            'nomor_identitas_pengantar' => $request->getVar('nomor_identitas_pengantar'),
            'alamat_pengantar'          => $request->getVar('alamat_pengantar'),
            'kantor_cabang_id'          => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'        => $kantorCabang['nama_kantor_cabang'],
            'kantor_cabang_unique_code' => $kantorCabang['kantor_cabang_unique_code'],
            'jumlah_dokumen_klaim'      => $request->getVar('jumlah_dokumen_klaim'),
            'jumlah_nilai_klaim'        => $request->getVar('jumlah_nilai_klaim'),

            'created_by'                => $user->data->email,
            'created_date'              => date('Y-m-d H:i:s'),
            'deleted_status'            => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $faskes       = FaskesModel::findById($request->getVar('faskes_id'));
        $kesatuan     = KesatuanModel::findById($request->getVar('kesatuan_id'));
        $kantorCabang = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));

        return $model->update($id, [
            'klaim_batch_unique_code'   => $request->getVar('klaim_batch_unique_code'),
            'nomor_klaim_batch'         => $request->getVar('nomor_klaim_batch'),
            'faskes_id'                 => $request->getVar('faskes_id'),
            'nama_faskes'               => $faskes['nama_faskes'],
            'faskes_unique_code'        => $faskes['faskes_unique_code'],
            'nama_pengantar'            => $request->getVar('nama_pengantar'),
            'nomor_surat_pengantar'     => $request->getVar('nomor_surat_pengantar'),
            'tanggal_surat_pengantar'   => $request->getVar('tanggal_surat_pengantar'),
            'nama_kesatuan'             => $request->getVar('nama_kesatuan'),
            'kesatuan_id'               => $request->getVar('kesatuan_id'),
            'kesatuan_unique_code'      => $kesatuan['kesatuan_unique_code'],
            'nomor_identitas_pengantar' => $request->getVar('nomor_identitas_pengantar'),
            'alamat_pengantar'          => $request->getVar('alamat_pengantar'),
            'kantor_cabang_id'          => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'        => $kantorCabang['nama_kantor_cabang'],
            'kantor_cabang_unique_code' => $kantorCabang['kantor_cabang_unique_code'],
            'jumlah_dokumen_klaim'      => $request->getVar('jumlah_dokumen_klaim'),
            'jumlah_nilai_klaim'        => $request->getVar('jumlah_nilai_klaim'),

            'last_update_by'            => $user->data->email,
            'last_update_date'          => date('Y-m-d H:i:s'),
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
