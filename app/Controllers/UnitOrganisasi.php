<?php

namespace App\Controllers;
use App\Models\UnitOrganisasiModel;

class UnitOrganisasi extends BaseController
{

    public $modulName = 'UnitOrganisasi';

   /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $model = new UnitOrganisasiModel();
      
        $data = $model->where(['deleted_status' => 0])->findAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => $this->modulName . ' Data ' . count($data) . ' Found',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $model = new UnitOrganisasiModel();
      
        $data = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->first();
      
        if ($data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => $this->modulName . ' Found',
                'data' => $data,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No ' . $this->modulName . ' Found with id ' . $id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from 'posted' parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $model = new UnitOrganisasiModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $data = [
            'unit_organisasi_unique_code' =>  $this->request->getVar('unit_organisasi_unique_code'), 
            'nama_unit_organisasi' =>  $this->request->getVar('nama_unit_organisasi'), 
            'kode_unit_organisasi' =>  $this->request->getVar('kode_unit_organisasi'), 
            'keterangan' =>  $this->request->getVar('keterangan'), 
            'status' =>  $this->request->getVar('status'),
            'unit_organisasi_induk_id' =>  $this->request->getVar('unit_organisasi_induk_id'), 

            'provinsi_id' =>  $this->request->getVar('provinsi_id'), 
            'kota_id' =>  $this->request->getVar('kota_id'), 
            'kecamatan_id' =>  $this->request->getVar('kecamatan_id'), 
            'kelurahan_id' =>  $this->request->getVar('kelurahan_id'), 
            'alamat' =>  $this->request->getVar('alamat'),
            'postal_code' =>  $this->request->getVar('postal_code'), 
            'telephone' =>  $this->request->getVar('telephone'), 
            'faximile' =>  $this->request->getVar('faximile'), 
            'unit_organisasi_short_name' =>  $this->request->getVar('unit_organisasi_short_name'), 
            'sp_id' =>  $this->request->getVar('sp_id'), 
            'list_akt_id' =>  $this->request->getVar('list_akt_id'),

            'created_by' => $this->user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ];

        if ($error = $model->insert($data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => $this->modulName . ' Berhasil Tersimpan' ];
        } else {
             $response = [
                'status' => 500,
                'error' => true,
                'messages' => $this->modulName . ' Gagal Tersimpan = ' . $error ];
        }
      
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from 'posted' properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $model = new UnitOrganisasiModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $data = [
            'unit_organisasi_unique_code' =>  $this->request->getVar('unit_organisasi_unique_code'), 
            'nama_unit_organisasi' =>  $this->request->getVar('nama_unit_organisasi'), 
            'kode_unit_organisasi' =>  $this->request->getVar('kode_unit_organisasi'), 
            'keterangan' =>  $this->request->getVar('keterangan'), 
            'status' =>  $this->request->getVar('status'),
            'unit_organisasi_induk_id' =>  $this->request->getVar('unit_organisasi_induk_id'), 

            'provinsi_id' =>  $this->request->getVar('provinsi_id'), 
            'kota_id' =>  $this->request->getVar('kota_id'), 
            'kecamatan_id' =>  $this->request->getVar('kecamatan_id'), 
            'kelurahan_id' =>  $this->request->getVar('kelurahan_id'), 
            'alamat' =>  $this->request->getVar('alamat'),
            'postal_code' =>  $this->request->getVar('postal_code'), 
            'telephone' =>  $this->request->getVar('telephone'), 
            'faximile' =>  $this->request->getVar('faximile'), 
            'unit_organisasi_short_name' =>  $this->request->getVar('unit_organisasi_short_name'), 
            'sp_id' =>  $this->request->getVar('sp_id'), 
            'list_akt_id' =>  $this->request->getVar('list_akt_id'),
            
            'last_update_by' => $this->user->data->email, 
            'last_update_date' => date('Y-m-d H:i:s'),
        ];

        if ($error = $model->update($id, $data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Data Updated'
            ];
        } else {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'Data Failed to Updated'
            ];
        }

       
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

        $model = new UnitOrganisasiModel();

        $data = $model->find($id);

        if ($data) {

            // $model->delete($id);

            $data = [
                'deleted_status' => 1, 
                'deleted_by' => $this->user->data->email, 
                'deleted_date' => date('Y-m-d H:i:s'),
            ];

        $model->update($id, $data);

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Data Deleted',
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
