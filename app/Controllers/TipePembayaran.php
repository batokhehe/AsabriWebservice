<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TipePembayaranModel;

class TipePembayaran extends BaseController
{
    public $modulName = 'Tipe Pembayaran';

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

        $data = TipePembayaranModel::getAll();

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

        $data = TipePembayaranModel::findById($id);
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
            'nama_tipe_pembayaran' => 'required', 
            'kode_tipe_pembayaran' => 'required',
            'tipe_pembayaran_unique_code' => 'required|is_unique[ref_tipe_pembayaran.tipe_pembayaran_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_tipe_pembayaran' => [
                'required' => 'Nama Tipe Pembayaran is required'
            ],
            'kode_tipe_pembayaran' => [
                'required' => 'Kode Tipe Pembayaran is required',
            ],
            'tipe_pembayaran_unique_code' => [
                'required' => 'Kode Unik Tipe Pembayaran is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Tipe Pembayaran is required'
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

        $jenisKlaim = TipePembayaranModel::createNew($this->request, $this->user);
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
            'nama_tipe_pembayaran' => 'required', 
            'kode_tipe_pembayaran' => 'required',
            'tipe_pembayaran_unique_code' => 'required|is_unique[ref_tipe_pembayaran.tipe_pembayaran_unique_code]',
            'deskripsi' => 'required',
        ];

        $messages = [
            'nama_tipe_pembayaran' => [
                'required' => 'Nama Tipe Pembayaran is required'
            ],
            'kode_tipe_pembayaran' => [
                'required' => 'Kode Tipe Pembayaran is required',
            ],
            'tipe_pembayaran_unique_code' => [
                'required' => 'Kode Unik Tipe Pembayaran is required'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi Tipe Pembayaran is required'
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
        if (!TipePembayaranModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        TipePembayaranModel::updateData($id, $this->request, $this->user);

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
        if (!TipePembayaranModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        TipePembayaranModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}
