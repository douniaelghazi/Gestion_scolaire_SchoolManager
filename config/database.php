<?php

$host     = "localhost";
$dbname   = "gestion_scolaire_schoolmanager";
$username = "root";
$password = "";  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
       
} catch (PDOException $e) {
    echo("❌ Erreur de connexion : " . $e->getMessage());
}

?>