<?php

    /**
     * Base Controller
     * Loads the model and view
     */

    class Controller{

        // It loads model
        public function model($model){
            // Load model file
            require_once "../app/models/$model.php";

            // Istantiate model
            return new $model;
        }

        // It loads view
        public function view($view, $data = []){
            // Check if view esists
            if(file_exists("../app/views/$view.php")){
                // Load it
                require_once "../app/views/$view.php";
            }else{
                die('View does not exist');
            }
        }
    }
?>