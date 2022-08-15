<?php

namespace APP\Model;

use PDO;

class Connection
{
    private static PDO $connection;

    private function __construct()
    {
    }


    public static function getConnection():PDO
    {
        if(empty(self::$connection)){
            self::$connection = new PDO(DNS,USER,PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$connection;
    }
    
}

/*
$servername = "Project_Web";
$username = "root";


try {
  $conn = new PDO("mysql:host=$servername;dbname=stock_clothes", $username,);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}*/

