<?php
    class Posts extends Controller{

        public function __construct(){
            // If not logged redirect to login
            if(!isset($_SESSION['user_id'])){
                header("location: " . URLROOT . "/users/login");
            }
            
            $this->userModel = $this->model('Post');
        }

        public function index(){
            $data = [];
            $this->view('posts/index');
        }
    }
?>