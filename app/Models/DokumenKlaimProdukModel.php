<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenKlaimProdukModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_dokumen_klaim_produk';
    protected $primaryKey       ='dokumen_klaim_produk_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'dokumen_klaim_produk_id',
        'dokumen_klaim_produk_unique_code',
        'produk_id',
        'nama_produk',
        'produk_unique_code',
        'tipe_dokumen_id',
        'tipe_dokumen_unique_code',
        'nama_tipe_dokumen',
        'jenis_klaim_id',
        'jenis_klaim_unique_code',
        'nama_jenis_klaim',
        'deskripsi',
        'is_aktif',
        'tanggal_mulai',
        'tanggal_akhir',
        'is_edit',
        'version_no',
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
        'dokumen_klaim_produk_id'=>'required',
        'dokumen_klaim_produk_unique_code'=>'required',
        'produk_id'=>'required',
        'nama_produk'=>'required',
        'produk_unique_code'=>'required',
        'tipe_dokumen_id'=>'required',
        'tipe_dokumen_unique_code'=>'required',
        'nama_tipe_dokumen'=>'required',
        'jenis_klaim_id'=>'required',
        'jenis_klaim_unique_code'=>'required',
        'nama_jenis_klaim'=>'required',
        'deskripsi'=>'required',
        'is_aktif'=>'required',
        'tanggal_mulai'=>'required',
        'tanggal_akhir'=>'required',
        'is_edit'=>'required',
        'version_no'=>'required',

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
        $model = new DokumenKlaimProdukModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new DokumenKlaimProdukModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($request, $user){
        $model = new DokumenKlaimProdukModel();
        return $model->insert([
            'dokumen_klaim_produk_id'=> $request->getVar('dokumen_klaim_produk_id'),
            'dokumen_klaim_produk_unique_code'=> $request->getVar('dokumen_klaim_produk_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'tipe_dokumen_id'=> $request->getVar('tipe_dokumen_id'),
            'tipe_dokumen_unique_code'=> $request->getVar('tipe_dokumen_unique_code'),
            'nama_tipe_dokumen'=> $request->getVar('nama_tipe_dokumen'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'tanggal_mulai'=> $request->getVar('tanggal_mulai'),
            'tanggal_akhir'=> $request->getVar('tanggal_akhir'),
            'is_edit'=> $request->getVar('is_edit'),
            'version_no'=> $request->getVar('version_no'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new DokumenKlaimProdukModel();
        return $model->update($id, [
            'dokumen_klaim_produk_id'=> $request->getVar('dokumen_klaim_produk_id'),
            'dokumen_klaim_produk_unique_code'=> $request->getVar('dokumen_klaim_produk_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'tipe_dokumen_id'=> $request->getVar('tipe_dokumen_id'),
            'tipe_dokumen_unique_code'=> $request->getVar('tipe_dokumen_unique_code'),
            'nama_tipe_dokumen'=> $request->getVar('nama_tipe_dokumen'),
            'jenis_klaim_id'=> $request->getVar('jenis_klaim_id'),
            'jenis_klaim_unique_code'=> $request->getVar('jenis_klaim_unique_code'),
            'nama_jenis_klaim'=> $request->getVar('nama_jenis_klaim'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'tanggal_mulai'=> $request->getVar('tanggal_mulai'),
            'tanggal_akhir'=> $request->getVar('tanggal_akhir'),
            'is_edit'=> $request->getVar('is_edit'),
            'version_no'=> $request->getVar('version_no'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $user){
        $model = new DokumenKlaimProdukModel();
        $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }
}
