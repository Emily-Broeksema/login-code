<?php

namespace LoginOpdracht\classes;
use PDO;

class Database {


    public $conn;

    public function __constructor(){ 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";


        try 
        {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            
        }catch(PDOException $e) 
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }



}
?>