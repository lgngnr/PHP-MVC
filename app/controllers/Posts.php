<?php
    class Posts extends Controller{

        public function __construct(){
            // If not logged redirect to login
            if(!isLoggedIn()){
                header("location: " . URLROOT . "/users/login");
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index(){
            // GET Posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts'=> $posts
            ];
            $this->view('posts/index', $data);
        }

        public function add(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                // Validate title
                if(empty($data['title'])){
                    $data['title_error'] = "Please add a title to the post";
                }
                // Validate body
                if(empty($data['body'])){
                    $data['body_error'] = "Please enter post text";
                }

                // If no error, save the post
                if(empty($data['title_error']) && empty($data['body_error'])){
                    // Save the post
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Post Added');
                        header('location: ' . URLROOT . '/posts');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    $this->view('posts/add', $data);
                }
            }else{
               $data = [
                'title'=> '',
                'body'=>''
                ];
                $this->view('posts/add', $data); 
            }
        }

        public function show($id){
            $post = $this->postModel->getPost($id);
            $user = $this->userModel->getUserById($_SESSION['user_id']);
            $data = [
                'post' => $post,
                'user' => $user
            ];
            $this->view('posts/show', $data);
        }

        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => ''
                ];

                // Validate title
                if(empty($data['title'])){
                    $data['title_error'] = "Please add a title to the post";
                }
                // Validate body
                if(empty($data['body'])){
                    $data['body_error'] = "Please enter post text";
                }

                // If no error, save the post
                if(empty($data['title_error']) && empty($data['body_error'])){
                    // Save the post
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'Post Updated');
                        header('location: ' . URLROOT . '/posts');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    $this->view('posts/edit', $data);
                }
            }else{
                // Check for owner
                $post = $this->postModel->getPost($id); 
                if($post->user_id != $_SESSION['user_id']){
                    header('location: ' . URLROOT . '/posts');
                }
                $data = [
                   'id'=> $id,
                    'title'=> $post->title,
                    'body'=> $post->body
                ];
                $this->view('posts/edit', $data); 
            }
        }
    }
