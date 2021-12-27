<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaPangkatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_pangkat';
    protected $primaryKey       ='peserta_pangkat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_pangkat_id',
        'peserta_pangkat_unique_code',
        'no_surat_keputusan_pangkat',
        'peserta_id',
        'nama_peserta',
        'tgl_surat_keputusan_pangkat',
        'tmt_surat_keputusan_pangkat',
        'tanggal_kejadian',
        'tempat_kejadian',
        'pangkat_id',
        'nama_pangkat',
        'unit_organisasi_surat_keputusan_id',
        'nama_unit_organisasi',
        'status_tunjangan',
        'jumlah_santunan',
        'jumlah_tunjangan',
        'keterangan',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'gaji_pokok',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'peserta_pangkat_unique_code'=>'required',
        'no_surat_keputusan_pangkat'=>'required',
        'peserta_id'=>'required',
        'nama_peserta'=>'required',
        'tgl_surat_keputusan_pangkat'=>'required',
        'tmt_surat_keputusan_pangkat'=>'required',
        'tanggal_kejadian'=>'required',
        'tempat_kejadian'=>'required',
        'pangkat_id'=>'required',
        'nama_pangkat'=>'required',
        'unit_organisasi_surat_keputusan_id'=>'required',
        'nama_unit_organisasi'=>'required',
        'status_tunjangan'=>'required',
        'jumlah_santunan'=>'required',
        'jumlah_tunjangan'=>'required',
        'keterangan'=>'required',
        'gaji_pokok'=>'required',
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
        $model = new PesertaPangkatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaPangkatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'peserta_pangkat_unique_code'=> $request->getVar('peserta_pangkat_unique_code'),
            'no_surat_keputusan_pangkat'=> $request->getVar('no_surat_keputusan_pangkat'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'tgl_surat_keputusan_pangkat'=> $request->getVar('tgl_surat_keputusan_pangkat'),
            'tmt_surat_keputusan_pangkat'=> $request->getVar('tmt_surat_keputusan_pangkat'),
            'tanggal_kejadian'=> $request->getVar('tanggal_kejadian'),
            'tempat_kejadian'=> $request->getVar('tempat_kejadian'),
            'pangkat_id'=> $request->getVar('pangkat_id'),
            'nama_pangkat'=> $request->getVar('nama_pangkat'),
            'unit_organisasi_surat_keputusan_id'=> $request->getVar('unit_organisasi_surat_keputusan_id'),
            'nama_unit_organisasi'=> $request->getVar('nama_unit_organisasi'),
            'status_tunjangan'=> $request->getVar('status_tunjangan'),
            'jumlah_santunan'=> $request->getVar('jumlah_santunan'),
            'jumlah_tunjangan'=> $request->getVar('jumlah_tunjangan'),
            'keterangan'=> $request->getVar('keterangan'),
            'gaji_pokok'=> $request->getVar('gaji_pokok'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'peserta_pangkat_unique_code'=> $request->getVar('peserta_pangkat_unique_code'),
            'no_surat_keputusan_pangkat'=> $request->getVar('no_surat_keputusan_pangkat'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'tgl_surat_keputusan_pangkat'=> $request->getVar('tgl_surat_keputusan_pangkat'),
            'tmt_surat_keputusan_pangkat'=> $request->getVar('tmt_surat_keputusan_pangkat'),
            'tanggal_kejadian'=> $request->getVar('tanggal_kejadian'),
            'tempat_kejadian'=> $request->getVar('tempat_kejadian'),
            'pangkat_id'=> $request->getVar('pangkat_id'),
            'nama_pangkat'=> $request->getVar('nama_pangkat'),
            'unit_organisasi_surat_keputusan_id'=> $request->getVar('unit_organisasi_surat_keputusan_id'),
            'nama_unit_organisasi'=> $request->getVar('nama_unit_organisasi'),
            'status_tunjangan'=> $request->getVar('status_tunjangan'),
            'jumlah_santunan'=> $request->getVar('jumlah_santunan'),
            'jumlah_tunjangan'=> $request->getVar('jumlah_tunjangan'),
            'keterangan'=> $request->getVar('keterangan'),
            'gaji_pokok'=> $request->getVar('gaji_pokok'),

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
