<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukManfaatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_produk_manfaat';
    protected $primaryKey       = 'produk_manfaat_id';
    protected $uniqueCode       = 'produk_manfaat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'produk_manfaat_id',
        'produk_manfaat_unique_code',
        'produk_id',
        'produk_unique_code',
        'nama_produk',
        'manfaat_id',
        'manfaat_unique_code',
        'nama_manfaat',
        'jenis_klaim_id',
        'jenis_klaim_unique_code',
        'nama_jenis_klaim',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_aktif',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'nilai_manfaat',
        'persentase_manfaat',
        'golongan_cacat_id',
        'nama_golongan_cacat',
        'tingkat_cacat_id',
        'nama_tingkat_cacat',
        'golongan_pangkat_id',
        'nama_golongan_pangkat',
        'pengali_manfaat',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'produk_manfaat_unique_code' => 'required',
        'produk_id'                  => 'required|is_produk_exists[produk_id]',
        'manfaat_id'                 => 'required|is_manfaat_exists[manfaat_id]',
        'jenis_klaim_id'             => 'required|is_jenis_klaim_exists[jenis_klaim_id]',
        'tanggal_mulai'              => 'required',
        'tanggal_akhir'              => 'required',
        'is_aktif'                   => 'required',
        'deskripsi'                  => 'required',
        'nilai_manfaat'              => 'required',
        'persentase_manfaat'         => 'required',
        'golongan_cacat_id'          => 'required|is_golongan_cacat_exists[golongan_cacat_id]',
        'tingkat_cacat_id'           => 'required|is_cacat_tingkat_exists[tingkat_cacat_id]',
        'golongan_pangkat_id'        => 'required|is_golongan_pangkat_exists[golongan_pangkat_id]',
        'pengali_manfaat'            => 'required',

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
        $model = new ProdukManfaatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new ProdukManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $produk          = ProdukModel::findById($request->getVar('produk_id'));
        $manfaat         = ManfaatModel::findById($request->getVar('manfaat_id'));
        $jenisKlaim      = JenisKlaimModel::findById($request->getVar('jenis_klaim_id'));
        $golonganCacat   = CacatGolonganModel::findById($request->getVar('golongan_cacat_id'));
        $tingkatCacat    = CacatTingkatModel::findById($request->getVar('tingkat_cacat_id'));
        $golonganPangkat = GolonganPangkatModel::findById($request->getVar('golongan_pangkat_id'));

        return $model->insert([
            'produk_manfaat_unique_code' => $request->getVar('produk_manfaat_unique_code'),
            'produk_id'                  => $request->getVar('produk_id'),
            'produk_unique_code'         => $produk['produk_unique_code'],
            'nama_produk'                => $produk['nama_produk'],
            'manfaat_id'                 => $request->getVar('manfaat_id'),
            'manfaat_unique_code'        => $manfaat['manfaat_unique_code'],
            'nama_manfaat'               => $manfaat['nama_manfaat'],
            'jenis_klaim_id'             => $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'    => $jenisKlaim['jenis_klaim_unique_code'],
            'nama_jenis_klaim'           => $jenisKlaim['nama_jenis_klaim'],
            'tanggal_mulai'              => $request->getVar('tanggal_mulai'),
            'tanggal_akhir'              => $request->getVar('tanggal_akhir'),
            'is_aktif'                   => $request->getVar('is_aktif'),
            'deskripsi'                  => $request->getVar('deskripsi'),
            'nilai_manfaat'              => $request->getVar('nilai_manfaat'),
            'persentase_manfaat'         => $request->getVar('persentase_manfaat'),
            'golongan_cacat_id'          => $request->getVar('golongan_cacat_id'),
            'nama_golongan_cacat'        => $golonganCacat['nama_cacat_golongan'],
            'tingkat_cacat_id'           => $request->getVar('tingkat_cacat_id'),
            'nama_tingkat_cacat'         => $tingkatCacat['nama_cacat_tingkat'],
            'golongan_pangkat_id'        => $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'      => $golonganPangkat['nama_golongan_pangkat'],
            'pengali_manfaat'            => $request->getVar('pengali_manfaat'),

            'created_date'               => date('Y-m-d H:i:s'),
            'created_by'                 => $user->data->email,
            'deleted_status'             => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $produk          = ProdukModel::findById($request->getVar('produk_id'));
        $manfaat         = ManfaatModel::findById($request->getVar('manfaat_id'));
        $jenisKlaim      = JenisKlaimModel::findById($request->getVar('jenis_klaim_id'));
        $golonganCacat   = CacatGolonganModel::findById($request->getVar('golongan_cacat_id'));
        $tingkatCacat    = CacatTingkatModel::findById($request->getVar('tingkat_cacat_id'));
        $golonganPangkat = GolonganPangkatModel::findById($request->getVar('golongan_pangkat_id'));

        return $model->update($id, [
            'produk_manfaat_unique_code' => $request->getVar('produk_manfaat_unique_code'),
            'produk_id'                  => $request->getVar('produk_id'),
            'produk_unique_code'         => $produk['produk_unique_code'],
            'nama_produk'                => $produk['nama_produk'],
            'manfaat_id'                 => $request->getVar('manfaat_id'),
            'manfaat_unique_code'        => $manfaat['manfaat_unique_code'],
            'nama_manfaat'               => $manfaat['nama_manfaat'],
            'jenis_klaim_id'             => $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'    => $jenisKlaim['jenis_klaim_unique_code'],
            'nama_jenis_klaim'           => $jenisKlaim['nama_jenis_klaim'],
            'tanggal_mulai'              => $request->getVar('tanggal_mulai'),
            'tanggal_akhir'              => $request->getVar('tanggal_akhir'),
            'is_aktif'                   => $request->getVar('is_aktif'),
            'deskripsi'                  => $request->getVar('deskripsi'),
            'nilai_manfaat'              => $request->getVar('nilai_manfaat'),
            'persentase_manfaat'         => $request->getVar('persentase_manfaat'),
            'golongan_cacat_id'          => $request->getVar('golongan_cacat_id'),
            'nama_golongan_cacat'        => $golonganCacat['nama_cacat_golongan'],
            'tingkat_cacat_id'           => $request->getVar('tingkat_cacat_id'),
            'nama_tingkat_cacat'         => $tingkatCacat['nama_cacat_tingkat'],
            'golongan_pangkat_id'        => $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'      => $golonganPangkat['nama_golongan_pangkat'],
            'pengali_manfaat'            => $request->getVar('pengali_manfaat'),

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
