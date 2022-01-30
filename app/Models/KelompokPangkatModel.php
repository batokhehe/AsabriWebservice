<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokPangkatModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='ref_kelompok_pangkat';
    protected $primaryKey       ='kelompok_pangkat_id';
    protected $uniqueCode       ='kelompok_pangkat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kelompok_pangkat_id',
        'kelompok_pangkat_unique_code',
        'nama_kelompok_pangkat',
        'kode_kelompok_pangkat',
        'deskripsi',
        'status',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'lama_kerja',
        'ktpa_code',
        'is_pns',
        'klasifikasi',
        'increase',
        'jp_parent_id',
        'referensi_kode_pangkat',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'kelompok_pangkat_unique_code'=>'required',
        'nama_kelompok_pangkat'=>'required',
        'kode_kelompok_pangkat'=>'required',
        'deskripsi'=>'required',
        'status'=>'required',
        'lama_kerja'=>'required',
        'ktpa_code'=>'required',
        'is_pns'=>'required',
        'klasifikasi'=>'required',
        'increase'=>'required',
        'jp_parent_id'=>'required',
        'referensi_kode_pangkat'=>'required',

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
        $model = new KelompokPangkatModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new KelompokPangkatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

   public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'kelompok_pangkat_unique_code'=> $request->getVar('kelompok_pangkat_unique_code'),
            'nama_kelompok_pangkat'=> $request->getVar('nama_kelompok_pangkat'),
            'kode_kelompok_pangkat'=> $request->getVar('kode_kelompok_pangkat'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'status'=> $request->getVar('status'),
            'lama_kerja'=> $request->getVar('lama_kerja'),
            'ktpa_code'=> $request->getVar('ktpa_code'),
            'is_pns'=> $request->getVar('is_pns'),
            'klasifikasi'=> $request->getVar('klasifikasi'),
            'increase'=> $request->getVar('increase'),
            'jp_parent_id'=> $request->getVar('jp_parent_id'),
            'referensi_kode_pangkat'=> $request->getVar('referensi_kode_pangkat'),


            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'kelompok_pangkat_unique_code'=> $request->getVar('kelompok_pangkat_unique_code'),
            'nama_kelompok_pangkat'=> $request->getVar('nama_kelompok_pangkat'),
            'kode_kelompok_pangkat'=> $request->getVar('kode_kelompok_pangkat'),
            'deskripsi'=> $request->getVar('deskripsi'),
            'status'=> $request->getVar('status'),
            'lama_kerja'=> $request->getVar('lama_kerja'),
            'ktpa_code'=> $request->getVar('ktpa_code'),
            'is_pns'=> $request->getVar('is_pns'),
            'klasifikasi'=> $request->getVar('klasifikasi'),
            'increase'=> $request->getVar('increase'),
            'jp_parent_id'=> $request->getVar('jp_parent_id'),
            'referensi_kode_pangkat'=> $request->getVar('referensi_kode_pangkat'),


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

    public function getAvailableId($model)
    {
        $result = $model->orderBy($model->primaryKey, 'ASC')->findColumn($model->primaryKey);
        if (!empty($result) > 0) {
            return $result[count($result) - 1] + 1;
        } else {
            return 1;
        }

    }

    public function isUniqueCode($model, $uniqueCode, $id)
    {
        $model->where($this->uniqueCode, $uniqueCode);
        if ($id != null) {
            $model->where($this->primaryKey . ' !=', $id);
        }
        $result = $model->findAll();
        return count($result);
    }
}
