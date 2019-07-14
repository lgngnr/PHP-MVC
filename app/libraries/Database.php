<?php

    /**
     * PDO Database class
     * Connect to database
     */
    class Database{
        private $host = DB_HOST;
        private $db_name = DB_NAME;
        private $user = DB_USER;
        private $pass = DB_PASS;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            // Set DSN
            $dns = "mysql://$this->host;dbname:$this->dn_name";
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            // Create PDO
            try{
                $this->dbh = new PDO($dns, $this->user, $this->pass);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
    }

?>