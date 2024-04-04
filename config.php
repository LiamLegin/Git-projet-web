<?php 
    $host = 'localhost';
    $dbname = 'stageo';
    $username = 'root';
    $password = '';
    try {
        $mysqlClient = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit();
    }
    ?>