<?php

    class Pages extends Controller{

        public function __construct(){
            $this->postModel = $this->model('Post');
        }

        public function index(){
            $posts = $this->postModel->getPosts();
            $data = [
                'title'=>'SharePosts',
                'description'=> 'Simple social network on MCV Framework',
                'posts'=>$posts
            ];
            $this->view('pages/index', $data);
        }

        public function create($params = []){
            $this->view('pages/create');
        }

        public function about($params = []){
            $data = [
                'title'=>'About',
                'description'=> 'App to share posts',
            ];
            $this->view('pages/about', $data);
        }
    }
?>