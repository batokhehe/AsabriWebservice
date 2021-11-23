<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisHutangModel;

class JenisHutang extends BaseController
{
    public $modulName = 'Jenis Hutang';

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

        $data = JenisHutangModel::getAll();

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

        $data = JenisHutangModel::findById($id);
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
            'nama_jenis_hutang' => 'required', 
            'kode_jenis_hutang' => 'required',
            'jenis_hutang_unique_code' => 'required|is_unique[ref_jenis_hutang.jenis_hutang_unique_code]',
            'is_mitra' => 'required',
            'is_product' => 'required',
            'is_retur' => 'required',
            'deskripsi' => 'required',
            'is_potongan_pesiun' => 'required',
            'sort_number' => 'required',
            'is_potongan_santunan' => 'required',
            'dps_status' => 'required'
        ];

        $messages = [
            'nama_jenis_hutang' => [
                'required' => 'Nama Jenis Hutang is required'
            ],
            'kode_jenis_hutang' => [
                'required' => 'Kode Jenis Hutang is required',
            ],
            'jenis_hutang_unique_code' => [
                'required' => 'Kode Unik Jenis Hutang is required'
            ],
            'is_mitra' => [
                'required' => 'Is Mitra Jenis Hutang is required'
            ],
            'is_product' => [
                'required' => 'Is Product Jenis Hutang is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Hutang is required'
            ],
            'is_potongan_pensiun' => [
                'required' => 'Is Potongan Pensiun Jenis Hutang is required'
            ],
            'sort_number' => [
                'required' => 'Sort Number Jenis Hutang is required'
            ],
            'is_potongan_santunan' => [
                'required' => 'Is Potongan Santunan Jenis Hutang is required'
            ],
            'dps_status' => [
                'required' => 'DPS Status Jenis Hutang is required'
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

        $jenisKlaim = JenisHutangModel::createNew($this->request, $this->user);
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
            'nama_jenis_hutang' => 'required', 
            'kode_jenis_hutang' => 'required',
            'jenis_hutang_unique_code' => 'required|is_unique[ref_jenis_hutang.jenis_hutang_unique_code]',
            'is_mitra' => 'required',
            'is_product' => 'required',
            'is_retur' => 'required',
            'deskripsi' => 'required',
            'is_potongan_pesiun' => 'required',
            'sort_number' => 'required',
            'is_potongan_santunan' => 'required',
            'dps_status' => 'required'
        ];

        $messages = [
            'nama_jenis_hutang' => [
                'required' => 'Nama Jenis Hutang is required'
            ],
            'kode_jenis_hutang' => [
                'required' => 'Kode Jenis Hutang is required',
            ],
            'jenis_hutang_unique_code' => [
                'required' => 'Kode Unik Jenis Hutang is required'
            ],
            'is_mitra' => [
                'required' => 'Is Mitra Jenis Hutang is required'
            ],
            'is_product' => [
                'required' => 'Is Product Jenis Hutang is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Hutang is required'
            ],
            'is_potongan_pensiun' => [
                'required' => 'Is Potongan Pensiun Jenis Hutang is required'
            ],
            'sort_number' => [
                'required' => 'Sort Number Jenis Hutang is required'
            ],
            'is_potongan_santunan' => [
                'required' => 'Is Potongan Santunan Jenis Hutang is required'
            ],
            'dps_status' => [
                'required' => 'DPS Status Jenis Hutang is required'
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
        if (!JenisHutangModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        JenisHutangModel::updateData($id, $this->request, $this->user);

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
        if (!JenisHutangModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        JenisHutangModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
