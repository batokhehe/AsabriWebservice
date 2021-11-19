<?php

namespace App\Controllers;
use App\Models\ProdukModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;

class Produk extends ResourceController
{
   /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new ProdukModel();
      
        $data = $model->findAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => 'Members Found',
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
        $model = new ProdukModel();
      
        $data = $model->where(['prd_id' => $id])->first();
      
        if ($data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Member Found',
                'data' => $data,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No Member Found with id ' . $id);
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
        $model = new ProdukModel();
        $key = $this->getKey();
        $token = $this->request->getHeader('Authorization')->getValue();
        $decoded = JWT::decode($token, $key, array('HS256'));

        $rules = [
            'prd_name' => 'required',
            'prd_descre' => 'required',
            'prd_start_date' => 'required',  
        ];

        $messages = [
            'prd_name' => [
                'required' => 'Nama Produk is required'
            ],
            'prd_descre' => [
                'required' => 'Deskripsi Produk is required',
            ],
            'prd_start_date' => [
                'required' => 'Start Date is required'
            ],
        ];

        $data = [
            'prd_name' => $this->request->getVar('prd_name'),
            'prd_descre' => $this->request->getVar('prd_descre'),
            'prd_start_date' => $this->request->getVar('prd_start_date'),
            'prd_is_deleted' => 0,
            'prd_usrnam' => $decoded->data->email,
            'prd_usrdat' => date('Y-m-d H:i:s'),
        ];

        if ($model->insert($data)) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Produk Berhasil Tersimpan' ];
        } else {
             $response = [
                'status' => 500,
                'error' => null,
                'messages' => 'Produk Gagal Tersimpan' ];
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
        $model = new ProdukModel();

        $data = [
            'prd_id' => $this->request->getVar('prd_id'),
            'prd_name' => $this->request->getVar('prd_name'),
            'prd_descre' => $this->request->getVar('prd_descre'),
            'prd_start_date' => $this->request->getVar('prd_start_date'),
            'prd_is_deleted' => $this->request->getVar('prd_is_deleted'),
            'prd_usrnam' => $this->request->getVar('prd_usrnam'),
            'prd_usrdat' => $this->request->getVar('prd_usrdat'),
            'prd_updnam' => $this->request->getVar('prd_updnam'),
            'prd_upddat' => $this->request->getVar('prd_upddat')
        ];

        $model->update($id, $data);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => 'Data Updated'
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProdukModel();

        $data = $model->find($id);

        if ($data) {

            $model->delete($id);

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

    private function getKey()
    {
        return 'my_application_secret';
    }
}
