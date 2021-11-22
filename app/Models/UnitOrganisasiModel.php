<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ref_unit_organisasi';
    protected $primaryKey       = 'unit_organisasi_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'unit_organisasi_id',
        'unit_organisasi_unique_code',
        'nama_unit_organisasi',
        'kode_unit_organisasi',
        'keterangan',
        'status',
        'unit_organisasi_induk_id',
        'nama_unit_organisasi_induk',
        'unit_organisasi_induk_unique_code',
        'created_by',
        'created_date',
        'last_update_by',
        'last_update_date',
        'deleted_status',
        'deleted_by',
        'deleted_date',
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
        'alamat',
        'postal_code',
        'telephone',
        'faximile',
        'unit_organisasi_short_name',
        'sp_id',
        'list_akt_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'unit_organisasi_unique_code' => 'required|is_unique[ref_unit_organisasi.unit_organisasi_unique_code]',
            'nama_unit_organisasi' => 'required', 
            'kode_unit_organisasi' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'unit_organisasi_induk_id' => 'required',
            'provinsi_id' => 'required|is_provinsi_exists[provinsi_id]',
            'kota_id' => 'required|is_kota_exists[provinsi_id]',
            'kecamatan_id' => 'required|is_kecamatan_exists[kecamatan_id]',
            'kelurahan_id' => 'required|is_kelurahan_exists[kelurahan_id]',
            'alamat' => 'required',
            'postal_code' => 'required',
            'telephone' => 'required',
            'faximile' => 'required',
            'unit_organisasi_short_name' => 'required',
            'sp_id' => 'required',
            'list_akt_id' => 'required',
        ];
    protected $validationMessages   = [
            'unit_organisasi_unique_code' => [
                'required' => 'Unit Organisasi Kelurahan is required'
            ],
            'nama_unit_organisasi' => [
                'required' => 'Nama Unit Organisasi is required',
            ],
            'kode_unit_organisasi' => [
                'required' => 'Kode Unit Organisasi is required'
            ],
            'keterangan' => [
                'required' => 'Keterangan Unit Organisasi is required'
            ],
            'status' => [
                'required' => 'Status Unit Organisasi is required'
            ],
            'unit_organisasi_induk_id' => [
                'required' => 'Id Unit Organisasi Induk is required'
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

            'alamat' => [
                'required' => 'Alamat is required'
            ],
            'postal_code' => [
                'required' => 'Kode Pos is required'
            ],
            'telephone' => [
                'required' => 'Telefon is required'
            ],
            'faximile' => [
                'required' => 'Fax is required'
            ],
            'unit_organisasi_short_name' => [
                'required' => 'Unit Organisasi Short Name is required'
            ],
            'sp_id' => [
                'required' => 'SP is required'
            ],
            'list_akt_id' => [
                'required' => 'List AKT is required'
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
