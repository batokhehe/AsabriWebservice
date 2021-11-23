<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRelasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_jenis_relasi';
    protected $primaryKey       = 'jenis_relasi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_relasi_id',
        'jenis_relasi_unique_code',
        'nama_jenis_relasi',
        'kode_jenis_relasi',
        'kode_jiwa',
        'deskripsi',
        'status',
        'created_by',
        'created_date',
        'last_update_date',
        'last_update_by',
        'deleted_status',
        'deleted_by',
        'deleted_date'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'last_update_date';
    protected $deletedField  = 'deleted_date';

    // Validation
    protected $validationRules      = [];
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
        $model = new JenisRelasiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new JenisRelasiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($request, $user){
        $model = new JenisRelasiModel();
        return $model->insert([
            'jenis_relasi_unique_code' => $request->getVar('jenis_relasi_unique_code'),
            'nama_jenis_relasi' => $request->getVar('nama_jenis_relasi'),
            'kode_jenis_relasi' => $request->getVar('kode_jenis_relasi'),
            'kode_jiwa' => $request->getVar('kode_jiwa'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            'created_by' => $user->data->email,
        ]) ;
    }

    public static function updateData($id, $request, $user){
        $model = new JenisRelasiModel();
        return $model->update($id, [
            'jenis_relasi_unique_code' => $request->getVar('jenis_relasi_unique_code'),
            'nama_jenis_relasi' => $request->getVar('nama_jenis_relasi'),
            'kode_jenis_relasi' => $request->getVar('kode_jenis_relasi'),
            'kode_jiwa' => $request->getVar('kode_jiwa'),
            'deskripsi' => $request->getVar('deskripsi'),
            'status' => $request->getVar('status'),
            'updated_by' => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user){
        $model = new JenisRelasiModel();
        $model->update($id,[
            'deleted_status' => 1,
            'deleted_by' => $user->data->email,
            'deleted_date' => date('Y-m-d H:i:s')
        ]);
    }
}
