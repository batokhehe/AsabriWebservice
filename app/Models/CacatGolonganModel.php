<?php

namespace App\Models;

use CodeIgniter\Model;

class CacatGolonganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_cacat_golongan';
    protected $primaryKey       = 'cacat_golongan_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cacat_golongan_id',
        'cacat_golongan_unique_code',
        'nama_cacat_golongan',
        'kode_cacat_golongan',
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
            'cacat_golongan_unique_code' => 'required|is_unique[ref_cacat_golongan.cacat_golongan_unique_code]',
            'nama_cacat_golongan' => 'required', 
            'kode_cacat_golongan' => 'required',
            'keterangan' => 'required',
            'STATUS' => 'required',
        ];
    protected $validationMessages   = [
            'cacat_golongan_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'nama_cacat_golongan' => [
                'required' => 'Nama is required',
            ],
            'kode_cacat_golongan' => [
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
