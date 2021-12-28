<?php

namespace App\Models;

use CodeIgniter\Model;

class OtentikasiPensiunModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_otentikasi_pensiun';
    protected $primaryKey       ='otentikasi_pensiun_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'otentikasi_pensiun_id',
        'otentikasi_pensiun_unique_code',
        'penerima_pensiun_id',
        'nama_penerima_pensiun',
        'tanggal_otentikasi',
        'otentikasi_via',
        'keterangan',
        'status',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_by',
        'deleted_status',
        'latitude',
        'longitude',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'otentikasi_pensiun_unique_code'=>'required',
        'penerima_pensiun_id'=>'required',
        'nama_penerima_pensiun'=>'required',
        'tanggal_otentikasi'=>'required',
        'otentikasi_via'=>'required',
        'keterangan'=>'required',
        'status'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',

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
        $model = new OtentikasiPensiunModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new OtentikasiPensiunModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'otentikasi_pensiun_unique_code'=> $request->getVar('otentikasi_pensiun_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'tanggal_otentikasi'=> $request->getVar('tanggal_otentikasi'),
            'otentikasi_via'=> $request->getVar('otentikasi_via'),
            'keterangan'=> $request->getVar('keterangan'),
            'status'=> $request->getVar('status'),
            'latitude'=> $request->getVar('latitude'),
            'longitude'=> $request->getVar('longitude'),


            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'otentikasi_pensiun_unique_code'=> $request->getVar('otentikasi_pensiun_unique_code'),
            'penerima_pensiun_id'=> $request->getVar('penerima_pensiun_id'),
            'nama_penerima_pensiun'=> $request->getVar('nama_penerima_pensiun'),
            'tanggal_otentikasi'=> $request->getVar('tanggal_otentikasi'),
            'otentikasi_via'=> $request->getVar('otentikasi_via'),
            'keterangan'=> $request->getVar('keterangan'),
            'status'=> $request->getVar('status'),
            'latitude'=> $request->getVar('latitude'),
            'longitude'=> $request->getVar('longitude'),


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
