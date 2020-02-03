<?php
   

    



$dsn="mysql:dbname=doctor_office;host=localhost:8889;charset=utf8";
    $username = "root";
    $password = "root";
    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $exception) {
        echo 'Database error: ' . $exception->getMessage();
    }
  
 ?>