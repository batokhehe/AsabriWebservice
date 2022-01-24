<?php

namespace App\Controllers;

use App\Models\UserModel;
use Exception;
use \Firebase\JWT\JWT;

class User extends BaseController
{
    public $modulName = 'User';

    public function index()
    {
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
      
        $data = UserModel::getAll();
      
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => $this->modulName . ' Data ' . count($data) . ' Found',
            'data' => $data,
        ];
        return $this->respond($response);
    }

    public function register()
    {
        $rules = [
            'nama_user' => 'required',
            'user_unique_code' => 'required|is_unique[mst_user.user_unique_code]',
            'kode_user' => 'required|is_unique[mst_user.kode_user]',
            'email' => 'required|valid_email|is_unique[mst_user.email]|min_length[6]',
            'user_password' => 'required',
        ];

        $messages = [
            'nama_user' => [
                'required' => 'Name is required'
            ],
            'user_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'kode_user' => [
                'required' => 'Kode is required'
            ],
            'email' => [
                'required' => 'Email required',
                'valid_email' => 'Email address is not in format'
            ],
            'user_password' => [
                'required' => 'password is required'
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } 

        $userModel = new UserModel();

        $data = [
            'user_id' => $this->getAvailableId($userModel),
            'nama_user' => $this->request->getVar('nama_user'),
            'user_unique_code' => $this->request->getVar('user_unique_code'),
            'kode_user' => $this->request->getVar('kode_user'),
            'email' => $this->request->getVar('email'),
            'user_login' => $this->request->getVar('email'),
            'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Successfully, user has been registered',
            'data' => []
        ];

        return $this->respondCreated($response);
    }

    private function getKey()
    {
        return 'asabri_webservices_123';
    }

    public function login()
    {
        $rules = [
            'user_login' => 'required|valid_email|min_length[6]',
            'user_password' => 'required',
        ];

        $messages = [
            'user_login' => [
                'required' => 'User login required',
                'valid_email' => 'User login is not in format'
            ],
            'user_password' => [
                'required' => 'User password is required'
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];

            return $this->respondCreated($response);
            
        } else {
            $userModel = new UserModel();

            $userdata = $userModel->where('user_login', $this->request->getVar('user_login'))->first();

            if (!empty($userdata)) {

                if (password_verify($this->request->getVar('user_password'), $userdata['user_password'])) {

                    $key = $this->getKey();

                    $iat = time(); // current timestamp value
                    $nbf = $iat + 10;
                    $exp = $iat + 3600 * 100000;

                    $payload = array(
                        'iss' => 'The_claim',
                        'aud' => 'The_Aud',
                        'iat' => $iat, // issued at
                        'nbf' => $nbf, //not before in seconds
                        'exp' => $exp, // expire time in seconds
                        'data' => $userdata,
                    );

                    $token = JWT::encode($payload, $key);

                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'User logged In successfully',
                        'data' => [
                            'token' => $token
                        ]
                    ];
                    return $this->respondCreated($response);
                } else {

                    $response = [
                        'status' => 500,
                        'error' => true,
                        'messages' => 'Incorrect details',
                        'data' => []
                    ];
                    return $this->respondCreated($response);
                }
            } else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'User not found',
                    'data' => []
                ];
                return $this->respondCreated($response);
            }
        }
    }

    public function details()
    {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader('Authorization');
        $authHeader = $authHeader->getValue();
        $token = $authHeader;

        try {
            $decoded = JWT::decode($token, $key, array('HS256'));

            if ($decoded) {

                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => 'User details',
                    'data' => [
                        'profile' => $decoded
                    ]
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
          
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
    }

    public function update($id = null)
    {
        $rules = [
            'nama_user' => 'required',
            'user_unique_code' => 'required|is_unique[mst_user.user_unique_code]',
            'kode_user' => 'required|is_unique[mst_user.kode_user]',
            'email' => 'required|valid_email|is_unique[mst_user.email]|min_length[6]',
            'user_password' => 'required',
        ];

        $messages = [
            'nama_user' => [
                'required' => 'Name is required'
            ],
            'user_unique_code' => [
                'required' => 'Kode Unik is required'
            ],
            'kode_user' => [
                'required' => 'Kode is required'
            ],
            'email' => [
                'required' => 'Email required',
                'valid_email' => 'Email address is not in format'
            ],
            'user_password' => [
                'required' => 'password is required'
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } 

        $userModel = new UserModel();

        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'user_unique_code' => $this->request->getVar('user_unique_code'),
            'kode_user' => $this->request->getVar('kode_user'),
            'email' => $this->request->getVar('email'),
            'user_login' => $this->request->getVar('email'),
            'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
        ];

        $userModel->update($id, $data);

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => 'Successfully, user has been updated',
            'data' => []
        ];

        return $this->respondCreated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new UserModel();
        if (empty($this->user)) {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }

         // check availability
        if ($model->findById($id) === FALSE){
            return $this->respondCreated([
                'status' => 404,
                'error' => true,
                'message' => 'Designated data to delete not found',
                'data' => []
            ]);
        }

        $result = $model->softDelete($id, $model, $this->user);

        if ($result === FALSE) {
            $response = [
                'status' => 500,
                'error' => true,
                'messages' => 'Data Failed to Deleted'
            ];
        } else {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => 'Data Deleted'
            ];
        }
        return $this->respond($response);
    }

    public function getAvailableId($model){
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}