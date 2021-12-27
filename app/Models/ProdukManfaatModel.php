<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukManfaatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_produk_manfaat';
    protected $primaryKey       ='produk_manfaat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'produk_manfaat_id',
        'produk_manfaat_unique_code',
        'produk_id',
        'produk_unique_code',
        'nama_produk',
        'manfaat_id',
        'manfaat_unique_code',
        'nama_manfaat',
        'jenis_klaim_id',
        'jenis_klaim_unique_code',
        'nama_jenis_klaim',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_aktif',
        'deskripsi',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'nilai_manfaat',
        'persentase_manfaat',
        'golongan_cacat_id',
        'nama_golongan_cacat',
        'tingkat_cacat_id',
        'nama_tingkat_cacat',
        'golongan_pangkat_id',
        'nama_golongan_pangkat',
        'pengali_manfaat',


    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'produk_manfaat_unique_code'=>'required',
        'produk_id'=>'required',
        'produk_unique_code'=>'required',
        'nama_produk'=>'required',
        'manfaat_id'=>'required',
        'manfaat_unique_code'=>'required',
        'nama_manfaat'=>'required',
        'jenis_klaim_id'=>'required',
        'jenis_klaim_unique_code'=>'required',
        'nama_jenis_klaim'=>'required',
        'tanggal_mulai'=>'required',
        'tanggal_akhir'=>'required',
        'is_aktif'=>'required',
        'deskripsi'=>'required',
        'nilai_manfaat'=>'required',
        'persentase_manfaat'=>'required',
        'golongan_cacat_id'=>'required',
        'nama_golongan_cacat'=>'required',
        'tingkat_cacat_id'=>'required',
        'nama_tingkat_cacat'=>'required',
        'golongan_pangkat_id'=>'required',
        'nama_golongan_pangkat'=>'required',
        'pengali_manfaat'=>'required',


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
        $model = new ProdukManfaatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new ProdukManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'produk_manfaat_unique_code'=> $request->getVar('produk_manfaat_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'tanggal_mulai'=> $request->getVar('tanggal_mulai'),
            'tanggal_akhir'=> $request->getVar('tanggal_akhir'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'persentase_manfaat'=> $request->getVar('persentase_manfaat'),
            'golongan_cacat_id'=> $request->getVar('golongan_cacat_id'),
            'nama_golongan_cacat'=> $request->getVar('nama_golongan_cacat'),
            'tingkat_cacat_id'=> $request->getVar('tingkat_cacat_id'),
            'nama_tingkat_cacat'=> $request->getVar('nama_tingkat_cacat'),
            'golongan_pangkat_id'=> $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'=> $request->getVar('nama_golongan_pangkat'),
            'pengali_manfaat'=> $request->getVar('pengali_manfaat'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'produk_manfaat_unique_code'=> $request->getVar('produk_manfaat_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'manfaat_id'=> $request->getVar('manfaat_id'),
            'manfaat_unique_code'=> $request->getVar('manfaat_unique_code'),
            'nama_manfaat'=> $request->getVar('nama_manfaat'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'tanggal_mulai'=> $request->getVar('tanggal_mulai'),
            'tanggal_akhir'=> $request->getVar('tanggal_akhir'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nilai_manfaat'=> $request->getVar('nilai_manfaat'),
            'persentase_manfaat'=> $request->getVar('persentase_manfaat'),
            'golongan_cacat_id'=> $request->getVar('golongan_cacat_id'),
            'nama_golongan_cacat'=> $request->getVar('nama_golongan_cacat'),
            'tingkat_cacat_id'=> $request->getVar('tingkat_cacat_id'),
            'nama_tingkat_cacat'=> $request->getVar('nama_tingkat_cacat'),
            'golongan_pangkat_id'=> $request->getVar('golongan_pangkat_id'),
            'nama_golongan_pangkat'=> $request->getVar('nama_golongan_pangkat'),
            'pengali_manfaat'=> $request->getVar('pengali_manfaat'),



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
