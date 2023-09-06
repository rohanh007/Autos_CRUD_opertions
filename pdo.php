<?php

    $hostName = "localhost";
    $userName = "rohan";
    $password = "rohan";
    $port = "3306";
    $dbName = "misc";

    try {
        $pdo = new PDO("mysql:host=$hostName;dbname=$dbName",$userName,$password);
        
        //ERRMODE_SILENT is default.
        //ERRMODE_WARNING will still keep executing code.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>