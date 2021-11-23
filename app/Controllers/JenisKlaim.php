<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisKlaimModel;

class JenisKlaim extends BaseController
{

    public $modulName = 'Jenis Klaim';

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

        $data = JenisKlaimModel::getAll();

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

        $data = JenisKlaimModel::findById($id);
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
            'nama_jenis_klaim' => 'required', 
            'kode_jenis_klaim' => 'required',
            'jenis_klaim_unique_code' => 'required|is_unique[ref_jenis_klaim.jenis_klaim_unique_code]',
            'deskripsi' => 'required',
            'kode_pembayaran' => 'required',
            'is_provider' => 'required',
            'is_peserta' => 'required'
        ];

        $messages = [
            'nama_jenis_klaim' => [
                'required' => 'Nama Jenis Klaim is required'
            ],
            'kode_jenis_klaim' => [
                'required' => 'Kode Jenis Klaim is required',
            ],
            'jenis_klaim_unique_code' => [
                'required' => 'Kode Unik Jenis Klaim is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Klaim is required'
            ],
            'kode_pemnbayaran' => [
                'required' => 'Kode Pembayaran Jenis Klaim is required'
            ],
            'is_provider' => [
                'required' => 'Is Provider Jenis Klaim is required'
            ],
            'is_peserta' => [
                'required' => 'Is Peserta Jenis Klaim is required'
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ]);
        }

        $jenisKlaim = JenisKlaimModel::createNew($this->request, $this->user);
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
            'nama_jenis_klaim' => 'required', 
            'kode_jenis_klaim' => 'required',
            'jenis_klaim_unique_code' => 'required|is_unique[ref_jenis_klaim.jenis_klaim_unique_code]',
            'deskripsi' => 'required',
            'kode_pembayaran' => 'required',
            'is_provider' => 'required',
            'is_peserta' => 'required'
        ];

        $messages = [
            'nama_jenis_klaim' => [
                'required' => 'Nama Jenis Klaim is required'
            ],
            'kode_jenis_klaim' => [
                'required' => 'Kode Jenis Klaim is required',
            ],
            'jenis_klaim_unique_code' => [
                'required' => 'Kode Unik Jenis Klaim is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Jenis Klaim is required'
            ],
            'kode_pemnbayaran' => [
                'required' => 'Kode Pembayaran Jenis Klaim is required'
            ],
            'is_provider' => [
                'required' => 'Is Provider Jenis Klaim is required'
            ],
            'is_peserta' => [
                'required' => 'Is Peserta Jenis Klaim is required'
            ],
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
        if (!JenisKlaimModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        JenisKlaimModel::updateData($id, $this->request, $this->user);

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
        if (!JenisKlaimModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        JenisKlaimModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
