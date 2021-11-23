<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StatusPesertaModel;

class StatusPeserta extends BaseController
{
    public $modulName = 'Status Peserta';

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

        $data = StatusPesertaModel::getAll();

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

        $data = StatusPesertaModel::findById($id);
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
            'nama_status_peserta' => 'required', 
            'kode_status_peserta' => 'required',
            'status_peserta_unique_code' => 'required|is_unique[ref_status_peserta.status_peserta_unique_code]',
            'keterangan' => 'required',
        ];

        $messages = [
            'nama_status_peserta' => [
                'required' => 'Nama Status Peserta is required'
            ],
            'kode_status_peserta' => [
                'required' => 'Kode Status Peserta is required',
            ],
            'status_peserta_unique_code' => [
                'required' => 'Kode Unik Status Peserta is required'
            ],
            'keterangan' => [
                'required' => 'Keterangan Status Peserta is required'
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

        $jenisPeserta = StatusPesertaModel::createNew($this->request, $this->user);
        if (!$jenisPeserta){
            return $this->respondCreated([
                    'status' => 500,
                    'error' => true,
                    'messages' => $this->modulName . ' Gagal Tersimpan = ' . $jenisPeserta 
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
            'nama_status_peserta' => 'required', 
            'kode_status_peserta' => 'required',
            'status_peserta_unique_code' => 'required|is_unique[ref_status_peserta.status_peserta_unique_code]',
            'keterangan' => 'required',
        ];

        $messages = [
            'nama_status_peserta' => [
                'required' => 'Nama Status Peserta is required'
            ],
            'kode_status_peserta' => [
                'required' => 'Kode Status Peserta is required',
            ],
            'status_peserta_unique_code' => [
                'required' => 'Kode Unik Status Peserta is required'
            ],
            'keterangan' => [
                'required' => 'Keterangan Status Peserta is required'
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
        if (!StatusPesertaModel::findById($id)){
            return $this->respondCreated([
                'status' => 400,
                'error' => true,
                'message' => 'Designated data to update not found',
                'data' => []
            ]);
        }

        // do update
        StatusPesertaModel::updateData($id, $this->request, $this->user);

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
        if (!StatusPesertaModel::findById($id)){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        StatusPesertaModel::softDelete($id, $this->user);

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => 'Data Deleted',
        ]);
    }
}