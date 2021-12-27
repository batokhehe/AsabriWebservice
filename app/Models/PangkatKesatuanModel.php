<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatKesatuanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_pangkat_kesatuan';
    protected $primaryKey       = 'pangkat_kesatuan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pangkat_kesatuan_id',
        'pangkat_kesatuan_unique_code',
        'pangkat_id',
        'pangkat_unique_code',
        'nama_pangkat',
        'kesatuan_id',
        'kesatuan_unique_code',
        'nama_kesatuan',
        'deskripsi',
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
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'pangkat_kesatuan_unique_code' => 'required|is_unique[ref_pangkat_kesatuan.pangkat_kesatuan_unique_code]',
            'pangkat_id' => 'required|is_pangkat_exists[pangkat_id]',
            'kesatuan_id' => 'required|is_kesatuan_exists[kesatuan_id]',
            'deskripsi' => 'required',
            'status' => 'required',
        ];
    protected $validationMessages   = [
            'pangkat_unique_code' => [
                'required' => 'Kode Pangkat Kesatuan is required'
            ],
            'pangkat_id' => [
                'required' => 'Pangkat is required',
                'is_pangkat_exists' => 'Pangkat is not exists',
            ],
            'kesatuan_id' => [
                'required' => 'Kesatuan is required',
                'is_kesatuan_exists' => 'Kesatuan is not exists',
            ],
            'deskripsi' => [
                'required' => 'Deskripsi is required'
            ],
            'status' => [
                'required' => 'Status is required'
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
        $model = new PangkatKesatuanModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new PangkatKesatuanModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'pangkat_kesatuan_unique_code' =>  $request->getVar('pangkat_kesatuan_unique_code'), 
            'pangkat_id' =>  $request->getVar('pangkat_id'), 
            'kesatuan_id' =>  $request->getVar('kesatuan_id'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'status' =>  $request->getVar('status'), 

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'pangkat_kesatuan_unique_code' =>  $request->getVar('pangkat_kesatuan_unique_code'), 
            'pangkat_id' =>  $request->getVar('pangkat_id'), 
            'kesatuan_id' =>  $request->getVar('kesatuan_id'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'status' =>  $request->getVar('status'),  
            
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
