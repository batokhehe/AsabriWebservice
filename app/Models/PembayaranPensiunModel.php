<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranPensiunModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_pembayaran_pensiun';
    protected $primaryKey       ='pembayaran_pensiun_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pembayaran_pensiun_id',
        'pembayaran_pensiun_unique_code',
        'batch_pembayaran_id',
        'batch_pembayaran_unique_code',
        'penerima_pensiun_id',
        'penerima_pensiun_unique_code',
        'nama_penerima_pensiun',
        'mata_anggaran_id',
        'kode_mata_anggaran',
        'nama_mata_anggaran',
        'nilai_pembayaran',
        'bulan',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'tahun',
        'periode_bayar',
        'peserta_id',
        'peserta_unique_code',
        'nomor_peserta',
        'nama_peserta',
        'mitra_bayar_id',
        'mitra_bayar_unique_code',
        'nama_mitra_bayar',
        'mitra_bayar_cabang_id',
        'mitra_bayar_cabang_unique_code',
        'nama_mitra_bayar_cabang',
        'status_pembayaran',
        'kode_transaksi_pembayaran',
        'nama_status_pembayaran',
        'last_payment_update_date',
        'last_payment_update_by',
        'jumlah_pembulatan',
        'jumlah_pensiun_pokok',
        'jumlah_tunjangan',
        'jumlah_potongan',
        'jumlah_pengajuan',
        'jumlah_verifikasi',
        'jumlah_persetujuan',
        'list_pengajuan_json',
        'list_potongan_json',
        'list_verifikasi_json',
        'list_persetujuan_json',
        'nama_kantor_layanan',
        'kantor_layanan_unique_code',
        'kantor_layanan_id',
        'tipe_pembayaran_id',
        'nama_tipe_pembayaran',
        'kode_tipe_pembayaran',
        'kode_jiwa',
        'nama_kode_jiwa',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'pembayaran_pensiun_id'=>'required',
        'pembayaran_pensiun_unique_code'=>'required',
        'batch_pembayaran_id'=>'required',
        'batch_pembayaran_unique_code'=>'required',
        'penerima_pensiun_id'=>'required',
        'penerima_pensiun_unique_code'=>'required',
        'nama_penerima_pensiun'=>'required',
        'mata_anggaran_id'=>'required',
        'kode_mata_anggaran'=>'required',
        'nama_mata_anggaran'=>'required',
        'nilai_pembayaran'=>'required',
        'bulan'=>'required',
        'tahun'=>'required',
        'periode_bayar'=>'required',
        'peserta_id'=>'required',
        'peserta_unique_code'=>'required',
        'nomor_peserta'=>'required',
        'nama_peserta'=>'required',
        'mitra_bayar_id'=>'required',
        'mitra_bayar_unique_code'=>'required',
        'nama_mitra_bayar'=>'required',
        'mitra_bayar_cabang_id'=>'required',
        'mitra_bayar_cabang_unique_code'=>'required',
        'nama_mitra_bayar_cabang'=>'required',
        'status_pembayaran'=>'required',
        'kode_transaksi_pembayaran'=>'required',
        'nama_status_pembayaran'=>'required',
        'last_payment_update_date'=>'required',
        'last_payment_update_by'=>'required',
        'jumlah_pembulatan'=>'required',
        'jumlah_pensiun_pokok'=>'required',
        'jumlah_tunjangan'=>'required',
        'jumlah_potongan'=>'required',
        'jumlah_pengajuan'=>'required',
        'jumlah_verifikasi'=>'required',
        'jumlah_persetujuan'=>'required',
        'list_pengajuan_json'=>'required',
        'list_potongan_json'=>'required',
        'list_verifikasi_json'=>'required',
        'list_persetujuan_json'=>'required',
        'nama_kantor_layanan'=>'required',
        'kantor_layanan_unique_code'=>'required',
        'kantor_layanan_id'=>'required',
        'tipe_pembayaran_id'=>'required',
        'nama_tipe_pembayaran'=>'required',
        'kode_tipe_pembayaran'=>'required',
        'kode_jiwa'=>'required',
        'nama_kode_jiwa'=>'required',

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

    public static function getAll(){
        $model = new PembayaranPensiunModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PembayaranPensiunModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new PembayaranPensiunModel();
        return $model->insert([
            'pembayaran_pensiun_id'=> $request->getVar('pembayaran_pensiun_id'),
            'pembayaran_pensiun_unique_code'=> $request->getVar('pembayaran_pensiun_unique_code'),
            'batch_pembayaran_id'=> $request->getVar('batch_pembayaran_id'),
            'batch_pembayaran_unique_code'=> $request->getVar('batch_pembayaran_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'mata_anggaran_id'=> $request->getVar('mata_anggaran_id'),
            'kode_mata_anggaran'=> $request->getVar('kode_mata_anggaran'),
            'nama_mata_anggaran'=> $request->getVar('nama_mata_anggaran'),
            'nilai_pembayaran'=> $request->getVar('nilai_pembayaran'),
            'bulan'=> $request->getVar('bulan'),
            'tahun'=> $request->getVar('tahun'),
            'periode_bayar'=> $request->getVar('periode_bayar'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nomor_peserta'=> $request->getVar('nomor_peserta'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_cabang_id'=> $request->getVar('mitra_bayar_cabang_id'),
            'mitra_bayar_cabang_unique_code'=> $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar_cabang'=> $request->getVar('nama_mitra_bayar_cabang'),
            'status_pembayaran'=> $request->getVar('status_pembayaran'),
            'kode_transaksi_pembayaran'=> $request->getVar('kode_transaksi_pembayaran'),
            'nama_status_pembayaran'=> $request->getVar('nama_status_pembayaran'),
            'last_payment_update_date'=> $request->getVar('last_payment_update_date'),
            'last_payment_update_by'=> $request->getVar('last_payment_update_by'),
            'jumlah_pembulatan'=> $request->getVar('jumlah_pembulatan'),
            'jumlah_pensiun_pokok'=> $request->getVar('jumlah_pensiun_pokok'),
            'jumlah_tunjangan'=> $request->getVar('jumlah_tunjangan'),
            'jumlah_potongan'=> $request->getVar('jumlah_potongan'),
            'jumlah_pengajuan'=> $request->getVar('jumlah_pengajuan'),
            'jumlah_verifikasi'=> $request->getVar('jumlah_verifikasi'),
            'jumlah_persetujuan'=> $request->getVar('jumlah_persetujuan'),
            'list_pengajuan_json'=> $request->getVar('list_pengajuan_json'),
            'list_potongan_json'=> $request->getVar('list_potongan_json'),
            'list_verifikasi_json'=> $request->getVar('list_verifikasi_json'),
            'list_persetujuan_json'=> $request->getVar('list_persetujuan_json'),
            'nama_kantor_layanan'=> $request->getVar('nama_kantor_layanan'),
            'kantor_layanan_unique_code'=> $request->getVar('kantor_layanan_unique_code'),
            'kantor_layanan_id'=> $request->getVar('kantor_layanan_id'),
            'tipe_pembayaran_id'=> $request->getVar('tipe_pembayaran_id'),
            'nama_tipe_pembayaran'=> $request->getVar('nama_tipe_pembayaran'),
            'kode_tipe_pembayaran'=> $request->getVar('kode_tipe_pembayaran'),
            'kode_jiwa'=> $request->getVar('kode_jiwa'),
            'nama_kode_jiwa'=> $request->getVar('nama_kode_jiwa'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new PembayaranPensiunModel();
        return $model->update($id, [
            'pembayaran_pensiun_id'=> $request->getVar('pembayaran_pensiun_id'),
            'pembayaran_pensiun_unique_code'=> $request->getVar('pembayaran_pensiun_unique_code'),
            'batch_pembayaran_id'=> $request->getVar('batch_pembayaran_id'),
            'batch_pembayaran_unique_code'=> $request->getVar('batch_pembayaran_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'mata_anggaran_id'=> $request->getVar('mata_anggaran_id'),
            'kode_mata_anggaran'=> $request->getVar('kode_mata_anggaran'),
            'nama_mata_anggaran'=> $request->getVar('nama_mata_anggaran'),
            'nilai_pembayaran'=> $request->getVar('nilai_pembayaran'),
            'bulan'=> $request->getVar('bulan'),
            'tahun'=> $request->getVar('tahun'),
            'periode_bayar'=> $request->getVar('periode_bayar'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nomor_peserta'=> $request->getVar('nomor_peserta'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_cabang_id'=> $request->getVar('mitra_bayar_cabang_id'),
            'mitra_bayar_cabang_unique_code'=> $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar_cabang'=> $request->getVar('nama_mitra_bayar_cabang'),
            'status_pembayaran'=> $request->getVar('status_pembayaran'),
            'kode_transaksi_pembayaran'=> $request->getVar('kode_transaksi_pembayaran'),
            'nama_status_pembayaran'=> $request->getVar('nama_status_pembayaran'),
            'last_payment_update_date'=> $request->getVar('last_payment_update_date'),
            'last_payment_update_by'=> $request->getVar('last_payment_update_by'),
            'jumlah_pembulatan'=> $request->getVar('jumlah_pembulatan'),
            'jumlah_pensiun_pokok'=> $request->getVar('jumlah_pensiun_pokok'),
            'jumlah_tunjangan'=> $request->getVar('jumlah_tunjangan'),
            'jumlah_potongan'=> $request->getVar('jumlah_potongan'),
            'jumlah_pengajuan'=> $request->getVar('jumlah_pengajuan'),
            'jumlah_verifikasi'=> $request->getVar('jumlah_verifikasi'),
            'jumlah_persetujuan'=> $request->getVar('jumlah_persetujuan'),
            'list_pengajuan_json'=> $request->getVar('list_pengajuan_json'),
            'list_potongan_json'=> $request->getVar('list_potongan_json'),
            'list_verifikasi_json'=> $request->getVar('list_verifikasi_json'),
            'list_persetujuan_json'=> $request->getVar('list_persetujuan_json'),
            'nama_kantor_layanan'=> $request->getVar('nama_kantor_layanan'),
            'kantor_layanan_unique_code'=> $request->getVar('kantor_layanan_unique_code'),
            'kantor_layanan_id'=> $request->getVar('kantor_layanan_id'),
            'tipe_pembayaran_id'=> $request->getVar('tipe_pembayaran_id'),
            'nama_tipe_pembayaran'=> $request->getVar('nama_tipe_pembayaran'),
            'kode_tipe_pembayaran'=> $request->getVar('kode_tipe_pembayaran'),
            'kode_jiwa'=> $request->getVar('kode_jiwa'),
            'nama_kode_jiwa'=> $request->getVar('nama_kode_jiwa'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new PembayaranPensiunModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
