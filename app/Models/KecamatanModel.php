<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_kecamatan';
    protected $primaryKey       = 'kecamatan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kecamatan_id',
        'kecamatan_unique_code',
        'nama_kecamatan',
        'kode_kecamatan',
        'deskripsi',
        'kota_id',
        'nama_kota',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'other_kecamatan_code',
        'other_kota_code',
        'other_provinsi_code',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'kecamatan_unique_code' => 'required|is_unique[ref_kecamatan.kecamatan_unique_code]',
            'nama_kecamatan' => 'required', 
            'kode_kecamatan' => 'required',
            'deskripsi' => 'required',
            'provinsi_id' => 'required|is_provinsi_exists[provinsi_id]',
            'kota_id' => 'required|is_kota_exists[kota_id]',
            'other_kode_kecamatan' => 'required'
        ];
    protected $validationMessages   = [
            'kecamatan_unique_code' => [
                'required' => 'Kode Unik Kecamatan is required'
            ],
            'nama_kecamatan' => [
                'required' => 'Nama Kecamatan is required',
            ],
            'kode_kecamatan' => [
                'required' => 'Kode Kecamatan is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Kecamatan is required'
            ],
            'provinsi_id' => [
                'required' => 'Provinsi is required',
                'is_provinsi_exists' => 'Provinsi is not exists',
            ],
            'kota_id' => [
                'required' => 'Kota is required',
                'is_kota_exists' => 'Kota is not exists',
            ],
            'other_kode_kecamatan' => [
                'required' => 'Kode Lain Kecamatan is required'
            ],
        ];
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
        $model = new KecamatanModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new KecamatanModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'kecamatan_unique_code' =>  $request->getVar('kecamatan_unique_code'), 
            'nama_kecamatan' =>  $request->getVar('nama_kecamatan'), 
            'kode_kecamatan' =>  $request->getVar('kode_kecamatan'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'provinsi_id' =>  $request->getVar('provinsi_id'),
            'kota_id' =>  $request->getVar('kota_id'),
            'other_kode_kecamatan' =>  $request->getVar('other_kode_kecamatan'), 

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'kecamatan_unique_code' =>  $request->getVar('kecamatan_unique_code'), 
            'nama_kecamatan' =>  $request->getVar('nama_kecamatan'), 
            'kode_kecamatan' =>  $request->getVar('kode_kecamatan'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'provinsi_id' =>  $request->getVar('provinsi_id'),
            'kota_id' =>  $request->getVar('kota_id'),
            'other_kode_kecamatan' =>  $request->getVar('other_kode_kecamatan'), 

            'last_update_by' => $user->data->email, 
            'last_update_date' => date('Y-m-d H:i:s'),
            'other_kode_provinsi' =>  $request->getVar('other_kode_provinsi'), 
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
