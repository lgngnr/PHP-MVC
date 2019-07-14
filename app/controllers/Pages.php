<?php

    class Pages{

        public function __construct(){}

        public function index(){
            echo "<h1> Home Index</h1>";
        }

        public function create($params){
            echo "<br> Call function create, Params: <br>";
            print_r($params);
        }
    }
?>