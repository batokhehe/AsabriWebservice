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
}
