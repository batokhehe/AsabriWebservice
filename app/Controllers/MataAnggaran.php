<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MataAnggaranModel;

class MataAnggaran extends BaseController
{
    public $modulName = 'Mata Anggaran';

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

        $data = MataAnggaranModel::getAll();

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

        $result = MataAnggaranModel::findById($id);

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

        $model = new MataAnggaranModel();

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

        $model = new MataAnggaranModel();

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
        $model = new MataAnggaranModel();
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
