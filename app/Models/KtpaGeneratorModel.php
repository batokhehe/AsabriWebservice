<?php

namespace App\Models;

use CodeIgniter\Model;

class KtpaGeneratorModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='mst_ktpa_generator';
    protected $primaryKey       ='ktpa_generator_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ktpa_generator_id',
        'unit_organisasi_id',
        'golongan_pangkat_id',
        'ktpa_prefix',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'unit_organisasi_id'=>'required',
        'golongan_pangkat_id'=>'required',
        'ktpa_prefix'=>'required',

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

    public static function getAll(){
        $model = new KtpaGeneratorModel();
        return $model->findAll();
    }

    public static function findById($id){
        $model = new KtpaGeneratorModel();
        return $model->where([$model->primaryKey => $id])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            $model->primaryKey => $model->getAvailableId($model),
            'unit_organisasi_id'=> $request->getVar('unit_organisasi_id'),
            'golongan_pangkat_id'=> $request->getVar('golongan_pangkat_id'),
            'ktpa_prefix'=> $request->getVar('ktpa_prefix'),

        ]);
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'unit_organisasi_id'=> $request->getVar('unit_organisasi_id'),
            'golongan_pangkat_id'=> $request->getVar('golongan_pangkat_id'),
            'ktpa_prefix'=> $request->getVar('ktpa_prefix'),

        ]);
    }

    public static function softDelete($id, $model, $user){
        return $model->delete($id);
    }

    public function getAvailableId($model){
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}
