<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_produk';
    protected $primaryKey       ='produk_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'produk_id',
        'produk_unique_code',
        'nama_produk',
        'kode_produk',
        'deskripsi',
        'jenis_produk_id',
        'jenis_produk_unique_code',
        'nama_jenis_produk',
        'premi_bulanan_pemberi_kerja',
        'premi_bulanan_pekerja',
        'is_asuransi',
        'is_pensiun',
        'is_pinjaman',
        'nomor_surat_keputusan_terakhir',
        'tanggal_surat_keputusan_terakhir',
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
        'produk_unique_code'=>'required',
        'nama_produk'=>'required',
        'kode_produk'=>'required',
        'deskripsi'=>'required',
        'jenis_produk_id'=>'required',
        'jenis_produk_unique_code'=>'required',
        'nama_jenis_produk'=>'required',
        'premi_bulanan_pemberi_kerja'=>'required',
        'premi_bulanan_pekerja'=>'required',
        'is_asuransi'=>'required',
        'is_pensiun'=>'required',
        'is_pinjaman'=>'required',
        'nomor_surat_keputusan_terakhir'=>'required',
        'tanggal_surat_keputusan_terakhir'=>'required',

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
        $model = new ProdukModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new ProdukModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'kode_produk'=> $request->getVar('kode_produk'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'jenis_produk_id'=> $request->getVar('jenis_produk_id'),
            'jenis_produk_unique_code'=> $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk'=> $request->getVar('nama_jenis_produk'),
            'premi_bulanan_pemberi_kerja'=> $request->getVar('premi_bulanan_pemberi_kerja'),
            'premi_bulanan_pekerja'=> $request->getVar('premi_bulanan_pekerja'),
            'is_asuransi'=> $request->getVar('is_asuransi'),
            'is_pensiun'=> $request->getVar('is_pensiun'),
            'is_pinjaman'=> $request->getVar('is_pinjaman'),
            'nomor_surat_keputusan_terakhir'=> $request->getVar('nomor_surat_keputusan_terakhir'),
            'tanggal_surat_keputusan_terakhir'=> $request->getVar('tanggal_surat_keputusan_terakhir'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'kode_produk'=> $request->getVar('kode_produk'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'jenis_produk_id'=> $request->getVar('jenis_produk_id'),
            'jenis_produk_unique_code'=> $request->getVar('jenis_produk_unique_code'),
            'nama_jenis_produk'=> $request->getVar('nama_jenis_produk'),
            'premi_bulanan_pemberi_kerja'=> $request->getVar('premi_bulanan_pemberi_kerja'),
            'premi_bulanan_pekerja'=> $request->getVar('premi_bulanan_pekerja'),
            'is_asuransi'=> $request->getVar('is_asuransi'),
            'is_pensiun'=> $request->getVar('is_pensiun'),
            'is_pinjaman'=> $request->getVar('is_pinjaman'),
            'nomor_surat_keputusan_terakhir'=> $request->getVar('nomor_surat_keputusan_terakhir'),
            'tanggal_surat_keputusan_terakhir'=> $request->getVar('tanggal_surat_keputusan_terakhir'),


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
