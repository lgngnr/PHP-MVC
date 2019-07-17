<?php

    class Pages extends Controller{

        public function __construct(){
            $this->postModel = $this->model('Post');
        }

        public function index(){
            if(isLoggedIn()){
                header("location: " . URLROOT . "/posts");
            }
            $data = [
                'title'=>'SharePosts',
                'description'=> 'Simple social network on MCV Framework'
            ];
            $this->view('pages/index', $data);
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