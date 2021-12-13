<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporSptbModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_lapor_sptb';
    protected $primaryKey       ='lapor_sptb_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'lapor_sptb_id',
        'lapor_sptb_unique_code',
        'tanggal_lapor_sptb',
        'penerima_pensiun_id',
        'nama_penerima_pensiun',
        'penerima_pensiun_unique_code',
        'status',
        'keterangan',
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
        'lapor_sptb_id'=>'required',
        'lapor_sptb_unique_code'=>'required',
        'tanggal_lapor_sptb'=>'required',
        'penerima_pensiun_id'=>'required',
        'nama_penerima_pensiun'=>'required',
        'penerima_pensiun_unique_code'=>'required',
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
        $model = new LaporSptbModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new LaporSptbModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new LaporSptbModel();
        return $model->insert([
            'lapor_sptb_id'=> $request->getVar('lapor_sptb_id'),
            'lapor_sptb_unique_code'=> $request->getVar('lapor_sptb_unique_code'),
            'tanggal_lapor_sptb'=> $request->getVar('tanggal_lapor_sptb'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new LaporSptbModel();
        return $model->update($id, [
            'lapor_sptb_id'=> $request->getVar('lapor_sptb_id'),
            'lapor_sptb_unique_code'=> $request->getVar('lapor_sptb_unique_code'),
            'tanggal_lapor_sptb'=> $request->getVar('tanggal_lapor_sptb'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'penerima_pensiun_unique_code'=> $request->getVar('penerima_pensiun_unique_code'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new LaporSptbModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
