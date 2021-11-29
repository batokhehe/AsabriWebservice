<?php

namespace App\Controllers;
use App\Models\KelurahanModel;

class Kelurahan extends BaseController
{

    public $modulName = 'Kelurahan';

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

        $model = new KelurahanModel();
      
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

        $model = new KelurahanModel();
      
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

        $model = new KelurahanModel();

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
            'kelurahan_unique_code' =>  $this->request->getVar('kelurahan_unique_code'), 
            'nama_kelurahan' =>  $this->request->getVar('nama_kelurahan'), 
            'kode_kelurahan' =>  $this->request->getVar('kode_kelurahan'), 
            'deskripsi' =>  $this->request->getVar('deskripsi'), 
            'kecamatan_id' =>  $this->request->getVar('kecamatan_id'),
            'other_kode_kelurahan' =>  $this->request->getVar('other_kode_kelurahan'), 
            'created_by' => $this->user->data->email, 
            'created_date' => date('Y-m-d H:i:s'),
            'deleted_status' =>  0, 
        ];

        if ($error = $model->insert($data) === FALSE) {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => $this->modulName . ' Gagal Tersimpan = ' . $error ];
        } else {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => $this->modulName . ' Berhasil Tersimpan' ];  
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

        $model = new KelurahanModel();

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
            'kelurahan_unique_code' =>  $this->request->getVar('kelurahan_unique_code'), 
            'nama_kelurahan' =>  $this->request->getVar('nama_kelurahan'), 
            'kode_kelurahan' =>  $this->request->getVar('kode_kelurahan'), 
            'deskripsi' =>  $this->request->getVar('deskripsi'), 
            'kecamatan_id' =>  $this->request->getVar('kecamatan_id'),
            'other_kode_kelurahan' =>  $this->request->getVar('other_kode_kelurahan'), 
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

        $model = new KelurahanModel();

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
