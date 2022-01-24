<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchPesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trx_batch_peserta';
    protected $primaryKey       = 'batch_peserta_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'batch_peserta_id',
        'batch_peserta_unique_code',
        'upload_date ',
        'upload_by',
        'upload_status',
        'status',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'batch_peserta_unique_code' => 'required',
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
        $model = new BatchPesertaModel();
        return $model->findAll();
    }

    public static function findById($id)
    {
        $model = new BatchPesertaModel();
        return $model->where([$model->primaryKey => $id])->first();
    }

    public static function createNew($model, $request, $user)
    {
        return $model->insert([
            $model->primaryKey          => $model->getAvailableId($model),
            'batch_peserta_unique_code' => $request->getVar('batch_peserta_unique_code'),
            'upload_status'             => $request->getVar('upload_status'),
            'status'                    => $request->getVar('status'),

            'upload_date '              => date('Y-m-d H:i:s'),
            'upload_by'                 => $user->data->email,
        ]);

    }

    public static function updateData($id, $model, $request, $user)
    {
        return $model->update($id, [
            'batch_peserta_unique_code' => $request->getVar('batch_peserta_unique_code'),
            'upload_status'             => 1,
            'status'                    => $request->getVar('status'),

            'upload_date '              => date('Y-m-d H:i:s'),
            'upload_by'                 => $user->data->email,
        ]);
    }

    public static function softDelete($id, $user)
    {
        $model = new BatchPesertaModel();
        $model->update($id, [
            'deleted_status' => 1,
            'deleted_by'     => $user->data->email,
            'deleted_date'   => date('Y-m-d H:i:s'),
        ]);
    }

    public function getAvailableId($model)
    {
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}
