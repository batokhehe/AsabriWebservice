<?php

namespace App\Models;

use CodeIgniter\Model;

class ManfaatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_manfaat';
    protected $primaryKey       ='manfaat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'manfaat_id',
        'manfaat_unique_code',
        'nama_manfaat',
        'kode_manfaat',
        'jenis_klaim_id',
        'nama_jenis_klaim',
        'jenis_klaim_unique_code',
        'deskripsi',
        'is_asuransi',
        'is_dana_pensiun',
        'status',
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
        'manfaat_unique_code'=>'required',
        'nama_manfaat'=>'required',
        'kode_manfaat'=>'required',
        'jenis_klaim_id'=>'required',
        'nama_jenis_klaim'=>'required',
        'jenis_klaim_unique_code'=>'required',
        'deskripsi'=>'required',
        'is_asuransi'=>'required',
        'is_dana_pensiun'=>'required',
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
        $model = new ManfaatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new ManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'kode_manfaat'=> $request->getVar('kode_manfaat'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'is_asuransi'=> $request->getVar('is_asuransi'),
            'is_dana_pensiun'=> $request->getVar('is_dana_pensiun'),
            'status'=> $request->getVar('status'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'kode_manfaat'=> $request->getVar('kode_manfaat'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'is_asuransi'=> $request->getVar('is_asuransi'),
            'is_dana_pensiun'=> $request->getVar('is_dana_pensiun'),
            'status'=> $request->getVar('status'),

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
