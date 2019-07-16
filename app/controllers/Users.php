<?php

    class Users extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                //Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'c_password' => trim($_POST['c_password']),
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'c_password_error' => '',
                ];

                // Validate name
                if(empty($data['name'])){
                    $data['name_error'] = 'Please enter name';
                }

                // Validate email
                if(empty($data['email'])){
                    $data['email_error'] = 'Please enter email';
                }else{
                    // Check if email already exists
                    if($this->userModel->checkUserExistByEmail($data['email'])){
                        $data['email_error'] = 'Email is already taken';
                    }
                }

                // Validate password
                if(empty($data['password'])){
                    $data['password_error'] = 'Please enter password';
                }else if(strlen($data['password']) < 6){
                    $data['password_error'] = 'Password must be at least 6 characters';
                }

                // Validate confirm password
                if(empty($data['c_password'])){
                    $data['c_password_error'] = 'Please confirm your password';
                }else{
                    if($data['password'] != $data['c_password']){
                        $data['c_password_error'] = 'Password does not match';
                    }
                }

                // Make sure errors are empty
                if( empty($data['name_error']) && empty($data['email_error'])
                    && empty($data['password_error']) && empty($data['c_password_error'])){
                        // valid
                        die('success'); 
                }else{
                    // Load view wiith errors
                    $this->view('users/register', $data);
                }

            }else{
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'c_password' => '',
                    'name_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'c_password_error' => '',
                ];

                // Load the view
                $this->view('users/register', $data);

            }
        }

        public function login(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                //Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => '',
                ];

                // Validate email
                if(empty($data['email'])){
                    $data['email_error'] = 'Please enter email';
                }

                // Validate password
                if(empty($data['password'])){
                    $data['password_error'] = 'Please enter password';
                }

                // Make sure errors are empty
                if( empty($data['email_error'])&& empty($data['password_error'])){
                        // valid
                        die('success'); 
                }else{
                    // Load view wiith errors
                    $this->view('users/login', $data);
                }

            }else{
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => '',
                ];

                // Load the view
                $this->view('users/login', $data);

            }
        }

    }
?>