<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaProdukModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_produk';
    protected $primaryKey       ='peserta_produk_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_produk_id',
        'peserta_produk_unique_code',
        'peserta_id',
        'nama_peserta',
        'peserta_unique_code',
        'produk_id',
        'produk_unique_code',
        'nama_produk',
        'kode_produk',
        'premi_pemberi_kerja',
        'premi_pekerja',
        'status',
        'tmt_mulai',
        'tmt_akhir',
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
        'peserta_produk_unique_code'=>'required',
        'peserta_id'=>'required',
        'nama_peserta'=>'required',
        'peserta_unique_code'=>'required',
        'produk_id'=>'required',
        'produk_unique_code'=>'required',
        'nama_produk'=>'required',
        'kode_produk'=>'required',
        'premi_pemberi_kerja'=>'required',
        'premi_pekerja'=>'required',
        'status'=>'required',
        'tmt_mulai'=>'required',
        'tmt_akhir'=>'required',


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
        $model = new PesertaProdukModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaProdukModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'peserta_produk_unique_code'=> $request->getVar('peserta_produk_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'kode_produk'=> $request->getVar('kode_produk'),
            'premi_pemberi_kerja'=> $request->getVar('premi_pemberi_kerja'),
            'premi_pekerja'=> $request->getVar('premi_pekerja'),
            'status'=> $request->getVar('status'),
            'tmt_mulai'=> $request->getVar('tmt_mulai'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'peserta_produk_unique_code'=> $request->getVar('peserta_produk_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'kode_produk'=> $request->getVar('kode_produk'),
            'premi_pemberi_kerja'=> $request->getVar('premi_pemberi_kerja'),
            'premi_pekerja'=> $request->getVar('premi_pekerja'),
            'status'=> $request->getVar('status'),
            'tmt_mulai'=> $request->getVar('tmt_mulai'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),


            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user){
        return $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
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
