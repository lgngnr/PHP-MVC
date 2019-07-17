<?php

    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function checkUserExistByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            // Check if user exists
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        // Register user
        public function register($data){
            $this->db->query("INSERT INTO users(name, email, password) VALUES(:name, :email, :password )");
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // Login
        public function login($email, $password){
            // Getting user password from db
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(":email", $email);
            $row = $this->db->single();
            $hashed_password = $row->password;

            // Check if password is correct
            if(password_verify($password, $hashed_password)){
                return $row;
            }else{
                return false;
            }

        }
    }
?>