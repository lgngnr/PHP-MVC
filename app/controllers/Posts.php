<?php
    class Posts extends Controller{

        public function __construct(){
            $this->userModel = $this->model('Post');
        }

        public function index(){
            $data = [];
            $this->view('posts/index');
        }
    }
?>