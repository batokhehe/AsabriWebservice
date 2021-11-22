<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_kelurahan';
    protected $primaryKey       = 'kelurahan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kelurahan_id',
        'kelurahan_unique_code',
        'nama_kelurahan',
        'kode_kelurahan',
        'deskripsi',
        'kecamatan_id',
        'nama_kecamatan',
        'kecamatan_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
        'other_kode_kelurahan',
        'other_kode_kecamatan',
        'other_kode_kota',
        'other_kode_provinsi'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'kelurahan_unique_code' => 'required|is_unique[ref_kelurahan.kelurahan_unique_code]',
            'nama_kelurahan' => 'required', 
            'kode_kelurahan' => 'required',
            'deskripsi' => 'required',
            'kecamatan_id' => 'required|is_kecamatan_exists[kecamatan_id]',
            'other_kode_kelurahan' => 'required'
        ];
    protected $validationMessages   = [
            'kelurahan_unique_code' => [
                'required' => 'Kode Unik Kelurahan is required'
            ],
            'nama_kelurahan' => [
                'required' => 'Nama Kelurahan is required',
            ],
            'kode_kelurahan' => [
                'required' => 'Kode Kelurahan is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Kelurahan is required'
            ],
            'kecamatan_id' => [
                'required' => 'Kecamatan is required',
                'is_kecamatan_exists' => 'Kecamatan is not exists',
            ],
            'other_kode_kelurahan' => [
                'required' => 'Kode Lain Kelurahan is required'
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
