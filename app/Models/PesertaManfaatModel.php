<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaManfaatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_manfaat';
    protected $primaryKey       ='peserta_manfaat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_manfaat_id',
        'peserta_manfaat_unique_code',
        'peserta_id',
        'nama_peserta',
        'peserta_unique_code',
        'manfaat_id',
        'nama_manfaat',
        'manfaat_unique_code',
        'peserta_produk_id',
        'peserta_produk_unique_code',
        'nilai_manfaat',
        'nilai_manfaat_dibayar',
        'status',
        'deskripsi',
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
        'peserta_manfaat_unique_code'=>'required',
        'peserta_id'=>'required',
        'nama_peserta'=>'required',
        'peserta_unique_code'=>'required',
        'manfaat_id'=>'required',
        'nama_manfaat'=>'required',
        'manfaat_unique_code'=>'required',
        'peserta_produk_id'=>'required',
        'peserta_produk_unique_code'=>'required',
        'nilai_manfaat'=>'required',
        'nilai_manfaat_dibayar'=>'required',
        'status'=>'required',
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
        $model = new PesertaManfaatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

   public static function createNew($model, $request, $user){
        return $model->insert([
            'peserta_manfaat_unique_code'=> $request->getVar('peserta_manfaat_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'peserta_produk_id'=> $request->getVar('peserta_produk_id'),
            'peserta_produk_unique_code'=> $request->getVar('peserta_produk_unique_code'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'nilai_manfaat_dibayar'=> $request->getVar('nilai_manfaat_dibayar'),
            'status'=> $request->getVar('status'),
            'deskripsi'=> $request->getVar('deskripsi'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'peserta_manfaat_unique_code'=> $request->getVar('peserta_manfaat_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'peserta_produk_id'=> $request->getVar('peserta_produk_id'),
            'peserta_produk_unique_code'=> $request->getVar('peserta_produk_unique_code'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'nilai_manfaat_dibayar'=> $request->getVar('nilai_manfaat_dibayar'),
            'status'=> $request->getVar('status'),
            'deskripsi'=> $request->getVar('deskripsi'),

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
