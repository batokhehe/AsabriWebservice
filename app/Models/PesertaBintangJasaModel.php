<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaBintangJasaModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_bintang_jasa';
    protected $primaryKey       ='peserta_bintang_jasa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_bintang_jasa_id',
        'peserta_id',
        'bintang_jasa_id',
        'peserta_unique_code',
        'nama_peserta',
        'nama_bintang_jasa',
        'nomor_surat_keputusan',
        'tanggal_surat_keputusan',
        'pembuat_surat_keputusan',
        'nilai_tunjangan',
        'status',
        'keterangan',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_status',
        'deleted_by',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'peserta_id'=>'required',
        'bintang_jasa_id'=>'required',
        'peserta_unique_code'=>'required',
        'nama_peserta'=>'required',
        'nama_bintang_jasa'=>'required',
        'nomor_surat_keputusan'=>'required',
        'tanggal_surat_keputusan'=>'required',
        'pembuat_surat_keputusan'=>'required',
        'nilai_tunjangan'=>'required',
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
        $model = new PesertaBintangJasaModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaBintangJasaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'peserta_id'=> $request->getVar('peserta_id'),
            'bintang_jasa_id'=> $request->getVar('bintang_jasa_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'nama_bintang_jasa'=> $request->getVar('nama_bintang_jasa'),
            'nomor_surat_keputusan'=> $request->getVar('nomor_surat_keputusan'),
            'tanggal_surat_keputusan'=> $request->getVar('tanggal_surat_keputusan'),
            'pembuat_surat_keputusan'=> $request->getVar('pembuat_surat_keputusan'),
            'nilai_tunjangan'=> $request->getVar('nilai_tunjangan'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),


            'created_by'=> $user->data->email, 
            'created_date'=> date('Y-m-d H:i:s'),
            'deleted_status'=>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'peserta_id'=> $request->getVar('peserta_id'),
            'bintang_jasa_id'=> $request->getVar('bintang_jasa_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'nama_bintang_jasa'=> $request->getVar('nama_bintang_jasa'),
            'nomor_surat_keputusan'=> $request->getVar('nomor_surat_keputusan'),
            'tanggal_surat_keputusan'=> $request->getVar('tanggal_surat_keputusan'),
            'pembuat_surat_keputusan'=> $request->getVar('pembuat_surat_keputusan'),
            'nilai_tunjangan'=> $request->getVar('nilai_tunjangan'),
            'status'=> $request->getVar('status'),
            'keterangan'=> $request->getVar('keterangan'),

                
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
