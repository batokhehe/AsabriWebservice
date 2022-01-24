<?php
namespace App\Validation;

use App\Models\KantorCabangModel;
use App\Models\KecamatanModel;
use App\Models\KesatuanModel;
use App\Models\KotaModel;
use App\Models\PangkatModel;
use App\Models\ProvinsiModel;
use App\Models\UnitOrganisasiModel;

class CustomRules
{
    public function is_provinsi_exists($id)
    {
        $model = new ProvinsiModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kota_exists($id)
    {
        $model = new KotaModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kecamatan_exists($id)
    {
        $model = new KecamatanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kelurahan_exists($id)
    {
        $model = new KecamatanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_unit_organisasi_exists($id)
    {
        $model = new UnitOrganisasiModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_pangkat_exists($id)
    {
        $model = new PangkatModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kesatuan_exists($id)
    {
        $model = new KesatuanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kantor_cabang_exists($id)
    {
        $model = new KantorCabangModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
