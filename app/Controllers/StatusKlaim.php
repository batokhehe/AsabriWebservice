<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StatusKlaimModel;

class StatusKlaim extends BaseController
{
    public $modulName = 'Status Klaim';

    public function index()
    {
        if (empty($this->user)){
            return $this->respondCreated([
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ]);
        }

        $data = StatusKlaimModel::getAll();

        return $this->respond([
            'status' => 200,
            'error' => false,
            'messages' => $this->modulName.'  Data '.count($data). ' Found',
            '$data' => $data
        ]);
    }

    public function show($id = null){
        if (empty($this->user)){
            return $this->respondCreated([
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ]);
        }

        $data = StatusKlaimModel::findById($id);
        if (!$data){
            return $this->failNotFound('No ' . $this->modulName . ' Found with id ' . $id);
        }
        return $this->respond([
            'status' => 200,
            'error' => null,
            'messages' => $this->modulName . ' Found',
            'data' => $data,
        ]); 
    }

    public function create(){
        if (empty($this->user)){
            return $this->respondCreated([
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ]);
        }

        $rules = [
            'nama_status_klaim' => 'required', 
            'kode_status_klaim' => 'required',
            'status_klaim_unique_code' => 'required|is_unique[ref_status_klaim.status_klaim_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_status_klaim' => [
                'required' => 'Nama Status Klaim is required'
            ],
            'kode_status_klaim' => [
                'required' => 'Kode Status Klaim is required',
            ],
            'status_klaim_unique_code' => [
                'required' => 'Kode Unik Status Klaim is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Status Klaim is required'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ]);
        }

        $jenisKlaim = StatusKlaimModel::createNew($this->request, $this->user);
        if (!$jenisKlaim){
            return $this->respondCreated([
                    'status' => 500,
                    'error' => true,
                    'messages' => $this->modulName . ' Gagal Tersimpan = ' . $jenisKlaim 
                ]);
        }
        
        return $this->respondCreated([
            'status' => 200,
            'error' => null,
            'messages' => $this->modulName . ' Berhasil Tersimpan' 
        ]);
    }

    public function update($id = null){
        if (empty($this->user)){
            return $this->respondCreated([
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ]);
        }

        $rules = [
            'nama_status_klaim' => 'required', 
            'kode_status_klaim' => 'required',
            'status_klaim_unique_code' => 'required|is_unique[ref_status_klaim.status_klaim_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_status_klaim' => [
                'required' => 'Nama Status Klaim is required'
            ],
            'kode_status_klaim' => [
                'required' => 'Kode Status Klaim is required',
            ],
            'status_klaim_unique_code' => [
                'required' => 'Kode Unik Status Klaim is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Status Klaim is required'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ]);
        }
        
        // check availability
        if (!StatusKlaimModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        StatusKlaimModel::updateData($id, $this->request, $this->user);

        return $this->respondCreated($response = [
            'status' => 200,
            'error' => null,
            'messages' => 'Data Updated'
        ]);
    }

    public function delete($id = null){
        if (empty($this->user)){
            return $this->respondCreated([
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ]);
        }

        // check availability
        if (!StatusKlaimModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        StatusKlaimModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}