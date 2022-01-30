<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaGajiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_peserta_gaji';
    protected $primaryKey       = 'peserta_gaji_id';
    protected $uniqueCode       = 'peserta_gaji_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_gaji_id',
        'peserta_gaji_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
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
        'peserta_gaji_unique_code' => 'required',
        'peserta_id'               => 'required|is_peserta_exists[peserta_id]',
        'status'                   => 'required',

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
        $model = new PesertaGajiModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaGajiModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function createNew($model, $request, $user)
    {
        $peserta = PesertaModel::findById($request->getVar('peserta_id'));

        return $model->insert([
            'peserta_gaji_unique_code' => $request->getVar('peserta_gaji_unique_code'),
            'peserta_id'               => $request->getVar('peserta_id'),
            'peserta_unique_code'      => $peserta['peserta_unique_code'],
            'nama_peserta'             => $peserta['nama_peserta'],
            'status'                   => $request->getVar('status'),

            'created_date'             => date('Y-m-d H:i:s'),
            'created_by'               => $user->data->email,
            'deleted_status'           => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta = PesertaModel::findById($request->getVar('peserta_id'));
        
        return $model->update($id, [
            'peserta_gaji_unique_code' => $request->getVar('peserta_gaji_unique_code'),
            'peserta_id'               => $request->getVar('peserta_id'),
            'peserta_unique_code'      => $peserta['peserta_unique_code'],
            'nama_peserta'             => $peserta['nama_peserta'],
            'status'                   => $request->getVar('status'),

            'last_update_by'           => $user->data->email,
            'last_update_date'         => date('Y-m-d H:i:s'),
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
