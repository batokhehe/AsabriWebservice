<?php

namespace App\Models;

use CodeIgniter\Model;

class KesatuanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_kesatuan';
    protected $primaryKey       = 'kesatuan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kesatuan_id',
        'kesatuan_unique_code',
        'nama_kesatuan',
        'kode_kesatuan',
        'deskripsi',
        'provinsi_id',
        'nama_provinsi',
        'provinsi_unique_code',
        'kota_id',
        'nama_kota',
        'kota_unique_code',
        'kecamatan_id',
        'nama_kecamatan',
        'kecamatan_unique_code',
        'kelurahan_id',
        'nama_kelurahan',
        'kelurahan_unique_code',
        'unit_organisasi_id',
        'nama_unit_organisasi',
        'unit_organisasi_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'alamat',
        'kode_pos',
        'telephone',
        'nomor_po_box',
        'faximile',
        'kantor_cabang_id',
        'kode_kantor_cabang',
        'nama_kantor_cabang',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'kesatuan_unique_code' => 'required|is_unique[mst_kesatuan.kesatuan_unique_code]',
            'nama_kesatuan' => 'required', 
            'kode_kesatuan' => 'required',
            'deskripsi' => 'required',
            'provinsi_id' => 'required|is_provinsi_exists[provinsi_id]',
            'kota_id' => 'required|is_kota_exists[provinsi_id]',
            'kecamatan_id' => 'required|is_kecamatan_exists[kecamatan_id]',
            'kelurahan_id' => 'required|is_kelurahan_exists[kelurahan_id]',
            'unit_organisasi_id' => 'required|is_unit_organisasi_exists[unit_organisasi_id]',
            'alamat' => 'required',
            'kode_pos' => 'required',
            'telephone' => 'required',
            'nomor_po_box' => 'required',
            'faximile' => 'required',
            'kantor_cabang_id' => 'required|is_kantor_cabang_exists[kantor_cabang_id]',
        ];
    protected $validationMessages   = [
            'kesatuan_unique_code' => [
                'required' => 'Kode Kesatuan is required'
            ],
            'nama_kesatuan' => [
                'required' => 'Nama Kesatuan is required',
            ],
            'kode_kesatuan' => [
                'required' => 'Kode Kesatuan is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Kesatuan is required'
            ],

            'provinsi_id' => [
                'required' => 'Provinsi is required',
                'is_provinsi_exists' => 'Provinsi is not exists',
            ],
            'kota_id' => [
                'required' => 'Kota is required',
                'is_kota_exists' => 'Kota is not exists',
            ],
            'kecamatan_id' => [
                'required' => 'Kecamatan is required',
                'is_kecamatan_exists' => 'Kecamatan is not exists',
            ],
            'kelurahan_id' => [
                'required' => 'Kelurahan is required',
                'is_kelurahan_exists' => 'Kelurahan is not exists',
            ],
            'unit_organisasi_id' => [
                'required' => 'Unit Organisasi is required',
                'is_kelurahan_exists' => 'Unit Organisasi is not exists',
            ],

            'alamat' => [
                'required' => 'Alamat is required'
            ],
            'kode_pos' => [
                'required' => 'Kode Pos is required'
            ],
            'telephone' => [
                'required' => 'Telefon is required'
            ],
            'nomor_po_box' => [
                'required' => 'No PO Box is required'
            ],
            'faximile' => [
                'required' => 'Fax is required'
            ],
            'kantor_cabang_id' => [
                'required' => 'Kantor Cabang is required'
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
        $model = new KesatuanModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id){
        $model = new KesatuanModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'kesatuan_unique_code' =>  $request->getVar('kesatuan_unique_code'), 
            'nama_kesatuan' =>  $request->getVar('nama_kesatuan'), 
            'kode_kesatuan' =>  $request->getVar('kode_kesatuan'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 

            'provinsi_id' =>  $request->getVar('provinsi_id'), 
            'kota_id' =>  $request->getVar('kota_id'), 
            'kecamatan_id' =>  $request->getVar('kecamatan_id'), 
            'kelurahan_id' =>  $request->getVar('kelurahan_id'), 
            'alamat' =>  $request->getVar('alamat'),
            'kode_pos' =>  $request->getVar('kode_pos'), 
            'telephone' =>  $request->getVar('telephone'), 
            'nomor_po_box' =>  $request->getVar('nomor_po_box'), 
            'faximile' =>  $request->getVar('faximile'), 
            'kantor_cabang_id' =>  $request->getVar('kantor_cabang_id'), 
            'unit_organisasi_id' =>  $request->getVar('unit_organisasi_id'), 

            'created_by' => $user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'kesatuan_unique_code' =>  $request->getVar('kesatuan_unique_code'), 
            'nama_kesatuan' =>  $request->getVar('nama_kesatuan'), 
            'kode_kesatuan' =>  $request->getVar('kode_kesatuan'), 
            'deskripsi' =>  $request->getVar('deskripsi'), 

            'provinsi_id' =>  $request->getVar('provinsi_id'), 
            'kota_id' =>  $request->getVar('kota_id'), 
            'kecamatan_id' =>  $request->getVar('kecamatan_id'), 
            'kelurahan_id' =>  $request->getVar('kelurahan_id'), 
            'alamat' =>  $request->getVar('alamat'),
            'kode_pos' =>  $request->getVar('kode_pos'), 
            'telephone' =>  $request->getVar('telephone'), 
            'nomor_po_box' =>  $request->getVar('nomor_po_box'), 
            'faximile' =>  $request->getVar('faximile'), 
            'kantor_cabang_id' =>  $request->getVar('kantor_cabang_id'), 
            'unit_organisasi_id' =>  $request->getVar('unit_organisasi_id'), 
            
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
