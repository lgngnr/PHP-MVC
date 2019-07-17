<?php 
    // Load config
    require_once 'config/config.php';
    // Load helpers
    require_once "helpers/session_helper.php";

    // Library autoloader
    spl_autoload_register(function($className){
        require_once "libraries/$className.php";
    });
?>