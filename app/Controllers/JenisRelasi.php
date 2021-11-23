<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisRelasiModel;

class JenisRelasi extends BaseController
{
    public $modulName = 'Jenis Relasi';

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

        $data = JenisRelasiModel::getAll();

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

        $data = JenisRelasiModel::findById($id);
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
            'nama_jenis_relasi' => 'required', 
            'kode_jenis_relasi' => 'required',
            'jenis_relasi_unique_code' => 'required|is_unique[ref_jenis_relasi.jenis_relasi_unique_code]',
            'kode_jiwa' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'nama_jenis_relasi' => [
                'required' => 'Nama Jenis Relasi is required'
            ],
            'kode_jenis_relasi' => [
                'required' => 'Kode Jenis Relasi is required',
            ],
            'jenis_relasi_unique_code' => [
                'required' => 'Kode Unik Jenis Relasi is required'
            ],
            'kode_jiwa' => [
                'required' => 'Kode Jiwa Jenis Relasi is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Relasi is required'
            ],
            'status' => [
                'required' => 'Status Jenis Relasi is required'
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

        $jenisKlaim = JenisRelasiModel::createNew($this->request, $this->user);
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
            'nama_jenis_relasi' => 'required', 
            'kode_jenis_relasi' => 'required',
            'jenis_relasi_unique_code' => 'required|is_unique[ref_jenis_relasi.jenis_relasi_unique_code]',
            'kode_jiwa' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'nama_jenis_relasi' => [
                'required' => 'Nama Jenis Relasi is required'
            ],
            'kode_jenis_relasi' => [
                'required' => 'Kode Jenis Relasi is required',
            ],
            'jenis_relasi_unique_code' => [
                'required' => 'Kode Unik Jenis Relasi is required'
            ],
            'kode_jiwa' => [
                'required' => 'Kode Jiwa Jenis Relasi is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Relasi is required'
            ],
            'status' => [
                'required' => 'Status Jenis Relasi is required'
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
        if (!JenisRelasiModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        JenisRelasiModel::updateData($id, $this->request, $this->user);

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
        if (!JenisRelasiModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        JenisRelasiModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
