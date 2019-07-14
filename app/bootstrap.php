<?php 
    // Load config
    require_once 'config/config.php';

    // Library autoloader
    spl_autoload_register(function($className){
        require_once "libraries/$className.php";
    });
?>