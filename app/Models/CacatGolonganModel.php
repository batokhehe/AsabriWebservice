<?php

namespace App\Models;

use CodeIgniter\Model;

class CacatGolonganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_cacat_golongan';
    protected $primaryKey       = 'cacat_golongan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cacat_golongan_id',
        'cacat_golongan_unique_code',
        'nama_cacat_golongan',
        'kode_cacat_golongan',
        'keterangan',
        'STATUS',
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
            'cacat_golongan_unique_code' => 'required|is_unique[ref_cacat_golongan.cacat_golongan_unique_code]',
            'nama_cacat_golongan' => 'required', 
            'kode_cacat_golongan' => 'required',
            'keterangan' => 'required',
            'STATUS' => 'required',
        ];
    protected $validationMessages   = [
            'cacat_golongan_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'nama_cacat_golongan' => [
                'required' => 'Nama is required',
            ],
            'kode_cacat_golongan' => [
                'required' => 'Kode is required'
            ],
            'keterangan' => [
                'required' => 'Keterangan is required'
            ],
            'STATUS' => [
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
        $model = new CacatGolonganModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new CacatGolonganModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'cacat_golongan_unique_code' =>  $request->getVar('cacat_golongan_unique_code'), 
            'nama_cacat_golongan' =>  $request->getVar('nama_cacat_golongan'), 
            'kode_cacat_golongan' =>  $request->getVar('kode_cacat_golongan'), 
            'keterangan' =>  $request->getVar('keterangan'), 
            'STATUS' =>  $request->getVar('STATUS'),  

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'cacat_golongan_unique_code' =>  $request->getVar('cacat_golongan_unique_code'), 
            'nama_cacat_golongan' =>  $request->getVar('nama_cacat_golongan'), 
            'kode_cacat_golongan' =>  $request->getVar('kode_cacat_golongan'), 
            'keterangan' =>  $request->getVar('keterangan'), 
            'STATUS' =>  $request->getVar('STATUS'),  

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
