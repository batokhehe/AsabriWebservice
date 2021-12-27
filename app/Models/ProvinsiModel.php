<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_provinsi';
    protected $primaryKey       = 'provinsi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'provinsi_id', 
        'nama_provinsi', 
        'kode_provinsi', 
        'provinsi_unique_code', 
        'deskripsi', 
        'created_by', 
        'created_date', 
        'last_update_by', 
        'last_update_date', 
        'deleted_status', 
        'deleted_by', 
        'deleted_date', 
        'other_kode_provinsi', 
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'nama_provinsi' => 'required', 
            'kode_provinsi' => 'required',
            'provinsi_unique_code' => 'required|is_unique[ref_provinsi.provinsi_unique_code]',
            'deskripsi' => 'required',
            'other_kode_provinsi' => 'required'
        ];
    protected $validationMessages   = [
            'nama_provinsi' => [
                'required' => 'Nama Provinsi is required'
            ],
            'kode_provinsi' => [
                'required' => 'Kode Provinsi is required',
            ],
            'provinsi_unique_code' => [
                'required' => 'Kode Unik Provinsi is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Provinsi is required'
            ],
            'other_kode_provinsi' => [
                'required' => 'Kode Lain Provinsi is required'
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
        $model = new ProvinsiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new ProvinsiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'nama_provinsi' =>  $request->getVar('nama_provinsi'), 
            'kode_provinsi' =>  $request->getVar('kode_provinsi'), 
            'provinsi_unique_code' =>  $request->getVar('provinsi_unique_code'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'other_kode_provinsi' =>  $request->getVar('other_kode_provinsi'), 

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'nama_provinsi' =>  $request->getVar('nama_provinsi'), 
            'kode_provinsi' =>  $request->getVar('kode_provinsi'), 
            'provinsi_unique_code' =>  $request->getVar('provinsi_unique_code'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'other_kode_provinsi' =>  $request->getVar('other_kode_provinsi'), 
            
            'last_update_by' => $user->data->email, 
            'last_update_date' => date('Y-m-d H:i:s'),
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
