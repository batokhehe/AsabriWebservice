<?php

namespace App\Models;

use CodeIgniter\Model;

class KlaimManfaatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_klaim_manfaat';
    protected $primaryKey       ='klaim_manfaat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'klaim_manfaat_id',
        'klaim_manfaat_unique_code',
        'klaim_id',
        'klaim_unique_code',
        'nomor_klaim',
        'manfaat_id',
        'manfaat_unique_code',
        'nama_manfaat',
        'deskripsi',
        'nilai_manfaat',
        'nilai_manfaat_disetujui',
        'nilai_manfaat_dibayar',
        'status',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
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
        'klaim_manfaat_id'=>'required',
        'klaim_manfaat_unique_code'=>'required',
        'klaim_id'=>'required',
        'klaim_unique_code'=>'required',
        'nomor_klaim'=>'required',
        'manfaat_id'=>'required',
        'manfaat_unique_code'=>'required',
        'nama_manfaat'=>'required',
        'deskripsi'=>'required',
        'nilai_manfaat'=>'required',
        'nilai_manfaat_disetujui'=>'required',
        'nilai_manfaat_dibayar'=>'required',
        'status'=>'required',
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
        $model = new KlaimManfaatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new KlaimManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new KlaimManfaatModel();
        return $model->insert([
            'klaim_manfaat_id'=> $request->getVar('klaim_manfaat_id'),
            'klaim_manfaat_unique_code'=> $request->getVar('klaim_manfaat_unique_code'),
            'klaim_id'=> $request->getVar('klaim_id'),
            'klaim_unique_code'=> $request->getVar('klaim_unique_code'),
            'nomor_klaim'=> $request->getVar('nomor_klaim'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'nilai_manfaat_disetujui'=> $request->getVar('nilai_manfaat_disetujui'),
            'nilai_manfaat_dibayar'=> $request->getVar('nilai_manfaat_dibayar'),
            'status'=> $request->getVar('status'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new KlaimManfaatModel();
        return $model->update($id, [
            'klaim_manfaat_id'=> $request->getVar('klaim_manfaat_id'),
            'klaim_manfaat_unique_code'=> $request->getVar('klaim_manfaat_unique_code'),
            'klaim_id'=> $request->getVar('klaim_id'),
            'klaim_unique_code'=> $request->getVar('klaim_unique_code'),
            'nomor_klaim'=> $request->getVar('nomor_klaim'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'nilai_manfaat_disetujui'=> $request->getVar('nilai_manfaat_disetujui'),
            'nilai_manfaat_dibayar'=> $request->getVar('nilai_manfaat_dibayar'),
            'status'=> $request->getVar('status'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new KlaimManfaatModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
