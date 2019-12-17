<?php
    /*
        A simple reusable connection script
        https://www.php.net/manual/en/pdo.construct.php
    */


    function connect () {
      $host = "localhost";
      $dbname = "dbdata";
      $username = "root";
      $password = "";

  
      try {
        $conn = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);

      
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
    
        echo 'Connection failed: ' . $e->getMessage();
        exit;
      }

      return $conn;
    }