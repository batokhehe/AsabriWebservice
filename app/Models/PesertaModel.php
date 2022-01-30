<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_peserta';
    protected $primaryKey       = 'peserta_id';
    protected $uniqueCode       = 'peserta_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'nomor_identitas_peserta',
        'nomor_pensiun_peserta',
        'alamat_peserta',
        'pangkat_terakhir_id',
        'pangkat_unique_code',
        'nama_pangkat_terakhir',
        'keterangan',
        'provinsi_id',
        'nama_provinsi',
        'provinsi_unique_code',
        'kota_id',
        'nama_kota',
        'kota_unique_code',
        'kecamatan_id',
        'nama_kecamatan',
        'kecamatan_unique_code',
        'kelurahan_id',
        'nama_kelurahan',
        'kelurahan_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'tanggal_pengangkatan',
        'nomor_skep_pengangkatan',
        'tanggal_skep_pengangkatan',
        'pangkat_awal_id',
        'nama_pangkat_awal',
        'nama_kesatuan',
        'kesatuan_id',
        'nomor_ktpa',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'kode_kantor_cabang',
        'nip_nrp_peserta',
        'nomor_npwp',
        'alamat_rt',
        'alamat_rw',
        'alamat_kodepos',
        'telephone',
        'handphone',
        'nama_ibu_kandung',
        'nama_unit_organisasi',
        'unit_organisasi_id',
        'status_personil',
        'nama_status_personil',
        'status_perkawinan',
        'nama_pasangan',
        'nomor_skep_sprtn',
        'tanggal_skep_sprtn',
        'data_from_spp',
        'spp_is_approve',
        'data_spp_reason',
        'ktpa_status',
        'nilai_gaji_awal',
        'nilai_gaji_terakhir',
        'nilai_pensiun_pokok',
        'mkg_peserta_awal',
        'mkg_peserta',
        'penghasilan_pensiun_id',
        'status_punah',
        'is_vip',
        'security_code',
        'nomor_pensiun',
        'is_pensiun',
        'golongan_pangkat_id',
        'nama_golongan_pangkat',
        'user_id',
        'peserta_date_end',
        'peserta_skep_date_end',
        'nomor_skep_end',
        'tanggal_skep_alih',
        'satuan_kerja',
        'nama_pdw',
        'pendelegasian_wewenang_id',
        'nama_pendelegasian_wewenang',
        'status_hidup',
        'kj_code',
        'nomor_batch',
        'tanggal_batch',
        'nomor_agenda',
        'nomor_dps',
        'is_from_pulta',
        'peserta_pasangan_id',
        'email',
        'password',
        'tanggal_meninggal',
        'nomor_keterangan_sekolah_anak',
        'tanggal_mulai_hilang',
        'tanggal_akhir_hilang',
        'kesatuan_awal_id',
        'nama_kesatuan_awal',
        'is_irja',
        'is_punah',
        'batch_peserta_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'peserta_unique_code'           => 'required',
        'nama_peserta'                  => 'required',
        'nomor_identitas_peserta'       => 'required',
        'nomor_pensiun_peserta'         => 'required',
        'alamat_peserta'                => 'required',
        'pangkat_terakhir_id'           => 'required|is_pangkat_exists[pangkat_terakhir_id]',
        'keterangan'                    => 'required',
        'kelurahan_id'                  => 'required|is_kelurahan_exists[kelurahan_id]',
        'kecamatan_id'                  => 'required|is_kecamatan_exists[kecamatan_id]',
        'kota_id'                       => 'required|is_kota_exists[kota_id]',
        'provinsi_id'                   => 'required|is_provinsi_exists[provinsi_id]',
        'tanggal_lahir'                 => 'required',
        'tempat_lahir'                  => 'required',
        'jenis_kelamin'                 => 'required',
        'tanggal_pengangkatan'          => 'required',
        'nomor_skep_pengangkatan'       => 'required',
        'tanggal_skep_pengangkatan'     => 'required',
        'pangkat_awal_id'               => 'required|is_pangkat_exists[pangkat_awal_id]',
        'kesatuan_id'                   => 'required|is_kesatuan_exists[kesatuan_id]',
        'nomor_ktpa'                    => 'required',
        'kantor_cabang_id'              => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        'nip_nrp_peserta'               => 'required',
        'nomor_npwp'                    => 'required',
        'alamat_rt'                     => 'required',
        'alamat_rw'                     => 'required',
        'alamat_kodepos'                => 'required',
        'telephone'                     => 'required',
        'handphone'                     => 'required',
        'nama_ibu_kandung'              => 'required',
        'unit_organisasi_id'            => 'required|is_unit_organisasi_exists[unit_organisasi_id]',
        'status_personil'               => 'required|is_status_peserta_exists[status_personil]',
        'status_perkawinan'             => 'required',
        'nama_pasangan'                 => 'required',
        'nomor_skep_sprtn'              => 'required',
        'tanggal_skep_sprtn'            => 'required',
        'data_from_spp'                 => 'required',
        'spp_is_approve'                => 'required',
        'data_spp_reason'               => 'required',
        'ktpa_status'                   => 'required',
        'nilai_gaji_awal'               => 'required',
        'nilai_gaji_terakhir'           => 'required',
        'nilai_pensiun_pokok'           => 'required',
        'mkg_peserta_awal'              => 'required',
        'mkg_peserta'                   => 'required',
        'penghasilan_pensiun_id'        => 'required',
        'status_punah'                  => 'required',
        'is_vip'                        => 'required',
        'security_code'                 => 'required',
        'nomor_pensiun'                 => 'required',
        'is_pensiun'                    => 'required',
        'golongan_pangkat_id'           => 'required|is_golongan_pangkat_exists[golongan_pangkat_id]',
        'user_id'                       => 'required',
        'peserta_date_end'              => 'required',
        'peserta_skep_date_end'         => 'required',
        'nomor_skep_end'                => 'required',
        'tanggal_skep_alih'             => 'required',
        'satuan_kerja'                  => 'required',
        'nama_pdw'                      => 'required',
        'pendelegasian_wewenang_id'     => 'required|is_pendelegasian_wewenang_exists[pendelegasian_wewenang_id]',
        'status_hidup'                  => 'required',
        'kj_code'                       => 'required',
        'nomor_batch'                   => 'required',
        'tanggal_batch'                 => 'required',
        'nomor_agenda'                  => 'required',
        'nomor_dps'                     => 'required',
        'is_from_pulta'                 => 'required',
        'peserta_pasangan_id'           => 'required',
        'email'                         => 'required',
        'password'                      => 'required',
        'tanggal_meninggal'             => 'required',
        'nomor_keterangan_sekolah_anak' => 'required',
        'tanggal_mulai_hilang'          => 'required',
        'tanggal_akhir_hilang'          => 'required',
        'kesatuan_awal_id'              => 'required|is_kesatuan_exists[kesatuan_awal_id]',
        'is_irja'                       => 'required',
        'is_punah'                      => 'required',
        'batch_peserta_id'              => 'required|is_batch_peserta_exists[batch_peserta_id]',
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
        $model = new PesertaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $kelurahan             = KelurahanModel::findById($request->getVar('kelurahan_id'));
        $kecamatan             = KecamatanModel::findById($request->getVar('kecamatan_id'));
        $kota                  = KotaModel::findById($request->getVar('kota_id'));
        $provinsi              = ProvinsiModel::findById($request->getVar('provinsi_id'));
        $kantorCabang          = KantorCabangModel::findById($request->getVar('kantor_cabang_id'));
        $pangkatTerakhir       = PangkatModel::findById($request->getVar('pangkat_terakhir_id'));
        $pangkatAwal           = PangkatModel::findById($request->getVar('pangkat_awal_id'));
        $kesatuan              = KesatuanModel::findById($request->getVar('kesatuan_id'));
        $kesatuanAwal          = KesatuanModel::findById($request->getVar('kesatuan_awal_id'));
        $unitOrganisasi        = UnitOrganisasiModel::findById($request->getVar('unit_organisasi_id'));
        $statusPeserta         = StatusPesertaModel::findById($request->getVar('status_personil'));
        $golonganPangkat       = GolonganPangkatModel::findById($request->getVar('golongan_pangkat_id'));
        $pendelegasianWewenang = PendelegasianWewenangModel::findById($request->getVar('pendelegasian_wewenang_id'));

        return $model->insert([
            $model->primaryKey              => $model->getAvailableId($model),
            'peserta_unique_code'           => $request->getVar('peserta_unique_code'),
            'nama_peserta'                  => $request->getVar('nama_peserta'),
            'nomor_identitas_peserta'       => $request->getVar('nomor_identitas_peserta'),
            'nomor_pensiun_peserta'         => $request->getVar('nomor_pensiun_peserta'),
            'alamat_peserta'                => $request->getVar('alamat_peserta'),
            'pangkat_terakhir_id'           => $request->getVar('pangkat_terakhir_id'),
            'pangkat_unique_code'           => $pangkatTerakhir['pangkat_unique_code'],
            'nama_pangkat_terakhir'         => $pangkatTerakhir['nama_pangkat'],
            'keterangan'                    => $request->getVar('keterangan'),
            'provinsi_id'                   => $request->getVar('provinsi_id'),
            'nama_provinsi'                 => $provinsi['nama_provinsi'],
            'provinsi_unique_code'          => $provinsi['provinsi_unique_code'],
            'kota_id'                       => $request->getVar('kota_id'),
            'nama_kota'                     => $kota['nama_kota'],
            'kota_unique_code'              => $kota['kota_unique_code'],
            'kecamatan_id'                  => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                => $kecamatan['nama_kecamatan'],
            'kecamatan_unique_code'         => $kecamatan['kecamatan_unique_code'],
            'kelurahan_id'                  => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                => $kelurahan['nama_kelurahan'],
            'kelurahan_unique_code'         => $kelurahan['kelurahan_unique_code'],
            'tanggal_lahir'                 => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_lahir'))),
            'tempat_lahir'                  => $request->getVar('tempat_lahir'),
            'jenis_kelamin'                 => $request->getVar('jenis_kelamin'),
            'tanggal_pengangkatan'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_pengangkatan'))),
            'nomor_skep_pengangkatan'       => $request->getVar('nomor_skep_pengangkatan'),
            'tanggal_skep_pengangkatan'     => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_pengangkatan'))),
            'pangkat_awal_id'               => $request->getVar('pangkat_awal_id'),
            'nama_pangkat_awal'             => $pangkatAwal['nama_pangkat'],
            'nama_kesatuan'                 => $kesatuan['nama_kesatuan'],
            'kesatuan_id'                   => $request->getVar('kesatuan_id'),
            'nomor_ktpa'                    => $request->getVar('nomor_ktpa'),
            'kantor_cabang_id'              => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'            => $kantorCabang['nama_kantor_cabang'],
            'kode_kantor_cabang'            => $kantorCabang['kode_kantor_cabang'],
            'nip_nrp_peserta'               => $request->getVar('nip_nrp_peserta'),
            'nomor_npwp'                    => $request->getVar('nomor_npwp'),
            'alamat_rt'                     => $request->getVar('alamat_rt'),
            'alamat_rw'                     => $request->getVar('alamat_rw'),
            'alamat_kodepos'                => $request->getVar('alamat_kodepos'),
            'telephone'                     => $request->getVar('telephone'),
            'handphone'                     => $request->getVar('handphone'),
            'nama_ibu_kandung'              => $request->getVar('nama_ibu_kandung'),
            'nama_unit_organisasi'          => $unitOrganisasi['nama_unit_organisasi'],
            'unit_organisasi_id'            => $request->getVar('unit_organisasi_id'),
            'status_personil'               => $request->getVar('status_personil'),
            'nama_status_personil'          => $statusPeserta['nama_status_peserta'],
            'status_perkawinan'             => $request->getVar('status_perkawinan'),
            'nama_pasangan'                 => $request->getVar('nama_pasangan'),
            'nomor_skep_sprtn'              => $request->getVar('nomor_skep_sprtn'),
            'tanggal_skep_sprtn'            => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_sprtn'))),
            'data_from_spp'                 => $request->getVar('data_from_spp'),
            'spp_is_approve'                => $request->getVar('spp_is_approve'),
            'data_spp_reason'               => $request->getVar('data_spp_reason'),
            'ktpa_status'                   => $request->getVar('ktpa_status'),
            'nilai_gaji_awal'               => $request->getVar('nilai_gaji_awal'),
            'nilai_gaji_terakhir'           => $request->getVar('nilai_gaji_terakhir'),
            'nilai_pensiun_pokok'           => $request->getVar('nilai_pensiun_pokok'),
            'mkg_peserta_awal'              => $request->getVar('mkg_peserta_awal'),
            'mkg_peserta'                   => $request->getVar('mkg_peserta'),
            'penghasilan_pensiun_id'        => $request->getVar('penghasilan_pensiun_id'),
            'status_punah'                  => $request->getVar('status_punah'),
            'is_vip'                        => $request->getVar('is_vip'),
            'security_code'                 => $request->getVar('security_code'),
            'nomor_pensiun'                 => $request->getVar('nomor_pensiun'),
            'is_pensiun'                    => $request->getVar('is_pensiun'),
            'golongan_pangkat_id'           => $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'         => $golonganPangkat['nama_golongan_pangkat'],
            'user_id'                       => $request->getVar('user_id'),
            'peserta_date_end'              => date('Y-m-d H:i:s', strtotime($request->getVar('peserta_date_end'))),
            'peserta_skep_date_end'         => date('Y-m-d H:i:s', strtotime($request->getVar('peserta_skep_date_end'))),
            'nomor_skep_end'                => $request->getVar('nomor_skep_end'),
            'tanggal_skep_alih'             => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_alih'))),
            'satuan_kerja'                  => $request->getVar('satuan_kerja'),
            'nama_pdw'                      => $request->getVar('nama_pdw'),
            'pendelegasian_wewenang_id'     => $request->getVar('pendelegasian_wewenang_id'),
            'nama_pendelegasian_wewenang'   => $pendelegasianWewenang['nama_pendelegasian_wewenang'],
            'status_hidup'                  => $request->getVar('status_hidup'),
            'kj_code'                       => $request->getVar('kj_code'),
            'nomor_batch'                   => $request->getVar('nomor_batch'),
            'tanggal_batch'                 => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_batch'))),
            'nomor_agenda'                  => $request->getVar('nomor_agenda'),
            'nomor_dps'                     => $request->getVar('nomor_dps'),
            'is_from_pulta'                 => $request->getVar('is_from_pulta'),
            'peserta_pasangan_id'           => $request->getVar('peserta_pasangan_id'),
            'email'                         => $request->getVar('email'),
            'password'                      => $request->getVar('password'),
            'tanggal_meninggal'             => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_meninggal'))),
            'nomor_keterangan_sekolah_anak' => $request->getVar('nomor_keterangan_sekolah_anak'),
            'tanggal_mulai_hilang'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_mulai_hilang'))),
            'tanggal_akhir_hilang'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_akhir_hilang'))),
            'kesatuan_awal_id'              => $request->getVar('kesatuan_awal_id'),
            'nama_kesatuan_awal'            => $kesatuanAwal['nama_kesatuan'],
            'is_irja'                       => $request->getVar('is_irja'),
            'is_punah'                      => $request->getVar('is_punah'),
            'batch_peserta_id'              => $request->getVar('batch_peserta_id'),

            'created_date'                  => date('Y-m-d H:i:s'),
            'created_by'                    => $user->data->email,
            'deleted_status'                => 0,
        ]);

    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'peserta_unique_code'           => $request->getVar('peserta_unique_code'),
            'nama_peserta'                  => $request->getVar('nama_peserta'),
            'nomor_identitas_peserta'       => $request->getVar('nomor_identitas_peserta'),
            'nomor_pensiun_peserta'         => $request->getVar('nomor_pensiun_peserta'),
            'alamat_peserta'                => $request->getVar('alamat_peserta'),
            'pangkat_terakhir_id'           => $request->getVar('pangkat_terakhir_id'),
            'pangkat_unique_code'           => $request->getVar('pangkat_unique_code'),
            'nama_pangkat_terakhir'         => $request->getVar('nama_pangkat_terakhir'),
            'keterangan'                    => $request->getVar('keterangan'),
            'provinsi_id'                   => $request->getVar('provinsi_id'),
            'nama_provinsi'                 => $request->getVar('nama_provinsi'),
            'provinsi_unique_code'          => $request->getVar('provinsi_unique_code'),
            'kota_id'                       => $request->getVar('kota_id'),
            'nama_kota'                     => $request->getVar('nama_kota'),
            'kota_unique_code'              => $request->getVar('kota_unique_code'),
            'kecamatan_id'                  => $request->getVar('kecamatan_id'),
            'nama_kecamatan'                => $request->getVar('nama_kecamatan'),
            'kecamatan_unique_code'         => $request->getVar('kecamatan_unique_code'),
            'kelurahan_id'                  => $request->getVar('kelurahan_id'),
            'nama_kelurahan'                => $request->getVar('nama_kelurahan'),
            'kelurahan_unique_code'         => $request->getVar('kelurahan_unique_code'),
            'tanggal_lahir'                 => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_lahir'))),
            'tempat_lahir'                  => $request->getVar('tempat_lahir'),
            'jenis_kelamin'                 => $request->getVar('jenis_kelamin'),
            'tanggal_pengangkatan'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_pengangkatan'))),
            'nomor_skep_pengangkatan'       => $request->getVar('nomor_skep_pengangkatan'),
            'tanggal_skep_pengangkatan'     => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_pengangkatan'))),
            'pangkat_awal_id'               => $request->getVar('pangkat_awal_id'),
            'nama_pangkat_awal'             => $request->getVar('nama_pangkat_awal'),
            'nama_kesatuan'                 => $request->getVar('nama_kesatuan'),
            'kesatuan_id'                   => $request->getVar('kesatuan_id'),
            'nomor_ktpa'                    => $request->getVar('nomor_ktpa'),
            'kantor_cabang_id'              => $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'            => $request->getVar('nama_kantor_cabang'),
            'kode_kantor_cabang'            => $request->getVar('kode_kantor_cabang'),
            'nip_nrp_peserta'               => $request->getVar('nip_nrp_peserta'),
            'nomor_npwp'                    => $request->getVar('nomor_npwp'),
            'alamat_rt'                     => $request->getVar('alamat_rt'),
            'alamat_rw'                     => $request->getVar('alamat_rw'),
            'alamat_kodepos'                => $request->getVar('alamat_kodepos'),
            'telephone'                     => $request->getVar('telephone'),
            'handphone'                     => $request->getVar('handphone'),
            'nama_ibu_kandung'              => $request->getVar('nama_ibu_kandung'),
            'nama_unit_organisasi'          => $request->getVar('nama_unit_organisasi'),
            'unit_organisasi_id'            => $request->getVar('unit_organisasi_id'),
            'status_personil'               => $request->getVar('status_personil'),
            'nama_status_personil'          => $request->getVar('nama_status_personil'),
            'status_perkawinan'             => $request->getVar('status_perkawinan'),
            'nama_pasangan'                 => $request->getVar('nama_pasangan'),
            'nomor_skep_sprtn'              => $request->getVar('nomor_skep_sprtn'),
            'tanggal_skep_sprtn'            => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_sprtn'))),
            'data_from_spp'                 => $request->getVar('data_from_spp'),
            'spp_is_approve'                => $request->getVar('spp_is_approve'),
            'data_spp_reason'               => $request->getVar('data_spp_reason'),
            'ktpa_status'                   => $request->getVar('ktpa_status'),
            'nilai_gaji_awal'               => $request->getVar('nilai_gaji_awal'),
            'nilai_gaji_terakhir'           => $request->getVar('nilai_gaji_terakhir'),
            'nilai_pensiun_pokok'           => $request->getVar('nilai_pensiun_pokok'),
            'mkg_peserta_awal'              => $request->getVar('mkg_peserta_awal'),
            'mkg_peserta'                   => $request->getVar('mkg_peserta'),
            'penghasilan_pensiun_id'        => $request->getVar('penghasilan_pensiun_id'),
            'status_punah'                  => $request->getVar('status_punah'),
            'is_vip'                        => $request->getVar('is_vip'),
            'security_code'                 => $request->getVar('security_code'),
            'nomor_pensiun'                 => $request->getVar('nomor_pensiun'),
            'is_pensiun'                    => $request->getVar('is_pensiun'),
            'golongan_pangkat_id'           => $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'         => $request->getVar('nama_golongan_pangkat'),
            'user_id'                       => $request->getVar('user_id'),
            'peserta_date_end'              => $request->getVar('peserta_date_end'),
            'peserta_skep_date_end'         => $request->getVar('peserta_skep_date_end'),
            'nomor_skep_end'                => $request->getVar('nomor_skep_end'),
            'tanggal_skep_alih'             => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_skep_alih'))),
            'satuan_kerja'                  => $request->getVar('satuan_kerja'),
            'nama_pdw'                      => $request->getVar('nama_pdw'),
            'pendelegasian_wewenang_id'     => $request->getVar('pendelegasian_wewenang_id'),
            'nama_pendelegasian_wewenang'   => $request->getVar('nama_pendelegasian_wewenang'),
            'status_hidup'                  => $request->getVar('status_hidup'),
            'kj_code'                       => $request->getVar('kj_code'),
            'nomor_batch'                   => $request->getVar('nomor_batch'),
            'tanggal_batch'                 => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_batch'))),
            'nomor_agenda'                  => $request->getVar('nomor_agenda'),
            'nomor_dps'                     => $request->getVar('nomor_dps'),
            'is_from_pulta'                 => $request->getVar('is_from_pulta'),
            'peserta_pasangan_id'           => $request->getVar('peserta_pasangan_id'),
            'email'                         => $request->getVar('email'),
            'password'                      => $request->getVar('password'),
            'tanggal_meninggal'             => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_meninggal'))),
            'nomor_keterangan_sekolah_anak' => $request->getVar('nomor_keterangan_sekolah_anak'),
            'tanggal_mulai_hilang'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_mulai_hilang'))),
            'tanggal_akhir_hilang'          => date('Y-m-d H:i:s', strtotime($request->getVar('tanggal_akhir_hilang'))),
            'kesatuan_awal_id'              => $request->getVar('kesatuan_awal_id'),
            'nama_kesatuan_awal'            => $request->getVar('nama_kesatuan_awal'),
            'is_irja'                       => $request->getVar('is_irja'),
            'is_punah'                      => $request->getVar('is_punah'),
            'batch_peserta_id'              => $request->getVar('batch_peserta_id'),

            'last_update_by'                => $user->data->email,
            'last_update_date'              => date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user)
    {
        $model = new PesertaModel();
        $model->update($id, [
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
