<?php

    class Pages extends Controller{

        public function __construct(){}

        public function index(){
            echo "<h1> Home Index</h1>";
            $this->view('hello');
        }

        public function create($params){
            echo "<br> Call function create, Params: <br>";
            print_r($params);
        }
    }
?>