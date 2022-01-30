<?php

namespace App\Models;

use CodeIgniter\Model;

class KlaimManfaatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_klaim_manfaat';
    protected $primaryKey       = 'klaim_manfaat_id';
    protected $uniqueCode       = 'klaim_manfaat_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'klaim_manfaat_id',
        'klaim_manfaat_unique_code',
        'klaim_id',
        'klaim_unique_code',
        'nomor_klaim',
        'manfaat_id',
        'manfaat_unique_code',
        'nama_manfaat',
        'deskripsi',
        'nilai_manfaat',
        'nilai_manfaat_disetujui',
        'nilai_manfaat_dibayar',
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
    protected $validationRules = [
        'klaim_manfaat_unique_code' => 'required',
        'klaim_id'                  => 'required|is_klaim_exists[klaim_id]',
        'nomor_klaim'               => 'required',
        'manfaat_id'                => 'required|is_manfaat_exists[manfaat_id]',
        'deskripsi'                 => 'required',
        'nilai_manfaat'             => 'required',
        'nilai_manfaat_disetujui'   => 'required',
        'nilai_manfaat_dibayar'     => 'required',
        'status'                    => 'required',
    ];
    protected $validationMessages   = [];
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

    public static function getAll()
    {
        $model = new KlaimManfaatModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new KlaimManfaatModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $klaim   = KlaimModel::findById($request->getVar('klaim_id'));
        $manfaat = ManfaatModel::findById($request->getVar('manfaat_id'));
        return $model->insert([
            'klaim_manfaat_unique_code' => $request->getVar('klaim_manfaat_unique_code'),
            'klaim_id'                  => $request->getVar('klaim_id'),
            'klaim_unique_code'         => $klaim['klaim_unique_code'],
            'nomor_klaim'               => $request->getVar('nomor_klaim'),
            'manfaat_id'                => $request->getVar('manfaat_id'),
            'manfaat_unique_code'       => $manfaat['manfaat_unique_code'],
            'nama_manfaat'              => $manfaat['nama_manfaat'],
            'deskripsi'                 => $request->getVar('deskripsi'),
            'nilai_manfaat'             => $request->getVar('nilai_manfaat'),
            'nilai_manfaat_disetujui'   => $request->getVar('nilai_manfaat_disetujui'),
            'nilai_manfaat_dibayar'     => $request->getVar('nilai_manfaat_dibayar'),
            'status'                    => $request->getVar('status'),

            'created_date'              => date('Y-m-d H:i:s'),
            'created_by'                => $user->data->email,
            'deleted_status'            => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'klaim_manfaat_unique_code' => $request->getVar('klaim_manfaat_unique_code'),
            'klaim_id'                  => $request->getVar('klaim_id'),
            'klaim_unique_code'         => $request->getVar('klaim_unique_code'),
            'nomor_klaim'               => $request->getVar('nomor_klaim'),
            'manfaat_id'                => $request->getVar('manfaat_id'),
            'manfaat_unique_code'       => $request->getVar('manfaat_unique_code'),
            'nama_manfaat'              => $request->getVar('nama_manfaat'),
            'deskripsi'                 => $request->getVar('deskripsi'),
            'nilai_manfaat'             => $request->getVar('nilai_manfaat'),
            'nilai_manfaat_disetujui'   => $request->getVar('nilai_manfaat_disetujui'),
            'nilai_manfaat_dibayar'     => $request->getVar('nilai_manfaat_dibayar'),
            'status'                    => $request->getVar('status'),

            'last_update_by'            => $user->data->email,
            'last_update_date'          => date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user)
    {
        return $model->update($id, [
            'deleted_status' => 1,
            'deleted_by'     => $user->data->email,
            'deleted_date'   => date('Y-m-d H:i:s'),
        ]);
    }

    public function getAvailableId($model)
    {
        $result = $model->orderBy($model->primaryKey, 'ASC')->findColumn($model->primaryKey);
        if (!empty($result) > 0) {
            return $result[count($result) - 1] + 1;
        } else {
            return 1;
        }

    }

    public function isUniqueCode($model, $uniqueCode, $id)
    {
        $model->where($this->uniqueCode, $uniqueCode);
        if ($id != null) {
            $model->where($this->primaryKey . ' !=', $id);
        }
        $result = $model->findAll();
        return count($result);
    }
}
