<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanSptbPesertaModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_laporan_sptb_peserta';
    protected $primaryKey       ='lapor_sptb_peserta_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'lapor_sptb_peserta_id',
        'lapor_sptb_peserta_unique_code',
        'tanggal_lapor_sptb',
        'nomor_laporan_sptb',
        'peserta_id',
        'nama_peserta',
        'nomor_ktpa',
        'status',
        'keterangan',
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
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'lapor_sptb_peserta_unique_code'=>'required',
        'tanggal_lapor_sptb'=>'required',
        'nomor_laporan_sptb'=>'required',
        'peserta_id'=>'required',
        'nama_peserta'=>'required',
        'nomor_ktpa'=>'required',
        'status'=>'required',
        'keterangan'=>'required',


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
        $model = new LaporanSptbPesertaModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new LaporanSptbPesertaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'lapor_sptb_peserta_unique_code'=> $request->getVar('lapor_sptb_peserta_unique_code'),
            'tanggal_lapor_sptb'=> $request->getVar('tanggal_lapor_sptb'),
            'nomor_laporan_sptb'=> $request->getVar('nomor_laporan_sptb'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'nomor_ktpa'=> $request->getVar('nomor_ktpa'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),

            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'lapor_sptb_peserta_unique_code'=> $request->getVar('lapor_sptb_peserta_unique_code'),
            'tanggal_lapor_sptb'=> $request->getVar('tanggal_lapor_sptb'),
            'nomor_laporan_sptb'=> $request->getVar('nomor_laporan_sptb'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'nomor_ktpa'=> $request->getVar('nomor_ktpa'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),

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
