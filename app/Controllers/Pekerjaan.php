<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PekerjaanModel;

class Pekerjaan extends BaseController
{
    public $modulName = 'Pekerjaan';

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

        $data = PekerjaanModel::getAll();

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

        $data = PekerjaanModel::findById($id);
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
            'nama_pekerjaan' => 'required', 
            'kode_pekerjaan' => 'required',
            'pekerjaan_unique_code' => 'required|is_unique[ref_pekerjaan.pekerjaan_unique_code]',
            'deskripsi' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'nama_pekerjaan' => [
                'required' => 'Nama Pekerjaan is required'
            ],
            'kode_pekerjaan' => [
                'required' => 'Kode Pekerjaan is required',
            ],
            'pekerjaan_unique_code' => [
                'required' => 'Kode Unik Pekerjaan is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Pekerjaan is required'
            ],
            'status' => [
                'required' => 'Status Pekerjaan is required'
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

        $jenisKlaim = PekerjaanModel::createNew($this->request, $this->user);
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
            'nama_pekerjaan' => 'required', 
            'kode_pekerjaan' => 'required',
            'pekerjaan_unique_code' => 'required|is_unique[ref_pekerjaan.pekerjaan_unique_code]',
            'deskripsi' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'nama_pekerjaan' => [
                'required' => 'Nama Pekerjaan is required'
            ],
            'kode_pekerjaan' => [
                'required' => 'Kode Pekerjaan is required',
            ],
            'pekerjaan_unique_code' => [
                'required' => 'Kode Unik Pekerjaan is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Pekerjaan is required'
            ],
            'status' => [
                'required' => 'Status Pekerjaan is required'
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
        if (!PekerjaanModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        PekerjaanModel::updateData($id, $this->request, $this->user);

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
        if (!PekerjaanModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        PekerjaanModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
