<?php
require_once '../../config/database.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt=$pdo->prepare("
        INSERT INTO classe
        (nom_classe,niveau,annee_scolaire,capacite_max)
        VALUES (?,?,?,?)
    ");

    $stmt->execute([
        $_POST['nom_classe'],
        $_POST['niveau'],
        $_POST['annee_scolaire'],
        $_POST['capacite_max']
    ]);

    header('Location:index.php');
}
?>