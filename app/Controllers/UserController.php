<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    public function __construct(){
        $this->UserModel = new UserModel();
        $this->session = session();
    }

    public function loginValidate()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $rememberMe = $this->request->getPost('rememberMe');

        $result = $this->UserModel->where(['email'=>$email])->get()->getResult();        
        if(count($result)==0){
            $data = [
                'status'=>'error_email',
                'message'=>'No User found with the email address'
            ];
            return $this->response->setJSON($data);
        }else{                        
            if (!password_verify($password, $result[0]->password)) {
                $data = [
                    'status'  => 'error_password',
                    'message' => 'Invalid password',
                ];
                return $this->response->setJSON($data);
            }
                    
            $data = [
                'status'  => 'success',
                'message' => 'Login successful',
                'user'    => [
                    'id'       => $result[0]->id,
                    'username' => $result[0]->username,
                    'email'    => $result[0]->email,
                    'role'     => $result[0]->role,
                ],
            ];

                // Set user session data
    $sessionData = [
        'id' => $result[0]->id,
        'email' => $result[0]->email,
        'username' => $result[0]->username,
        'logged_in' => TRUE,
    ];
    
    // Save to session
    $this->session->set($sessionData);

    if ($rememberMe) {
        // Set a cookie with user email or ID
        $this->response->setCookie('rememberMe', $email, time() + 86400 * 30); // 30 days
    } else {
        // If not remembering, delete any existing cookie
        $this->response->deleteCookie('rememberMe');
    }

            return $this->response->setJSON($data);
        }
    }
}
