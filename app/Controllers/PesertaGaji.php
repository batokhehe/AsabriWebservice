<?php

namespace App\Controllers;

use App\Models\PesertaGajiDetailModel;
use App\Models\PesertaGajiModel;

class PesertaGaji extends BaseController
{

    public $modulName = 'PesertaGaji';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if (empty($this->user)) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'Access denied',
                'data'     => [],
            ];
            return $this->respondCreated($response);
        }

        $data = PesertaGajiModel::getAll();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['detail'] = PesertaGajiDetailModel::findByHeaderId($data[$i]['peserta_gaji_id']);
        }

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => $this->modulName . ' Data ' . count($data) . ' Found',
            'data'     => $data,
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
        if (empty($this->user)) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'Access denied',
                'data'     => [],
            ];
            return $this->respondCreated($response);
        }

        $result           = PesertaGajiModel::findById($id);
        $result['detail'] = PesertaGajiDetailModel::findByHeaderId($id);

        if ($result) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => $this->modulName . ' Found',
                'data'     => $result,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No ' . $this->modulName . ' Found with id ' . $id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    function new () {
        //
    }

    /**
     * Create a new resource object, from 'posted' parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (empty($this->user)) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'Access denied',
                'data'     => [],
            ];
            return $this->respondCreated($response);
        }

        $model = new PesertaGajiModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            $response = [
                'status'  => 500,
                'error'   => true,
                'message' => $this->validator->getErrors(),
                'data'    => [],
            ];
            return $this->respondCreated($response);
        }

        if ($model->isUniqueCode($model, $this->request->getVar($model->uniqueCode), null) > 0) {
            $response = [
                'status'   => 500,
                'error'    => true,
                'messages' => $this->modulName . ' Kode Unik sudah terpakai',
            ];
        } else {
            if ($model->createNew($model, $this->request, $this->user) === false) {
                $response = [
                    'status'   => 500,
                    'error'    => true,
                    'messages' => $this->modulName . ' Gagal Tersimpan',
                    'params'   => $model->errors(),
                ];
            } else {
                $id          = $model->insertID();
                $modelDetail = new PesertaGajiDetailModel();
                $modelDetail->clearAll($id, $modelDetail);

                for ($i = 0; $i < count($this->request->getVar('detail')); $i++) {
                    if ($modelDetail->createNew($modelDetail, $id, $this->request->getVar('peserta_gaji_unique_code'), $this->request->getVar('detail')[$i], $this->user) === false) {
                        $model->deleteById($id);
                        $modelDetail->clearAll($id, $modelDetail);
                        return $this->respondCreated([
                            'status'   => 500,
                            'error'    => true,
                            'messages' => 'Peserta Gaji Detail Gagal Tersimpan',
                            'params'   => $modelDetail->errors(),
                        ]);
                    }
                }

                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => $this->modulName . ' Berhasil Tersimpan '];
            }
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
        if (empty($this->user)) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'Access denied',
                'data'     => [],
            ];
            return $this->respondCreated($response);
        }

        $model = new PesertaGajiModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {

            $response = [
                'status'  => 500,
                'error'   => true,
                'message' => $this->validator->getErrors(),
                'data'    => [],
            ];
            return $this->respondCreated($response);
        }

        if (!$model->findById($id)) {
            return $this->respondCreated([
                'status'  => 404,
                'error'   => true,
                'message' => 'Designated data to update not found',
                'data'    => [],
            ]);
        }
        if ($model->isUniqueCode($model, $this->request->getVar($model->uniqueCode), $id) > 0) {
            $response = [
                'status'   => 500,
                'error'    => true,
                'messages' => $this->modulName . ' Kode Unik sudah terpakai',
            ];
        } else {
            if ($model->updateData($id, $model, $this->request, $this->user) === false) {
                $response = [
                    'status'   => 500,
                    'error'    => true,
                    'messages' => $this->modulName . ' Gagal Tersimpan',
                    'params'   => $model->errors(),
                ];
            } else {
                $modelDetail = new PesertaGajiDetailModel();
                $modelDetail->clearAll($id, $modelDetail);

                for ($i = 0; $i < count($this->request->getVar('detail')); $i++) {
                    if ($modelDetail->createNew($modelDetail, $id, $this->request->getVar('peserta_gaji_unique_code'), $this->request->getVar('detail')[$i], $this->user) === false) {
                        $modelDetail->clearAll($id, $modelDetail);
                        return $this->respondCreated([
                            'status'   => 500,
                            'error'    => true,
                            'messages' => 'Peserta Gaji Detail Gagal Tersimpan',
                            'params'   => $modelDetail->errors(),
                        ]);
                    }
                }

                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => $this->modulName . ' Berhasil Tersimpan '];
            }
        }

        return $this->respondCreated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new PesertaGajiModel();
        if (empty($this->user)) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'Access denied',
                'data'     => [],
            ];
            return $this->respondCreated($response);
        }

        // check availability
        if ($model->findById($id) === false) {
            return $this->respondCreated([
                'status'  => 404,
                'error'   => true,
                'message' => 'Designated data to delete not found',
                'data'    => [],
            ]);
        }

        $result = $model->softDelete($id, $model, $this->user);

        if ($result === false) {
            $response = [
                'status'   => 500,
                'error'    => true,
                'messages' => 'Data Failed to Deleted',
            ];
        } else {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => 'Data Deleted',
            ];
        }
        return $this->respond($response);
    }
}
