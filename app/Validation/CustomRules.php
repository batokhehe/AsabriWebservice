<?php 
namespace App\Validation;

use App\Models\ProvinsiModel;
use App\Models\KotaModel;
use App\Models\KecamatanModel;

class CustomRules
{
    public function is_provinsi_exists($id) {
        $model = new ProvinsiModel();
        $data = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function is_kota_exists($id) {
        $model = new KotaModel();
        $data = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function is_kecamatan_exists($id) {
        $model = new KecamatanModel();
        $data = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0){
            return true;
        } else {
            return false;
        }
    }
}