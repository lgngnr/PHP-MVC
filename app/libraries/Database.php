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
            $dns = "mysql:host=$this->host;dbname=$this->db_name";
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            // Create PDO
            try{
                $this->dbh = new PDO($dns, $this->user, $this->pass, $options);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // prepared statement with query
        public function query($sql){
            try{
                $this->stmt = $this->dbh->prepare($sql);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Bind values
        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR; 
                }
            }
            try{
                $this->stmt->bindValue($param, $value, $type);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Execute prepared statement
        public function execute(){
            return $this->stmt->execute();
        }

        // Get result set as array of objects
        public function resultSet(){
            try{
                $this->execute();
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single row
        public function single(){
            try{
                $this->execute();
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Row Count
        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }

?>