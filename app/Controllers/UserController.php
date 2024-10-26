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


    public function fetchUsers(){
        $loggedInUserId =   session()->get('id'); 
        $users = $this->UserModel->where('role !=', 'superadmin')
        ->where('id !=', $loggedInUserId) 
        ->findAll();
        if (!empty($users)) {   
            $formattedUsers = array_map(function ($user) {
                return [
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                    'status' => $user['status'],
                    'role' => $user['role']
                ];
            }, $users);
    
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $formattedUsers
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No users found.'
            ]);
        }

    }


    public function addUser(){
        $firstName = $this->request->getVar('firstName');
        $lastName = $this->request->getVar('lastName');
        $username = $this->request->getVar('username');
        $role = $this->request->getVar('role');
        $status = $this->request->getVar('status');
        $phone = $this->request->getVar('phone');
        $email = $this->request->getVar('email');
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        $data = [
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
            'role'      => $role,
            'status'    => $status,
            'phone_number'     => $phone,
        ];

        if ($this->UserModel->insert($data)) {
            $data = [
                'status'  => 'success',
                'message' => 'User Created Successfully'
            ];
            
        } else {
            $data = [
                'status'  => 'fail',
                'message' => 'Error in User Creation'
            ];
        }
        return $this->response->setJSON($data);

    }


    public function fileUpload()
    {

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            
            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['status' => 'error', 'message' => 'File upload error.']);
                return;
            }
    
            
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
    
            
            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $uploadDir = ROOTPATH . 'public/uploads/images/';
                $urlPath = 'uploads/images/';
            } else {
                $uploadDir = ROOTPATH . 'public/uploads/documents/';
                $urlPath = 'uploads/documents/';
            }
    
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
                
            $destination = $uploadDir . $fileName;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $data = ['status' => 'success', 'message' => 'File uploaded successfully.', 'path' => base_url($urlPath . $fileName)];                        
            } else {
                $data = ['status' => 'error', 'message' => 'Failed to move uploaded file.'];                
            }

            return $this->response->setJSON($data);        
        } else {
            $data = ['status' => 'error', 'message' => 'No file uploaded.'];  
            return $this->response->setJSON($data);                    
        }

    }

    public function logout()
    {
    
        $session = session();

        $session->destroy();

        return redirect()->to('/login');
    
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
        'type' => $result[0]->role,
        'isLoggedIn' => TRUE,
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

    public function profile()
    {

        $userId = session()->get('id');
        $user = $this->UserModel->find($userId);        
        if ($user) {
            $data = [
                'status' => 'success',
                'user'   => [
                    'first_name'   => $user['first_name'],
                    'last_name'    => $user['last_name'],
                    'username'     => $user['username'],
                    'email'        => $user['email'],
                    'role'         => $user['role'],
                    'profile_picture'=> $user['profile_picture'],
                    'status'       => $user['status'],
                    'phone_number' => $user['phone_number'],
                    'state' => $user['state'],
                    'city' => $user['city'],
                    'pincode' => $user['zip_code'],
                    'address' => $user['address']
                ]
            ];
        } else {
            $data = [
                'status'  => 'fail',
                'message' => 'User not found'
            ];
        }

            return view('profile' , $data);
    }


    public function updateProfile()
    {
        $userId = session()->get('id'); 
        
        if (!$userId) {
            return $this->response->setJSON([
                'status'  => 'fail',
                'message' => 'User ID not found in session'
            ]);
        }
    
        $firstName = $this->request->getVar('firstName');
        $lastName = $this->request->getVar('lastName');
        $address = $this->request->getVar('address');
        $phone = $this->request->getVar('phone');
        $email = $this->request->getVar('email');
        $profile_picture = $this->request->getVar('profile_picture_path');
        $state = $this->request->getVar('state');
        $city = $this->request->getVar('city');
        $pincode = $this->request->getVar('pincode');
    
        $data = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'phone_number' => $phone,
            'state'        => $state,
            'profile_picture'=> $profile_picture,
            'city'         => $city,
            'zip_code'     => $pincode,
            'address'      => $address,
        ];
            
        if ($this->UserModel->where('id', $userId)->set($data)->update()) {
            $response = [
                'status'  => 'success',
                'message' => 'Profile Updated Successfully'
            ];
        } else {
            $response = [
                'status'  => 'fail',
                'message' => 'Error in User Updating'
            ];
        }
    
        return $this->response->setJSON($response);
    }
    
    

}
