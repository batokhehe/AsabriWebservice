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
            'kesatuan_unique_code' => 'required|is_unique[ref_kesatuan.kesatuan_unique_code]',
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
            'kantor_cabang_id' => 'required',
        ];
    protected $validationMessages   = [
            'kesatuan_unique_code' => [
                'required' => 'Kesatuan Kelurahan is required'
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
}
