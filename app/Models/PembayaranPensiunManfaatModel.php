<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranPensiunManfaatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_pembayaran_pensiun_manfaat';
    protected $primaryKey       ='pembayaran_pensiun_manfaat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pembayaran_pensiun_manfaat_id',
        'pembayaran_pensiun_manfaat_unique_code',
        'pembayaran_pensiun_id',
        'pembayaran_pensiun_unique_code',
        'manfaat_komponen_id',
        'manfaat_komponen_unique_code',
        'nama_manfaat_komponen',
        'kode_manfaat_komponen',
        'nilai_pengajuan',
        'nilai_verifikasi',
        'nilai_persetujuan',
        'status',
        'status_persetujuan',
        'kode_persetujuan',
        'waktu_verifikasi',
        'diverifikasi_oleh',
        'keterangan_verifikasi',
        'waktu_persetujuan',
        'disetujui_oleh',
        'keterangan_persetujuan',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_status',
        'deleted_by',
        'deleted_date',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'pembayaran_pensiun_manfaat_id'=>'required',
        'pembayaran_pensiun_manfaat_unique_code'=>'required',
        'pembayaran_pensiun_id'=>'required',
        'pembayaran_pensiun_unique_code'=>'required',
        'manfaat_komponen_id'=>'required',
        'manfaat_komponen_unique_code'=>'required',
        'nama_manfaat_komponen'=>'required',
        'kode_manfaat_komponen'=>'required',
        'nilai_pengajuan'=>'required',
        'nilai_verifikasi'=>'required',
        'nilai_persetujuan'=>'required',
        'status'=>'required',
        'status_persetujuan'=>'required',
        'kode_persetujuan'=>'required',
        'waktu_verifikasi'=>'required',
        'diverifikasi_oleh'=>'required',
        'keterangan_verifikasi'=>'required',
        'waktu_persetujuan'=>'required',
        'disetujui_oleh'=>'required',
        'keterangan_persetujuan'=>'required',

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
        $model = new PembayaranPensiunManfaatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PembayaranPensiunManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new PembayaranPensiunManfaatModel();
        return $model->insert([
            'pembayaran_pensiun_manfaat_id'=> $request->getVar('pembayaran_pensiun_manfaat_id'),
            'pembayaran_pensiun_manfaat_unique_code'=> $request->getVar('pembayaran_pensiun_manfaat_unique_code'),
            'pembayaran_pensiun_id'=> $request->getVar('pembayaran_pensiun_id'),
            'pembayaran_pensiun_unique_code'=> $request->getVar('pembayaran_pensiun_unique_code'),
            'manfaat_komponen_id'=> $request->getVar('manfaat_komponen_id'),
            'manfaat_komponen_unique_code'=> $request->getVar('manfaat_komponen_unique_code'),
            'nama_manfaat_komponen'=> $request->getVar('nama_manfaat_komponen'),
            'kode_manfaat_komponen'=> $request->getVar('kode_manfaat_komponen'),
            'nilai_pengajuan'=> $request->getVar('nilai_pengajuan'),
            'nilai_verifikasi'=> $request->getVar('nilai_verifikasi'),
            'nilai_persetujuan'=> $request->getVar('nilai_persetujuan'),
            'status'=> $request->getVar('status'),
            'status_persetujuan'=> $request->getVar('status_persetujuan'),
            'kode_persetujuan'=> $request->getVar('kode_persetujuan'),
            'waktu_verifikasi'=> $request->getVar('waktu_verifikasi'),
            'diverifikasi_oleh'=> $request->getVar('diverifikasi_oleh'),
            'keterangan_verifikasi'=> $request->getVar('keterangan_verifikasi'),
            'waktu_persetujuan'=> $request->getVar('waktu_persetujuan'),
            'disetujui_oleh'=> $request->getVar('disetujui_oleh'),
            'keterangan_persetujuan'=> $request->getVar('keterangan_persetujuan'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new PembayaranPensiunManfaatModel();
        return $model->update($id, [
            'pembayaran_pensiun_manfaat_id'=> $request->getVar('pembayaran_pensiun_manfaat_id'),
            'pembayaran_pensiun_manfaat_unique_code'=> $request->getVar('pembayaran_pensiun_manfaat_unique_code'),
            'pembayaran_pensiun_id'=> $request->getVar('pembayaran_pensiun_id'),
            'pembayaran_pensiun_unique_code'=> $request->getVar('pembayaran_pensiun_unique_code'),
            'manfaat_komponen_id'=> $request->getVar('manfaat_komponen_id'),
            'manfaat_komponen_unique_code'=> $request->getVar('manfaat_komponen_unique_code'),
            'nama_manfaat_komponen'=> $request->getVar('nama_manfaat_komponen'),
            'kode_manfaat_komponen'=> $request->getVar('kode_manfaat_komponen'),
            'nilai_pengajuan'=> $request->getVar('nilai_pengajuan'),
            'nilai_verifikasi'=> $request->getVar('nilai_verifikasi'),
            'nilai_persetujuan'=> $request->getVar('nilai_persetujuan'),
            'status'=> $request->getVar('status'),
            'status_persetujuan'=> $request->getVar('status_persetujuan'),
            'kode_persetujuan'=> $request->getVar('kode_persetujuan'),
            'waktu_verifikasi'=> $request->getVar('waktu_verifikasi'),
            'diverifikasi_oleh'=> $request->getVar('diverifikasi_oleh'),
            'keterangan_verifikasi'=> $request->getVar('keterangan_verifikasi'),
            'waktu_persetujuan'=> $request->getVar('waktu_persetujuan'),
            'disetujui_oleh'=> $request->getVar('disetujui_oleh'),
            'keterangan_persetujuan'=> $request->getVar('keterangan_persetujuan'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new PembayaranPensiunManfaatModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
