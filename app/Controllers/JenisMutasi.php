<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisMutasiModel;

class JenisMutasi extends BaseController
{
    public $modulName = 'Jenis Mutasi';

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

        $data = JenisMutasiModel::getAll();

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

        $data = JenisMutasiModel::findById($id);
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
            'nama_jenis_mutasi' => 'required', 
            'kode_jenis_mutasi' => 'required',
            'jenis_mutasi_unique_code' => 'required|is_unique[ref_jenis_mutasi.jenis_mutasi_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_jenis_mutasi' => [
                'required' => 'Nama Jenis Mutasi is required'
            ],
            'kode_jenis_mutasi' => [
                'required' => 'Kode Jenis Mutasi is required',
            ],
            'jenis_mutasi_unique_code' => [
                'required' => 'Kode Unik Jenis Mutasi is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Mutasi is required'
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

        $jenisKlaim = JenisMutasiModel::createNew($this->request, $this->user);
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
            'nama_jenis_mutasi' => 'required', 
            'kode_jenis_mutasi' => 'required',
            'jenis_mutasi_unique_code' => 'required|is_unique[ref_jenis_mutasi.jenis_mutasi_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_jenis_mutasi' => [
                'required' => 'Nama Jenis Mutasi is required'
            ],
            'kode_jenis_mutasi' => [
                'required' => 'Kode Jenis Mutasi is required',
            ],
            'jenis_mutasi_unique_code' => [
                'required' => 'Kode Unik Jenis Mutasi is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Mutasi is required'
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
        if (!JenisMutasiModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        JenisMutasiModel::updateData($id, $this->request, $this->user);

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
        if (!JenisMutasiModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        JenisMutasiModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
