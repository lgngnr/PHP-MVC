<?php
    class Posts extends Controller{

        public function __construct(){
            // If not logged redirect to login
            if(!isLoggedIn()){
                header("location: " . URLROOT . "/users/login");
            }

            $this->postModel = $this->model('Post');
        }

        public function index(){
            // GET Posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts'=> $posts
            ];
            $this->view('posts/index', $data);
        }
    }
?>