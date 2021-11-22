<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
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
                'is_provinsi_exists' => 'Kota is not exists',
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
}
