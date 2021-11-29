<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaCacatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_cacat';
    protected $primaryKey       ='peserta_cacat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_cacat_id',
        'peserta_cacat_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'cacat_golongan_id',
        'cacat_golongan_unique_code',
        'nama_cacat_golongan',
        'cacat_tingkat_id',
        'cacat_tingkat_unique_code',
        'nama_cacat_tingkat',
        'status',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'peserta_mutasi_id',
        'peserta_mutasi_unique_code',
        'deskripsi',
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
        'peserta_cacat_id'=>'required',
        'peserta_cacat_unique_code'=>'required',
        'peserta_id'=>'required',
        'peserta_unique_code'=>'required',
        'nama_peserta'=>'required',
        'cacat_golongan_id'=>'required',
        'cacat_golongan_unique_code'=>'required',
        'nama_cacat_golongan'=>'required',
        'cacat_tingkat_id'=>'required',
        'cacat_tingkat_unique_code'=>'required',
        'nama_cacat_tingkat'=>'required',
        'status'=>'required',
        'tanggal_pengajuan'=>'required',
        'tanggal_persetujuan'=>'required',
        'peserta_mutasi_id'=>'required',
        'peserta_mutasi_unique_code'=>'required',
        'deskripsi'=>'required',

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
        $model = new PesertaCacatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaCacatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new PesertaCacatModel();
        return $model->insert([
            'peserta_cacat_id'=> $request->getVar('peserta_cacat_id'),
            'peserta_cacat_unique_code'=> $request->getVar('peserta_cacat_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'cacat_golongan_id'=> $request->getVar('cacat_golongan_id'),
            'cacat_golongan_unique_code'=> $request->getVar('cacat_golongan_unique_code'),
            'nama_cacat_golongan'=> $request->getVar('nama_cacat_golongan'),
            'cacat_tingkat_id'=> $request->getVar('cacat_tingkat_id'),
            'cacat_tingkat_unique_code'=> $request->getVar('cacat_tingkat_unique_code'),
            'nama_cacat_tingkat'=> $request->getVar('nama_cacat_tingkat'),
            'status'=> $request->getVar('status'),
            'tanggal_pengajuan'=> $request->getVar('tanggal_pengajuan'),
            'tanggal_persetujuan'=> $request->getVar('tanggal_persetujuan'),
            'peserta_mutasi_id'=> $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code'=> $request->getVar('peserta_mutasi_unique_code'),
            'deskripsi'=> $request->getVar('deskripsi'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new PesertaCacatModel();
        return $model->update($id, [
            'peserta_cacat_id'=> $request->getVar('peserta_cacat_id'),
            'peserta_cacat_unique_code'=> $request->getVar('peserta_cacat_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'cacat_golongan_id'=> $request->getVar('cacat_golongan_id'),
            'cacat_golongan_unique_code'=> $request->getVar('cacat_golongan_unique_code'),
            'nama_cacat_golongan'=> $request->getVar('nama_cacat_golongan'),
            'cacat_tingkat_id'=> $request->getVar('cacat_tingkat_id'),
            'cacat_tingkat_unique_code'=> $request->getVar('cacat_tingkat_unique_code'),
            'nama_cacat_tingkat'=> $request->getVar('nama_cacat_tingkat'),
            'status'=> $request->getVar('status'),
            'tanggal_pengajuan'=> $request->getVar('tanggal_pengajuan'),
            'tanggal_persetujuan'=> $request->getVar('tanggal_persetujuan'),
            'peserta_mutasi_id'=> $request->getVar('peserta_mutasi_id'),
            'peserta_mutasi_unique_code'=> $request->getVar('peserta_mutasi_unique_code'),
            'deskripsi'=> $request->getVar('deskripsi'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new PesertaCacatModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
