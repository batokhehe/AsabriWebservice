<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaPensiunModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_penerima_pensiun';
    protected $primaryKey       ='penerima_pensiun_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'penerima_pensiun_id',
        'penerima_pensiun_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'keluarga_id',
        'nama_keluarga',
        'keluarga_unique_code',
        'klaim_id',
        'klaim_unique_code',
        'nomor_klaim',
        'tmt_mulai',
        'tmt_akhir',
        'status_peserta_id',
        'nama_status_peserta',
        'status',
        'is_aktif',
        'nomor_rekening',
        'nama_rekening',
        'nama_bank',
        'nama_cabang_bank',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'mitra_bayar_id',
        'nama_mitra_bayar',
        'mitra_bayar_unique_code',
        'cabang_mitra_bayar_id',
        'nama_cabang_mitra_bayar',
        'cabang_mitra_bayar_unique_code',
        'status_otentikasi',
        'tanggal_terakhir_otentikasi',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'nomor_ktpa',
        'nomor_pensiun',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'penerima_pensiun_unique_code'=> 'required',
        'peserta_id'=> 'required',
        'peserta_unique_code'=> 'required',
        'nama_peserta'=> 'required',
        'keluarga_id'=> 'required',
        'nama_keluarga'=> 'required',
        'keluarga_unique_code'=> 'required',
        'klaim_id'=> 'required',
        'klaim_unique_code'=> 'required',
        'nomor_klaim'=> 'required',
        'tmt_mulai'=> 'required',
        'tmt_akhir'=> 'required',
        'status_peserta_id'=> 'required',
        'nama_status_peserta'=> 'required',
        'status'=> 'required',
        'is_aktif'=> 'required',
        'nomor_rekening'=> 'required',
        'nama_rekening'=> 'required',
        'nama_bank'=> 'required',
        'nama_cabang_bank'=> 'required',
        'mitra_bayar_id'=> 'required',
        'nama_mitra_bayar'=> 'required',
        'mitra_bayar_unique_code'=> 'required',
        'cabang_mitra_bayar_id'=> 'required',
        'nama_cabang_mitra_bayar'=> 'required',
        'cabang_mitra_bayar_unique_code'=> 'required',
        'status_otentikasi'=> 'required',
        'tanggal_terakhir_otentikasi'=> 'required',
        'kantor_cabang_id'=> 'required',
        'nama_kantor_cabang'=> 'required',
        'nomor_ktpa'=> 'required',
        'nomor_pensiun'=> 'required',
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
        $model = new PenerimaPensiunModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PenerimaPensiunModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    
    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'keluarga_id'=> $request->getVar('keluarga_id'),
            'nama_keluarga'=> $request->getVar('nama_keluarga'),
            'keluarga_unique_code'=> $request->getVar('keluarga_unique_code'),
            'klaim_id'=> $request->getVar('klaim_id'),
            'klaim_unique_code'=> $request->getVar('klaim_unique_code'),
            'nomor_klaim'=> $request->getVar('nomor_klaim'),
            'tmt_mulai'=> $request->getVar('tmt_mulai'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),
            'status_peserta_id'=> $request->getVar('status_peserta_id'),
            'nama_status_peserta'=> $request->getVar('nama_status_peserta'),
            'status'=> $request->getVar('status'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'nomor_rekening'=> $request->getVar('nomor_rekening'),
            'nama_rekening'=> $request->getVar('nama_rekening'),
            'nama_bank'=> $request->getVar('nama_bank'),
            'nama_cabang_bank'=> $request->getVar('nama_cabang_bank'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'cabang_mitra_bayar_id'=> $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'=> $request->getVar('nama_cabang_mitra_bayar'),
            'cabang_mitra_bayar_unique_code'=> $request->getVar('cabang_mitra_bayar_unique_code'),
            'status_otentikasi'=> $request->getVar('status_otentikasi'),
            'tanggal_terakhir_otentikasi'=> $request->getVar('tanggal_terakhir_otentikasi'),
            'kantor_cabang_id'=> $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'=> $request->getVar('nama_kantor_cabang'),
            'nomor_ktpa'=> $request->getVar('nomor_ktpa'),
            'nomor_pensiun'=> $request->getVar('nomor_pensiun'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'keluarga_id'=> $request->getVar('keluarga_id'),
            'nama_keluarga'=> $request->getVar('nama_keluarga'),
            'keluarga_unique_code'=> $request->getVar('keluarga_unique_code'),
            'klaim_id'=> $request->getVar('klaim_id'),
            'klaim_unique_code'=> $request->getVar('klaim_unique_code'),
            'nomor_klaim'=> $request->getVar('nomor_klaim'),
            'tmt_mulai'=> $request->getVar('tmt_mulai'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),
            'status_peserta_id'=> $request->getVar('status_peserta_id'),
            'nama_status_peserta'=> $request->getVar('nama_status_peserta'),
            'status'=> $request->getVar('status'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'nomor_rekening'=> $request->getVar('nomor_rekening'),
            'nama_rekening'=> $request->getVar('nama_rekening'),
            'nama_bank'=> $request->getVar('nama_bank'),
            'nama_cabang_bank'=> $request->getVar('nama_cabang_bank'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'cabang_mitra_bayar_id'=> $request->getVar('cabang_mitra_bayar_id'),
            'nama_cabang_mitra_bayar'=> $request->getVar('nama_cabang_mitra_bayar'),
            'cabang_mitra_bayar_unique_code'=> $request->getVar('cabang_mitra_bayar_unique_code'),
            'status_otentikasi'=> $request->getVar('status_otentikasi'),
            'tanggal_terakhir_otentikasi'=> $request->getVar('tanggal_terakhir_otentikasi'),
            'kantor_cabang_id'=> $request->getVar('kantor_cabang_id'),
            'nama_kantor_cabang'=> $request->getVar('nama_kantor_cabang'),
            'nomor_ktpa'=> $request->getVar('nomor_ktpa'),
            'nomor_pensiun'=> $request->getVar('nomor_pensiun'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user){
        return $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }

    public function getAvailableId($model){
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}
