<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaGajiDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mst_peserta_gaji_detail';
    protected $primaryKey       = 'peserta_gaji_id';
    protected $uniqueCode       = 'peserta_gaji_unique_code';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_gaji_detail_unique_code',
        'peserta_gaji_id',
        'peserta_gaji_unique_code',
        'element_gaji_id',
        'element_gaji_unique_code',
        'nama_element_gaji',
        'nilai_tunjangan',
        'status',
        'jumlah',
        'keterangan',
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
        'peserta_gaji_detail_unique_code' => 'required',
        'peserta_gaji_id'                 => 'required',
        'peserta_gaji_unique_code'        => 'required',
        'element_gaji_id'                 => 'required',
        'element_gaji_unique_code'        => 'required',
        'nama_element_gaji'               => 'required',
        'nilai_tunjangan'                 => 'required',
        'status'                          => 'required',
        'jumlah'                          => 'required',
        'keterangan'                      => 'required',

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
        $model = new PesertaGajiDetailModel();
        return $model->where(['deleted_status' => 0])->findAll();
    }

    public static function findById($id)
    {
        $model = new PesertaGajiDetailModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
    }

    public static function findByHeaderId($id)
    {
        $model = new PesertaGajiDetailModel();
        return $model->where(['peserta_gaji_id' => $id])->findAll();
    }

    public static function createNew($model, $id, $uniqueCode, $request, $user)
    {
        return $model->insert([
            $model->primaryKey                => $model->getAvailableId($model),
            'peserta_gaji_detail_unique_code' => $request->peserta_gaji_detail_unique_code,
            'peserta_gaji_id'                 => $id,
            'peserta_gaji_unique_code'        => $uniqueCode,
            'element_gaji_id'                 => $request->element_gaji_id,
            'element_gaji_unique_code'        => $request->element_gaji_unique_code,
            'nama_element_gaji'               => $request->nama_element_gaji,
            'nilai_tunjangan'                 => $request->nilai_tunjangan,
            'status'                          => $request->status,
            'jumlah'                          => $request->jumlah,
            'keterangan'                      => $request->keterangan,

            'created_date'                    => date('Y-m-d H:i:s'),
            'created_by'                      => $user->data->email,
            'deleted_status'                  => 0,
        ]);
    }

    public static function updateData($id, $model, $request, $user)
    {
        $peserta = PesertaModel::findById($request->getVar('peserta_id'));

        return $model->update($id, [
            'peserta_gaji_detail_unique_code' => $request->getVar('peserta_gaji_detail_unique_code'),
            'peserta_gaji_id'                 => $request->getVar('peserta_gaji_id'),
            'peserta_gaji_unique_code'        => $request->getVar('peserta_gaji_unique_code'),
            'element_gaji_id'                 => $request->getVar('element_gaji_id'),
            'element_gaji_unique_code'        => $request->getVar('element_gaji_unique_code'),
            'nama_element_gaji'               => $request->getVar('nama_element_gaji'),
            'nilai_tunjangan'                 => $request->getVar('nilai_tunjangan'),
            'status'                          => $request->getVar('status'),
            'jumlah'                          => $request->getVar('jumlah'),
            'keterangan'                      => $request->getVar('keterangan'),

            'last_update_by'                  => $user->data->email,
            'last_update_date'                => date('Y-m-d H:i:s'),
        ]);
    }

    public static function clearAll($id, $model)
    {
        return $model->where(['peserta_gaji_id' => $id])->delete();
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
            $model->where($this->primaryKey . '!=', $id);
        }
        $result = $model->findAll();
        return count($result);
    }
}
