<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaRekeningModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_peserta_rekening';
    protected $primaryKey       ='peserta_rekening_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'peserta_rekening_id',
		'peserta_rekening_unique_code',
		'peserta_id',
		'nama_peserta',
		'peserta_unique_code',
		'nama_bank',
		'nama_cabang_bank',
		'nomor_rekening',
		'nama_rekening',
		'status',
		'deskripsi',
		'created_by',
		'created_date',
		'last_update_by',
		'last_update_date',
		'deleted_status',
		'deleted_by',
		'deleted_date',
		'mitra_bayar_id',
		'nama_mitra_bayar',
		'cabang_mitra_bayar_id',
		'nama_cabang_mitra_bayar',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
		'peserta_rekening_unique_code' => 'required',
		'peserta_id' => 'required',
		'nama_peserta' => 'required',
		'peserta_unique_code' => 'required',
		'nama_bank' => 'required',
		'nama_cabang_bank' => 'required',
		'nomor_rekening' => 'required',
		'nama_rekening' => 'required',
		'status' => 'required',
		'deskripsi' => 'required',
		'mitra_bayar_id' => 'required',
		'nama_mitra_bayar' => 'required',
		'cabang_mitra_bayar_id' => 'required',
		'nama_cabang_mitra_bayar' => 'required',

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
        $model = new PesertaRekeningModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaRekeningModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
			'peserta_rekening_unique_code' => $request->getVar('peserta_rekening_unique_code'),
			'peserta_id' => $request->getVar('peserta_id'),
			'nama_peserta' => $request->getVar('nama_peserta'),
			'peserta_unique_code' => $request->getVar('peserta_unique_code'),
			'nama_bank' => $request->getVar('nama_bank'),
			'nama_cabang_bank' => $request->getVar('nama_cabang_bank'),
			'nomor_rekening' => $request->getVar('nomor_rekening'),
			'nama_rekening' => $request->getVar('nama_rekening'),
			'status' => $request->getVar('status'),
			'deskripsi' => $request->getVar('deskripsi'),
			'mitra_bayar_id' => $request->getVar('mitra_bayar_id'),
			'nama_mitra_bayar' => $request->getVar('nama_mitra_bayar'),
			'cabang_mitra_bayar_id' => $request->getVar('cabang_mitra_bayar_id'),
			'nama_cabang_mitra_bayar' => $request->getVar('nama_cabang_mitra_bayar'),

			'created_date'=> date('Y-m-d H:i:s'),
			'created_by'=> $user->data->email,
			'deleted_status'=>  0, 
        ]) ;
    }

   	public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
			'peserta_rekening_unique_code' => $request->getVar('peserta_rekening_unique_code'),
			'peserta_id' => $request->getVar('peserta_id'),
			'nama_peserta' => $request->getVar('nama_peserta'),
			'peserta_unique_code' => $request->getVar('peserta_unique_code'),
			'nama_bank' => $request->getVar('nama_bank'),
			'nama_cabang_bank' => $request->getVar('nama_cabang_bank'),
			'nomor_rekening' => $request->getVar('nomor_rekening'),
			'nama_rekening' => $request->getVar('nama_rekening'),
			'status' => $request->getVar('status'),
			'deskripsi' => $request->getVar('deskripsi'),
			'mitra_bayar_id' => $request->getVar('mitra_bayar_id'),
			'nama_mitra_bayar' => $request->getVar('nama_mitra_bayar'),
			'cabang_mitra_bayar_id' => $request->getVar('cabang_mitra_bayar_id'),
			'nama_cabang_mitra_bayar' => $request->getVar('nama_cabang_mitra_bayar'),

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
