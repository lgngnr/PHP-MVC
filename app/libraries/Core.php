<?php

    /**
    * CLASS Core.php
    * Create URL & loads core controller
    * URL Format: /controller/method/params  
    */

    class Core{

        const CURRENT_CONTROLLER = 'Pages'; 
        const CURRENT_METHOD = 'index'; 

        protected $currentController = self::CURRENT_CONTROLLER;
        protected $currentMethod = self::CURRENT_METHOD;
        protected $params = [];

        public function __construct(){
            $url = $this->getUrl();

            // Check if controllers exists
            if(file_exists("../app/controllers/" . ucwords($url[0]) . ".php")){
                //Update currentController
                $this->currentController = ucwords($url[0]);
                //Remove url[0]
                unset($url[0]);
            }

            // Load the controller
            require_once "../app/controllers/" . $this->currentController . ".php";
            // Istantiate the controller class
            $this->currentController = new $this->currentController;

            echo "<br>" . $this->currentController . "<br>";
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>