<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraBayarModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_mitra_bayar';
    protected $primaryKey       ='mitra_bayar_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'mitra_bayar_id',
        'mitra_bayar_unique_code',
        'nama_mitra_bayar',
        'kode_mitra_bayar',
        'deskripsi',
        'alamat_mitra_bayar',
        'nama_rekening_tampungan',
        'nomor_rekening_tampungan',
        'nomor_pks_pihak_1',
        'nomor_pks_pihak_2',
        'tanggal_pks',
        'longitude',
        'latitude',
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
        'mb_media_id',
        'akronim_mitra_bayar',
        'mb_code_real',
        'mb_child_id',
        'is_online',
        'is_payment_point',
        'subyek_pks',
        'nama_file_pks',
        'nomor_pks_pensiun',
        'status_dapem_non_dapem',
        'rekening_atas_nama',
        'kode_umum_mitra_bayar',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'mitra_bayar_id'=>'required',
        'mitra_bayar_unique_code'=>'required',
        'nama_mitra_bayar'=>'required',
        'kode_mitra_bayar'=>'required',
        'deskripsi'=>'required',
        'alamat_mitra_bayar'=>'required',
        'nama_rekening_tampungan'=>'required',
        'nomor_rekening_tampungan'=>'required',
        'nomor_pks_pihak_1'=>'required',
        'nomor_pks_pihak_2'=>'required',
        'tanggal_pks'=>'required',
        'longitude'=>'required',
        'latitude'=>'required',
        'provinsi_id'=>'required',
        'nama_provinsi'=>'required',
        'provinsi_unique_code'=>'required',
        'kota_id'=>'required',
        'nama_kota'=>'required',
        'kota_unique_code'=>'required',
        'kecamatan_id'=>'required',
        'nama_kecamatan'=>'required',
        'kecamatan_unique_code'=>'required',
        'kelurahan_id'=>'required',
        'nama_kelurahan'=>'required',
        'kelurahan_unique_code'=>'required',
        'mb_media_id'=>'required',
        'akronim_mitra_bayar'=>'required',
        'mb_code_real'=>'required',
        'mb_child_id'=>'required',
        'is_online'=>'required',
        'is_payment_point'=>'required',
        'subyek_pks'=>'required',
        'nama_file_pks'=>'required',
        'nomor_pks_pensiun'=>'required',
        'status_dapem_non_dapem'=>'required',
        'rekening_atas_nama'=>'required',
        'kode_umum_mitra_bayar'=>'required',

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
        $model = new MitraBayarModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new MitraBayarModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new MitraBayarModel();
        return $model->insert([
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'kode_mitra_bayar'=> $request->getVar('kode_mitra_bayar'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'alamat_mitra_bayar'=> $request->getVar('alamat_mitra_bayar'),
            'nama_rekening_tampungan'=> $request->getVar('nama_rekening_tampungan'),
            'nomor_rekening_tampungan'=> $request->getVar('nomor_rekening_tampungan'),
            'nomor_pks_pihak_1'=> $request->getVar('nomor_pks_pihak_1'),
            'nomor_pks_pihak_2'=> $request->getVar('nomor_pks_pihak_2'),
            'tanggal_pks'=> $request->getVar('tanggal_pks'),
            'longitude'=> $request->getVar('longitude'),
            'latitude'=> $request->getVar('latitude'),
            'provinsi_id'=> $request->getVar('provinsi_id'),
            'nama_provinsi'=> $request->getVar('nama_provinsi'),
            'provinsi_unique_code'=> $request->getVar('provinsi_unique_code'),
            'kota_id'=> $request->getVar('kota_id'),
            'nama_kota'=> $request->getVar('nama_kota'),
            'kota_unique_code'=> $request->getVar('kota_unique_code'),
            'kecamatan_id'=> $request->getVar('kecamatan_id'),
            'nama_kecamatan'=> $request->getVar('nama_kecamatan'),
            'kecamatan_unique_code'=> $request->getVar('kecamatan_unique_code'),
            'kelurahan_id'=> $request->getVar('kelurahan_id'),
            'nama_kelurahan'=> $request->getVar('nama_kelurahan'),
            'kelurahan_unique_code'=> $request->getVar('kelurahan_unique_code'),
            'mb_media_id'=> $request->getVar('mb_media_id'),
            'akronim_mitra_bayar'=> $request->getVar('akronim_mitra_bayar'),
            'mb_code_real'=> $request->getVar('mb_code_real'),
            'mb_child_id'=> $request->getVar('mb_child_id'),
            'is_online'=> $request->getVar('is_online'),
            'is_payment_point'=> $request->getVar('is_payment_point'),
            'subyek_pks'=> $request->getVar('subyek_pks'),
            'nama_file_pks'=> $request->getVar('nama_file_pks'),
            'nomor_pks_pensiun'=> $request->getVar('nomor_pks_pensiun'),
            'status_dapem_non_dapem'=> $request->getVar('status_dapem_non_dapem'),
            'rekening_atas_nama'=> $request->getVar('rekening_atas_nama'),
            'kode_umum_mitra_bayar'=> $request->getVar('kode_umum_mitra_bayar'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new MitraBayarModel();
        return $model->update($id, [
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'kode_mitra_bayar'=> $request->getVar('kode_mitra_bayar'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'alamat_mitra_bayar'=> $request->getVar('alamat_mitra_bayar'),
            'nama_rekening_tampungan'=> $request->getVar('nama_rekening_tampungan'),
            'nomor_rekening_tampungan'=> $request->getVar('nomor_rekening_tampungan'),
            'nomor_pks_pihak_1'=> $request->getVar('nomor_pks_pihak_1'),
            'nomor_pks_pihak_2'=> $request->getVar('nomor_pks_pihak_2'),
            'tanggal_pks'=> $request->getVar('tanggal_pks'),
            'longitude'=> $request->getVar('longitude'),
            'latitude'=> $request->getVar('latitude'),
            'provinsi_id'=> $request->getVar('provinsi_id'),
            'nama_provinsi'=> $request->getVar('nama_provinsi'),
            'provinsi_unique_code'=> $request->getVar('provinsi_unique_code'),
            'kota_id'=> $request->getVar('kota_id'),
            'nama_kota'=> $request->getVar('nama_kota'),
            'kota_unique_code'=> $request->getVar('kota_unique_code'),
            'kecamatan_id'=> $request->getVar('kecamatan_id'),
            'nama_kecamatan'=> $request->getVar('nama_kecamatan'),
            'kecamatan_unique_code'=> $request->getVar('kecamatan_unique_code'),
            'kelurahan_id'=> $request->getVar('kelurahan_id'),
            'nama_kelurahan'=> $request->getVar('nama_kelurahan'),
            'kelurahan_unique_code'=> $request->getVar('kelurahan_unique_code'),
            'mb_media_id'=> $request->getVar('mb_media_id'),
            'akronim_mitra_bayar'=> $request->getVar('akronim_mitra_bayar'),
            'mb_code_real'=> $request->getVar('mb_code_real'),
            'mb_child_id'=> $request->getVar('mb_child_id'),
            'is_online'=> $request->getVar('is_online'),
            'is_payment_point'=> $request->getVar('is_payment_point'),
            'subyek_pks'=> $request->getVar('subyek_pks'),
            'nama_file_pks'=> $request->getVar('nama_file_pks'),
            'nomor_pks_pensiun'=> $request->getVar('nomor_pks_pensiun'),
            'status_dapem_non_dapem'=> $request->getVar('status_dapem_non_dapem'),
            'rekening_atas_nama'=> $request->getVar('rekening_atas_nama'),
            'kode_umum_mitra_bayar'=> $request->getVar('kode_umum_mitra_bayar'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new MitraBayarModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
