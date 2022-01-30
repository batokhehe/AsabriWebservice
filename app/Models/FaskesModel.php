<?php

namespace App\Models;

use CodeIgniter\Model;

class FaskesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_faskes';
    protected $primaryKey       = 'faskes_id';
    protected $uniqueCode       = 'faskes_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'faskes_id',
        'faskes_unique_code',
        'nama_faskes',
        'alamat',
        'status',
        'kelurahan_id',
        'nama_kelurahan',
        'kelurahan_unique_code',
        'kecamatan_id',
        'nama_kecamatan',
        'kecamatan_unique_code',
        'kota_id',
        'nama_kota',
        'kota_unique_code',
        'provinsi_id',
        'nama_provinsi',
        'provinsi_unique_code',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_by',
        'deleted_status',
        'other_kode_provinsi',
        'other_kode_kota',
        'other_kode_kecamatan',
        'other_kode_kelurahan',
        'tipe_faskes',
        'nama_tipe_faskes',
        'rt',
        'rw',
        'status_sosialisasi',
        'status_pks',
        'nama_kantor_cabang',
        'kode_kantor_cabang',
        'kantor_cabang_id',
        'kantor_cabang_unique_code',
        'jenis_penyelenggara',
        'nama_jenis_penyelenggara',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'faskes_unique_code'       => 'required',
        'nama_faskes'              => 'required',
        'alamat'                   => 'required',
        'status'                   => 'required',
        'kelurahan_id'             => 'required|is_kelurahan_exists[kelurahan_id]',
        'kecamatan_id'             => 'required|is_kecamatan_exists[kecamatan_id]',
        'kota_id'                  => 'required|is_kota_exists[kota_id]',
        'provinsi_id'              => 'required|is_provinsi_exists[provinsi_id]',
        'tipe_faskes'              => 'required',
        'nama_tipe_faskes'         => 'required',
        'rt'                       => 'required',
        'rw'                       => 'required',
        'status_sosialisasi'       => 'required',
        'status_pks'               => 'required',
        'kantor_cabang_id'         => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        'jenis_penyelenggara'      => 'required',
        'nama_jenis_penyelenggara' => 'required',
        'nama_bank'                => 'required',
        'nomor_rekening'           => 'required',
        'nama_rekening'            => 'required',

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
        $model = new FaskesModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new FaskesModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelurahan    = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan    = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota         = KotaModel::findById($request->getVar('kota_id'));
        $provinsi     = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $kantorCabang = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));
        return $model->insert([
            $model->primaryKey          => $model->getAvailableId($model),
            'faskes_unique_code'        => $request->getVar('faskes_unique_code'),
            'nama_faskes'               => $request->getVar('nama_faskes'),
            'alamat'                    => $request->getVar('alamat'),
            'status'                    => $request->getVar('status'),
            'kelurahan_id'              => $request->getVar('kelurahan_id'),
            'nama_kelurahan'            => $kelurahan['nama_kelurahan'],
            'kelurahan_unique_code'     => $kelurahan['kelurahan_unique_code'],
            'kecamatan_id'              => $request->getVar('kecamatan_id'),
            'nama_kecamatan'            => $kecamatan['nama_kecamatan'],
            'kecamatan_unique_code'     => $kecamatan['kecamatan_unique_code'],
            'kota_id'                   => $request->getVar('kota_id'),
            'nama_kota'                 => $kota['nama_kota'],
            'kota_unique_code'          => $kota['kota_unique_code'],
            'provinsi_id'               => $request->getVar('provinsi_id'),
            'nama_provinsi'             => $provinsi['nama_provinsi'],
            'provinsi_unique_code'      => $provinsi['provinsi_unique_code'],
            'other_kode_provinsi'       => $provinsi['other_kode_provinsi'],
            'other_kode_kota'           => $kota['other_kode_kota'],
            'other_kode_kecamatan'      => $kecamatan['other_kecamatan_code'],
            'other_kode_kelurahan'      => $kelurahan['other_kode_kelurahan'],
            'tipe_faskes'               => $request->getVar('tipe_faskes'),
            'nama_tipe_faskes'          => $request->getVar('nama_tipe_faskes'),
            'rt'                        => $request->getVar('rt'),
            'rw'                        => $request->getVar('rw'),
            'status_sosialisasi'        => $request->getVar('status_sosialisasi'),
            'status_pks'                => $request->getVar('status_pks'),
            'nama_kantor_cabang'        => $kantorCabang['nama_kantor_cabang'],
            'kode_kantor_cabang'        => $kantorCabang['kode_kantor_cabang'],
            'kantor_cabang_id'          => $request->getVar('kantor_cabang_id'),
            'kantor_cabang_unique_code' => $kantorCabang['kantor_cabang_unique_code'],
            'jenis_penyelenggara'       => $request->getVar('jenis_penyelenggara'),
            'nama_jenis_penyelenggara'  => $request->getVar('nama_jenis_penyelenggara'),
            'nama_bank'                 => $request->getVar('nama_bank'),
            'nomor_rekening'            => $request->getVar('nomor_rekening'),
            'nama_rekening'             => $request->getVar('nama_rekening'),

            'created_date'              => date('Y-m-d H:i:s'),
            'created_by'                => $user->data->email,
            'deleted_status'            => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $kelurahan    = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan    = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota         = KotaModel::findById($request->getVar('kota_id'));
        $provinsi     = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $kantorCabang = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));
        return $model->update($id, [
            'faskes_unique_code'        => $request->getVar('faskes_unique_code'),
            'nama_faskes'               => $request->getVar('nama_faskes'),
            'alamat'                    => $request->getVar('alamat'),
            'status'                    => $request->getVar('status'),
            'kelurahan_id'              => $request->getVar('kelurahan_id'),
            'nama_kelurahan'            => $kelurahan['nama_kelurahan'],
            'kelurahan_unique_code'     => $kelurahan['kelurahan_unique_code'],
            'kecamatan_id'              => $request->getVar('kecamatan_id'),
            'nama_kecamatan'            => $kecamatan['nama_kecamatan'],
            'kecamatan_unique_code'     => $kecamatan['kecamatan_unique_code'],
            'kota_id'                   => $request->getVar('kota_id'),
            'nama_kota'                 => $kota['nama_kota'],
            'kota_unique_code'          => $kota['kota_unique_code'],
            'provinsi_id'               => $request->getVar('provinsi_id'),
            'nama_provinsi'             => $provinsi['nama_provinsi'],
            'provinsi_unique_code'      => $provinsi['provinsi_unique_code'],
            'other_kode_provinsi'       => $provinsi['other_kode_provinsi'],
            'other_kode_kota'           => $kota['other_kode_kota'],
            'other_kode_kecamatan'      => $kecamatan['other_kecamatan_code'],
            'other_kode_kelurahan'      => $kelurahan['other_kode_kelurahan'],
            'tipe_faskes'               => $request->getVar('tipe_faskes'),
            'nama_tipe_faskes'          => $request->getVar('nama_tipe_faskes'),
            'rt'                        => $request->getVar('rt'),
            'rw'                        => $request->getVar('rw'),
            'status_sosialisasi'        => $request->getVar('status_sosialisasi'),
            'status_pks'                => $request->getVar('status_pks'),
            'nama_kantor_cabang'        => $kantorCabang['nama_kantor_cabang'],
            'kode_kantor_cabang'        => $kantorCabang['kode_kantor_cabang'],
            'kantor_cabang_id'          => $request->getVar('kantor_cabang_id'),
            'kantor_cabang_unique_code' => $kantorCabang['kantor_cabang_unique_code'],
            'jenis_penyelenggara'       => $request->getVar('jenis_penyelenggara'),
            'nama_jenis_penyelenggara'  => $request->getVar('nama_jenis_penyelenggara'),
            'nama_bank'                 => $request->getVar('nama_bank'),
            'nomor_rekening'            => $request->getVar('nomor_rekening'),
            'nama_rekening'             => $request->getVar('nama_rekening'),

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
