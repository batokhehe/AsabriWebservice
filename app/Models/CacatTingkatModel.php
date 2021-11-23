<?php

namespace App\Models;

use CodeIgniter\Model;

class CacatTingkatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_cacat_tingkat';
    protected $primaryKey       = 'cacat_tingkat_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cacat_tingkat_id',
        'cacat_tingkat_unique_code',
        'nama_cacat_tingkat',
        'kode_cacat_tingkat',
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
            'cacat_tingkat_unique_code' => 'required|is_unique[ref_cacat_tingkat.cacat_tingkat_unique_code]',
            'nama_cacat_tingkat' => 'required', 
            'kode_cacat_tingkat' => 'required',
            'keterangan' => 'required',
            'STATUS' => 'required',
        ];
    protected $validationMessages   = [
            'cacat_tingkat_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'nama_cacat_tingkat' => [
                'required' => 'Nama is required',
            ],
            'kode_cacat_tingkat' => [
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
}
