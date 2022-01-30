<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghasilanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_penghasilan';
    protected $primaryKey       = 'penghasilan_id';
    protected $uniqueCode       = 'penghasilan_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'penghasilan_id',
        'nama_penghasilan',
        'penghasilan_unique_code',
        'tanggal_efektif',
        'tanggal_selesai',
        'nilai_penghasilan_pokok',
        'keterangan',
        'pangkat_id',
        'nama_pangkat',
        'pangkat_unique_code',
        'is_pensiun',
        'is_gaji',
        'created_date',
        'created_by',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_by',
        'deleted_status',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_penghasilan'        => 'required',
        'penghasilan_unique_code' => 'required',
        'tanggal_efektif'         => 'required',
        'tanggal_selesai'         => 'required',
        'nilai_penghasilan_pokok' => 'required',
        'keterangan'              => 'required',
        'pangkat_id'              => 'required|is_pangkat_exists[pangkat_id]',
        'is_pensiun'              => 'required',
        'is_gaji'                 => 'required',

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
        $model = new PenghasilanModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PenghasilanModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $pangkat = PangkatModel::findById($request->getVar('pangkat_id'));

        return $model->insert([
            $model->primaryKey        => $model->getAvailableId($model),
            'nama_penghasilan'        => $request->getVar('nama_penghasilan'),
            'penghasilan_unique_code' => $request->getVar('penghasilan_unique_code'),
            'tanggal_efektif'         => $request->getVar('tanggal_efektif'),
            'tanggal_selesai'         => $request->getVar('tanggal_selesai'),
            'nilai_penghasilan_pokok' => $request->getVar('nilai_penghasilan_pokok'),
            'keterangan'              => $request->getVar('keterangan'),
            'pangkat_id'              => $request->getVar('pangkat_id'),
            'nama_pangkat'            => $pangkat['nama_pangkat'],
            'pangkat_unique_code'     => $pangkat['pangkat_unique_code'],
            'is_pensiun'              => $request->getVar('is_pensiun'),
            'is_gaji'                 => $request->getVar('is_gaji'),

            'created_by'              => $user->data->email,
            'created_date'            => date('Y-m-d H:i:s'),
            'deleted_status'          => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $pangkat = PangkatModel::findById($request->getVar('pangkat_id'));
        
        return $model->update($id, [
            'nama_penghasilan'        => $request->getVar('nama_penghasilan'),
            'penghasilan_unique_code' => $request->getVar('penghasilan_unique_code'),
            'tanggal_efektif'         => $request->getVar('tanggal_efektif'),
            'tanggal_selesai'         => $request->getVar('tanggal_selesai'),
            'nilai_penghasilan_pokok' => $request->getVar('nilai_penghasilan_pokok'),
            'keterangan'              => $request->getVar('keterangan'),
            'pangkat_id'              => $request->getVar('pangkat_id'),
            'nama_pangkat'            => $pangkat['nama_pangkat'],
            'pangkat_unique_code'     => $pangkat['pangkat_unique_code'],
            'is_pensiun'              => $request->getVar('is_pensiun'),
            'is_gaji'                 => $request->getVar('is_gaji'),

            'last_update_by'          => $user->data->email,
            'last_update_date'        => date('Y-m-d H:i:s'),
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
