<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MataAnggaranModel;

class MataAnggaran extends BaseController
{
    public $modulName = 'Mata Anggaran';

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

        $data = MataAnggaranModel::getAll();

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

        $data = MataAnggaranModel::findById($id);
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
            'nama_mata_anggaran' => 'required', 
            'kode_mata_anggaran' => 'required',
            'mata_anggaran_unique_code' => 'required|is_unique[ref_mata_anggaran.mata_anggaran_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_mata_anggaran' => [
                'required' => 'Nama Mata Anggaran is required'
            ],
            'kode_mata_anggaran' => [
                'required' => 'Kode Mata Anggaran is required',
            ],
            'mata_anggaran_unique_code' => [
                'required' => 'Kode Unik Mata Anggaran is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Mata Anggaran is required'
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

        $jenisKlaim = MataAnggaranModel::createNew($this->request, $this->user);
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
            'nama_mata_anggaran' => 'required', 
            'kode_mata_anggaran' => 'required',
            'mata_anggaran_unique_code' => 'required|is_unique[ref_mata_anggaran.mata_anggaran_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_mata_anggaran' => [
                'required' => 'Nama Mata Anggaran is required'
            ],
            'kode_mata_anggaran' => [
                'required' => 'Kode Mata Anggaran is required',
            ],
            'mata_anggaran_unique_code' => [
                'required' => 'Kode Unik Mata Anggaran is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Mata Anggaran is required'
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
        if (!MataAnggaranModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        MataAnggaranModel::updateData($id, $this->request, $this->user);

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
        if (!MataAnggaranModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        MataAnggaranModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
