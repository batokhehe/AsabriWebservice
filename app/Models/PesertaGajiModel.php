<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaGajiModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_peserta_gaji';
    protected $primaryKey       ='peserta_gaji_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'peserta_gaji_id',
		'peserta_gaji_unique_code',
		'peserta_id',
		'peserta_unique_code',
		'nama_peserta',
		'status',
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
		'peserta_gaji_unique_code' => 'required',
		'peserta_id' => 'required',
		'peserta_unique_code' => 'required',
		'nama_peserta' => 'required',
		'status' => 'required',


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
        $model = new PesertaGajiModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaGajiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
			'peserta_gaji_unique_code' => $request->getVar('peserta_gaji_unique_code'),
			'peserta_id' => $request->getVar('peserta_id'),
			'peserta_unique_code' => $request->getVar('peserta_unique_code'),
			'nama_peserta' => $request->getVar('nama_peserta'),
			'status' => $request->getVar('status'),


			'created_date'=> date('Y-m-d H:i:s'),
			'created_by'=> $user->data->email,
			'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
			'peserta_gaji_unique_code' => $request->getVar('peserta_gaji_unique_code'),
			'peserta_id' => $request->getVar('peserta_id'),
			'peserta_unique_code' => $request->getVar('peserta_unique_code'),
			'nama_peserta' => $request->getVar('nama_peserta'),
			'status' => $request->getVar('status'),


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
