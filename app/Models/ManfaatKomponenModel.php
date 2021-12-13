<?php

namespace App\Models;

use CodeIgniter\Model;

class ManfaatKomponenModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_manfaat_komponen';
    protected $primaryKey       ='manfaat_komponen_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'manfaat_komponen_id',
        'manfaat_komponen_unique_code',
        'nama_manfaat_komponen',
        'kode_manfaat_komponen',
        'keterangan',
        'jenis_komponen',
        'manfaat_id',
        'nama_manfaat',
        'manfaat_unique_code',
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
        'manfaat_komponen_id'=>'required',
        'manfaat_komponen_unique_code'=>'required',
        'nama_manfaat_komponen'=>'required',
        'kode_manfaat_komponen'=>'required',
        'keterangan'=>'required',
        'jenis_komponen'=>'required',
        'manfaat_id'=>'required',
        'nama_manfaat'=>'required',
        'manfaat_unique_code'=>'required',


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
        $model = new ManfaatKomponenModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new ManfaatKomponenModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new ManfaatKomponenModel();
        return $model->insert([
            'manfaat_komponen_id'=> $request->getVar('manfaat_komponen_id'),
            'manfaat_komponen_unique_code'=> $request->getVar('manfaat_komponen_unique_code'),
            'nama_manfaat_komponen'=> $request->getVar('nama_manfaat_komponen'),
            'kode_manfaat_komponen'=> $request->getVar('kode_manfaat_komponen'),
            'keterangan'=> $request->getVar('keterangan'),
            'jenis_komponen'=> $request->getVar('jenis_komponen'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),



            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new ManfaatKomponenModel();
        return $model->update($id, [
            'manfaat_komponen_id'=> $request->getVar('manfaat_komponen_id'),
            'manfaat_komponen_unique_code'=> $request->getVar('manfaat_komponen_unique_code'),
            'nama_manfaat_komponen'=> $request->getVar('nama_manfaat_komponen'),
            'kode_manfaat_komponen'=> $request->getVar('kode_manfaat_komponen'),
            'keterangan'=> $request->getVar('keterangan'),
            'jenis_komponen'=> $request->getVar('jenis_komponen'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),



            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new ManfaatKomponenModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
