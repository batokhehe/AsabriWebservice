<?php

namespace App\Models;

use CodeIgniter\Model;

class BintangJasaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_bintang_jasa';
    protected $primaryKey       = 'bintang_jasa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bintang_jasa_id',
        'bintang_jasa_unique_code',
        'nama_bintang_jasa',
        'kode_bintang_jasa',
        'deskripsi',
        'is_aktif',
        'is_add_tunjangan',
        'tanggal_mulai',
        'tanggal_akhir',
        'kesatuan_id',
        'nama_kesatuan',
        'kesatuan_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'nilai_tunjangan_bulanan',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'bintang_jasa_unique_code' => 'required|is_unique[ref_bintang_jasa.bintang_jasa_unique_code]',
            'nama_bintang_jasa' => 'required', 
            'kode_bintang_jasa' => 'required',
            'deskripsi' => 'required',
            'is_aktif' => 'required',
            'is_add_tunjangan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'kesatuan_id' => 'required|is_kesatuan_exists[kesatuan_id]',
            'nilai_tunjangan_bulanan' => 'required',
        ];
    protected $validationMessages   = [
            'bintang_jasa_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'nama_bintang_jasa' => [
                'required' => 'Nama is required',
            ],
            'kode_bintang_jasa' => [
                'required' => 'Kode is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi is required'
            ],
            'is_aktif' => [
                'required' => 'Aktif is required'
            ], 
            'is_add_tunjangan' => [
                'required' => 'Tunjangan is required'
            ],
            'tanggal_mulai' => [
                'required' => 'Tanggal Mulai is required'
            ],
            'tanggal_akhir' => [
                'required' => 'Tanggal Akhir is required'
            ],
            'kesatuan_id' => [
                'required' => 'Kesatuan is required',
                'is_kesatuan_exists' => 'Kesatuan is not exists',
            ],
            'nilai_tunjangan_bulanan' => [
                'required' => 'Nilai Tunjangan Bulanan is required'
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
        $model = new BintangJasaModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new BintangJasaModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'bintang_jasa_unique_code' =>  $request->getVar('bintang_jasa_unique_code'), 
            'nama_bintang_jasa' =>  $request->getVar('nama_bintang_jasa'), 
            'kode_bintang_jasa' =>  $request->getVar('kode_bintang_jasa'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'is_aktif' =>  $request->getVar('is_aktif'),  
            'is_add_tunjangan' =>  $request->getVar('is_add_tunjangan'),  
            'tanggal_mulai' =>  $request->getVar('tanggal_mulai'),  
            'tanggal_akhir' =>  $request->getVar('tanggal_akhir'),  
            'kesatuan_id' =>  $request->getVar('kesatuan_id'),  
            'nilai_tunjangan_bulanan' =>  $request->getVar('nilai_tunjangan_bulanan'), 

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'bintang_jasa_unique_code' =>  $request->getVar('bintang_jasa_unique_code'), 
            'nama_bintang_jasa' =>  $request->getVar('nama_bintang_jasa'), 
            'kode_bintang_jasa' =>  $request->getVar('kode_bintang_jasa'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 
            'is_aktif' =>  $request->getVar('is_aktif'),  
            'is_add_tunjangan' =>  $request->getVar('is_add_tunjangan'),  
            'tanggal_mulai' =>  $request->getVar('tanggal_mulai'),  
            'tanggal_akhir' =>  $request->getVar('tanggal_akhir'),  
            'kesatuan_id' =>  $request->getVar('kesatuan_id'),  
            'nilai_tunjangan_bulanan' =>  $request->getVar('nilai_tunjangan_bulanan'), 
            
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
