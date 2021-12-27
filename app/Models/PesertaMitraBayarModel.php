<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaMitraBayarModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_peserta_mitra_bayar';
    protected $primaryKey       ='peserta_mitra_bayar_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pensiun_mitra_bayar_id',
        'pensiun_mitra_bayar_unique_code',
        'penerima_pensiun_id',
        'penerima_pensiun_unique_code',
        'nama_peserta',
        'mitra_bayar_cabang_id',
        'mitra_bayar_cabang_unique_code',
        'nama_mitra_bayar',
        'nama_mitra_bayar_cabang',
        'peserta_mutasi_id',
        'peserta_mutasi_unique_code',
        'is_aktif',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'status_pinjaman',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'pensiun_mitra_bayar_unique_code'=>'required',
        'penerima_pensiun_id'=>'required',
        'penerima_pensiun_unique_code'=>'required',
        'nama_peserta'=>'required',
        'mitra_bayar_cabang_id'=>'required',
        'mitra_bayar_cabang_unique_code'=>'required',
        'nama_mitra_bayar'=>'required',
        'nama_mitra_bayar_cabang'=>'required',
        'peserta_mutasi_id'=>'required',
        'peserta_mutasi_unique_code'=>'required',
        'is_aktif'=>'required',
        'deskripsi'=>'required',
        'status_pinjaman'=>'required',

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
        $model = new PesertaMitraBayarModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaMitraBayarModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'pensiun_mitra_bayar_unique_code'=> $request->getVar('pensiun_mitra_bayar_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'mitra_bayar_cabang_id'=> $request->getVar('mitra_bayar_cabang_id'),
            'mitra_bayar_cabang_unique_code'=> $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'nama_mitra_bayar_cabang'=> $request->getVar('nama_mitra_bayar_cabang'),
            'peserta_mutasi_id'=> $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code'=> $request->getVar('peserta_mutasi_unique_code'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'status_pinjaman'=> $request->getVar('status_pinjaman'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'pensiun_mitra_bayar_unique_code'=> $request->getVar('pensiun_mitra_bayar_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'mitra_bayar_cabang_id'=> $request->getVar('mitra_bayar_cabang_id'),
            'mitra_bayar_cabang_unique_code'=> $request->getVar('mitra_bayar_cabang_unique_code'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'nama_mitra_bayar_cabang'=> $request->getVar('nama_mitra_bayar_cabang'),
            'peserta_mutasi_id'=> $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code'=> $request->getVar('peserta_mutasi_unique_code'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'status_pinjaman'=> $request->getVar('status_pinjaman'),

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
