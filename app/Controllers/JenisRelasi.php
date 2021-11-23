<?php

namespace App\Controllers;
use App\Models\JenisRelasiModel;

class JenisRelasi extends BaseController
{

    public $modulName = 'JenisRelasi';

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

        $model = new JenisRelasiModel();
      
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

        $model = new JenisRelasiModel();
      
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

        $model = new JenisRelasiModel();

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
            'jenis_relasi_unique_code' =>  $this->request->getVar('jenis_relasi_unique_code'), 
            'nama_jenis_relasi' =>  $this->request->getVar('nama_jenis_relasi'), 
            'kode_jenis_relasi' =>  $this->request->getVar('kode_jenis_relasi'), 
            'kode_jiwa' =>  $this->request->getVar('kode_jiwa'), 
            'deskripsi' =>  $this->request->getVar('deskripsi'), 
            'STATUS' =>  $this->request->getVar('STATUS'),  
            
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

        $model = new JenisRelasiModel();

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
            'jenis_relasi_unique_code' =>  $this->request->getVar('jenis_relasi_unique_code'), 
            'nama_jenis_relasi' =>  $this->request->getVar('nama_jenis_relasi'), 
            'kode_jenis_relasi' =>  $this->request->getVar('kode_jenis_relasi'), 
            'kode_jiwa' =>  $this->request->getVar('kode_jiwa'), 
            'deskripsi' =>  $this->request->getVar('deskripsi'), 
            'STATUS' =>  $this->request->getVar('STATUS'),  
            
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

        $model = new JenisRelasiModel();

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
