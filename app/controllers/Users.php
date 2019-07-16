<?php

    class Users extends Controller{

        public function __construct(){

        }

        public function register(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

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