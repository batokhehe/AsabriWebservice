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
        'kode_jenis_relasi',
        'nama_jenis_relasi',
        'kode_jiwa',
        'deskripsi',
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
            'jenis_relasi_unique_code' => 'required|is_unique[ref_jenis_relasi.jenis_relasi_unique_code]',
            'nama_jenis_relasi' => 'required', 
            'kode_jenis_relasi' => 'required',
            'kode_jiwa' => 'required',
            'deskripsi' => 'required',
            'STATUS' => 'required',
        ];
    protected $validationMessages   = [
            'jenis_relasi_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'nama_jenis_relasi' => [
                'required' => 'Nama is required',
            ],
            'kode_jenis_relasi' => [
                'required' => 'Kode is required'
            ],
            'kode_jiwa' => [
                'required' => 'Kode Jiwa is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi is required'
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
}
