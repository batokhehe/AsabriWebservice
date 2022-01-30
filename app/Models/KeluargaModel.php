<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_keluarga';
    protected $primaryKey       = 'keluarga_id';
    protected $uniqueCode       = 'keluarga_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'keluarga_id',
        'keluarga_unique_code',
        'nama_keluarga',
        'nomor_identitas_keluarga',
        'tempat_lahir',
        'tanggal_lahir',
        'status_peserta_id',
        'nama_status_peserta',
        'alamat',
        'peserta_id',
        'nama_peserta',
        'peserta_unique_code',
        'jenis_relasi_id',
        'nama_jenis_relasi',
        'parent_id',
        'nama_parent',
        'parent_unique_code',
        'pekerjaan_id',
        'nama_pekerjaan',
        'keterangan',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'tanggal_meninggal',
        'tanggal_bercerai',
        'tanggal_selesai_sekolah',
        'kelurahan',
        'kelurahan_id',
        'kecamatan',
        'kecamatan_id',
        'kota_id',
        'kota',
        'provinsi_id',
        'provinsi',
        'alamat_rt',
        'alamat_rw',
        'nama_ibu',
        'telephone',
        'handphone',
        'email',
        'kode_pos',
        'nomor_ktpa',
        'nomor_npwp',
        'kode_jiwa',
        'nrp_nip',
        'tanggal_pernikahan',
        'nomor_akta_nikah',
        'nomor_akta_cerai',
        'nomor_akta_lahir',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'keluarga_unique_code'     => 'required',
        'nama_keluarga'            => 'required',
        'nomor_identitas_keluarga' => 'required',
        'tempat_lahir'             => 'required',
        'tanggal_lahir'            => 'required',
        'status_peserta_id'        => 'required|is_status_peserta_exists[status_peserta_id]',
        'alamat'                   => 'required',
        'peserta_id'               => 'required|is_peserta_exists[peserta_id]',
        'jenis_relasi_id'          => 'required|is_jenis_relasi_exists[jenis_relasi_id]',
        'parent_id'                => 'required',
        'nama_parent'              => 'required',
        'parent_unique_code'       => 'required',
        'pekerjaan_id'             => 'required|is_pekerjaan_exists[pekerjaan_id]',
        'keterangan'               => 'required',
        'tanggal_meninggal'        => 'required',
        'tanggal_bercerai'         => 'required',
        'tanggal_selesai_sekolah'  => 'required',
        'kelurahan_id'             => 'required|is_kelurahan_exists[kelurahan_id]',
        'kecamatan_id'             => 'required|is_kecamatan_exists[kecamatan_id]',
        'kota_id'                  => 'required|is_kota_exists[kota_id]',
        'provinsi_id'              => 'required|is_provinsi_exists[provinsi_id]',
        'alamat_rt'                => 'required',
        'alamat_rw'                => 'required',
        'nama_ibu'                 => 'required',
        'telephone'                => 'required',
        'handphone'                => 'required',
        'email'                    => 'required',
        'kode_pos'                 => 'required',
        'nomor_ktpa'               => 'required',
        'nomor_npwp'               => 'required',
        'kode_jiwa'                => 'required',
        'nrp_nip'                  => 'required',
        'tanggal_pernikahan'       => 'required',
        'nomor_akta_nikah'         => 'required',
        'nomor_akta_cerai'         => 'required',
        'nomor_akta_lahir'         => 'required',
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
        $model = new KeluargaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KeluargaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelurahan     = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan     = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota          = KotaModel::findById($request->getVar('kota_id'));
        $provinsi      = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $jenisRelasi   = JenisRelasiModel::findById($request->getVar('jenis_relasi_id'));
        $peserta       = PesertaModel::findById($request->getVar('peserta_id'));
        $statusPeserta = StatusPesertaModel::findById($request->getVar('status_peserta_id'));
        $pekerjaan     = PekerjaanModel::findById($request->getVar('pekerjaan_id'));
        return $model->insert([
            $model->primaryKey         => $model->getAvailableId($model),
            'keluarga_unique_code'     => $request->getVar('keluarga_unique_code'),
            'nama_keluarga'            => $request->getVar('nama_keluarga'),
            'nomor_identitas_keluarga' => $request->getVar('nomor_identitas_keluarga'),
            'tempat_lahir'             => $request->getVar('tempat_lahir'),
            'tanggal_lahir'            => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_lahir'))),
            'status_peserta_id'        => $request->getVar('status_peserta_id'),
            'nama_status_peserta'      => $statusPeserta['nama_status_peserta'],
            'alamat'                   => $request->getVar('alamat'),
            'peserta_id'               => $request->getVar('peserta_id'),
            'nama_peserta'             => $peserta['nama_peserta'],
            'peserta_unique_code'      => $peserta['peserta_unique_code'],
            'jenis_relasi_id'          => $request->getVar('jenis_relasi_id'),
            'nama_jenis_relasi'        => $provinsi['nama_provinsi'],
            'parent_id'                => $request->getVar('parent_id'),
            'nama_parent'              => $request->getVar('nama_parent'),
            'parent_unique_code'       => $request->getVar('parent_unique_code'),
            'pekerjaan_id'             => $request->getVar('pekerjaan_id'),
            'nama_pekerjaan'           => $pekerjaan['nama_pekerjaan'],
            'keterangan'               => $request->getVar('keterangan'),
            'tanggal_meninggal'        => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_meninggal'))),
            'tanggal_bercerai'         => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_bercerai'))),
            'tanggal_selesai_sekolah'  => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_selesai_sekolah'))),
            'kelurahan'                => $kelurahan['nama_kelurahan'],
            'kelurahan_id'             => $request->getVar('kelurahan_id'),
            'kecamatan'                => $kecamatan['nama_kecamatan'],
            'kecamatan_id'             => $request->getVar('kecamatan_id'),
            'kota_id'                  => $request->getVar('kota_id'),
            'kota'                     => $kota['nama_kota'],
            'provinsi_id'              => $request->getVar('provinsi_id'),
            'provinsi'                 => $provinsi['nama_provinsi'],
            'alamat_rt'                => $request->getVar('alamat_rt'),
            'alamat_rw'                => $request->getVar('alamat_rw'),
            'nama_ibu'                 => $request->getVar('nama_ibu'),
            'telephone'                => $request->getVar('telephone'),
            'handphone'                => $request->getVar('handphone'),
            'email'                    => $request->getVar('email'),
            'kode_pos'                 => $request->getVar('kode_pos'),
            'nomor_ktpa'               => $request->getVar('nomor_ktpa'),
            'nomor_npwp'               => $request->getVar('nomor_npwp'),
            'kode_jiwa'                => $request->getVar('kode_jiwa'),
            'nrp_nip'                  => $request->getVar('nrp_nip'),
            'tanggal_pernikahan'       => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_pernikahan'))),
            'nomor_akta_nikah'         => $request->getVar('nomor_akta_nikah'),
            'nomor_akta_cerai'         => $request->getVar('nomor_akta_cerai'),
            'nomor_akta_lahir'         => $request->getVar('nomor_akta_lahir'),

            'created_date'             => date('Y-m-d H:i:s'),
            'created_by'               => $user->data->email,
            'deleted_status'           => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $kelurahan     = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan     = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota          = KotaModel::findById($request->getVar('kota_id'));
        $provinsi      = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $jenisRelasi   = JenisRelasiModel::findById($request->getVar('jenis_relasi_id'));
        $peserta       = PesertaModel::findById($request->getVar('peserta_id'));
        $statusPeserta = PesertaModel::findById($request->getVar('status_peserta_id'));
        return $model->update($id, [
            'keluarga_unique_code'     => $request->getVar('keluarga_unique_code'),
            'nama_keluarga'            => $request->getVar('nama_keluarga'),
            'nomor_identitas_keluarga' => $request->getVar('nomor_identitas_keluarga'),
            'tempat_lahir'             => $request->getVar('tempat_lahir'),
            'tanggal_lahir'            => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_lahir'))),
            'status_peserta_id'        => $request->getVar('status_peserta_id'),
            'nama_status_peserta'      => $statusPeserta['nama_status_peserta'],
            'alamat'                   => $request->getVar('alamat'),
            'peserta_id'               => $request->getVar('peserta_id'),
            'nama_peserta'             => $peserta['nama_peserta'],
            'peserta_unique_code'      => $peserta['peserta_unique_code'],
            'jenis_relasi_id'          => $request->getVar('jenis_relasi_id'),
            'nama_jenis_relasi'        => $provinsi['nama_provinsi'],
            'parent_id'                => $request->getVar('parent_id'),
            'nama_parent'              => $request->getVar('nama_parent'),
            'parent_unique_code'       => $request->getVar('parent_unique_code'),
            'pekerjaan_id'             => $request->getVar('pekerjaan_id'),
            'nama_pekerjaan'           => $request->getVar('nama_pekerjaan'),
            'keterangan'               => $request->getVar('keterangan'),
            'tanggal_meninggal'        => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_meninggal'))),
            'tanggal_bercerai'         => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_bercerai'))),
            'tanggal_selesai_sekolah'  => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_selesai_sekolah'))),
            'kelurahan'                => $kelurahan['nama_kelurahan'],
            'kelurahan_id'             => $request->getVar('kelurahan_id'),
            'kecamatan'                => $kecamatan['nama_kecamatan'],
            'kecamatan_id'             => $request->getVar('kecamatan_id'),
            'kota_id'                  => $request->getVar('kota_id'),
            'kota'                     => $kota['nama_kota'],
            'provinsi_id'              => $request->getVar('provinsi_id'),
            'provinsi'                 => $provinsi['nama_provinsi'],
            'alamat_rt'                => $request->getVar('alamat_rt'),
            'alamat_rw'                => $request->getVar('alamat_rw'),
            'nama_ibu'                 => $request->getVar('nama_ibu'),
            'telephone'                => $request->getVar('telephone'),
            'handphone'                => $request->getVar('handphone'),
            'email'                    => $request->getVar('email'),
            'kode_pos'                 => $request->getVar('kode_pos'),
            'nomor_ktpa'               => $request->getVar('nomor_ktpa'),
            'nomor_npwp'               => $request->getVar('nomor_npwp'),
            'kode_jiwa'                => $request->getVar('kode_jiwa'),
            'nrp_nip'                  => $request->getVar('nrp_nip'),
            'tanggal_pernikahan'       => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_pernikahan'))),
            'nomor_akta_nikah'         => $request->getVar('nomor_akta_nikah'),
            'nomor_akta_cerai'         => $request->getVar('nomor_akta_cerai'),
            'nomor_akta_lahir'         => $request->getVar('nomor_akta_lahir'),

            'last_update_by'           => $user->data->email,
            'last_update_date'         => date('Y-m-d H:i:s'),
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
