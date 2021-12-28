<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukPremiModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_produk_premi';
    protected $primaryKey       ='produk_premi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'produk_premi_id',
        'produk_premi_unique_code',
        'produk_id',
        'produk_unique_code',
        'nama_produk',
        'premi_bulanan_pemberi_kerja',
        'premi_bulanan_pekerja',
        'tmt_awal',
        'tmt_akhir',
        'is_aktif',
        'deskripsi',
        'nomor_surat_keputusan',
        'tanggal_surat_keputusan',
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
        'produk_premi_unique_code'=>'required',
        'produk_id'=>'required',
        'produk_unique_code'=>'required',
        'nama_produk'=>'required',
        'premi_bulanan_pemberi_kerja'=>'required',
        'premi_bulanan_pekerja'=>'required',
        'tmt_awal'=>'required',
        'tmt_akhir'=>'required',
        'is_aktif'=>'required',
        'deskripsi'=>'required',
        'nomor_surat_keputusan'=>'required',
        'tanggal_surat_keputusan'=>'required',

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
        $model = new ProdukPremiModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new ProdukPremiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'produk_premi_unique_code'=> $request->getVar('produk_premi_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'premi_bulanan_pemberi_kerja'=> $request->getVar('premi_bulanan_pemberi_kerja'),
            'premi_bulanan_pekerja'=> $request->getVar('premi_bulanan_pekerja'),
            'tmt_awal'=> $request->getVar('tmt_awal'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nomor_surat_keputusan'=> $request->getVar('nomor_surat_keputusan'),
            'tanggal_surat_keputusan'=> $request->getVar('tanggal_surat_keputusan'),

            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'produk_premi_unique_code'=> $request->getVar('produk_premi_unique_code'),
            'produk_id'=> $request->getVar('produk_id'),
            'produk_unique_code'=> $request->getVar('produk_unique_code'),
            'nama_produk'=> $request->getVar('nama_produk'),
            'premi_bulanan_pemberi_kerja'=> $request->getVar('premi_bulanan_pemberi_kerja'),
            'premi_bulanan_pekerja'=> $request->getVar('premi_bulanan_pekerja'),
            'tmt_awal'=> $request->getVar('tmt_awal'),
            'tmt_akhir'=> $request->getVar('tmt_akhir'),
            'is_aktif'=> $request->getVar('is_aktif'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'nomor_surat_keputusan'=> $request->getVar('nomor_surat_keputusan'),
            'tanggal_surat_keputusan'=> $request->getVar('tanggal_surat_keputusan'),

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
