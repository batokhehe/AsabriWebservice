<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_kota';
    protected $primaryKey       = 'kota_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kota_id',
        'kota_unique_code',
        'nama_kota',
        'kode_kota',
        'deskripsi',
        'provinsi_id',
        'nama_provinsi', 
        'provinsi_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'kantor_cabang_id',
        'nama_kantor_cabang',
        'kantor_cabang_unique_code',
        'kode_kantor_cabang',
        'kode_kppn',
        'kode_provinsi',
        'other_kode_kota',
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
            'kota_unique_code' => 'required|is_unique[ref_kota.kota_unique_code]',
            'nama_kota' => 'required', 
            'kode_kota' => 'required',
            'deskripsi' => 'required',
            'provinsi_id' => 'required|is_provinsi_exists[provinsi_id]',
            'other_kode_kota' => 'required'
        ];
    protected $validationMessages   = [
            'kota_unique_code' => [
                'required' => 'Kode Unik Kota is required'
            ],
            'nama_kota' => [
                'required' => 'Nama Kota is required',
            ],
            'kode_kota' => [
                'required' => 'Kode Kota is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Kota is required'
            ],
            'provinsi_id' => [
                'required' => 'Provinsi is required',
                'is_provinsi_exists' => 'Provinsi is not exists',
            ],
            'other_kode_kota' => [
                'required' => 'Kode Lain Kota is required'
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
}
