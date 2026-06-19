<?php
require_once '../../config/database.php';

$id=$_GET['id'];

$stmt=$pdo->prepare(
"SELECT * FROM classe WHERE id_classe=?"
);

$stmt->execute([$id]);

$classe=$stmt->fetch();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt=$pdo->prepare("
        UPDATE classe
        SET nom_classe=?,
            niveau=?,
            annee_scolaire=?,
            capacite_max=?
        WHERE id_classe=?
    ");

    $stmt->execute([
        $_POST['nom_classe'],
        $_POST['niveau'],
        $_POST['annee_scolaire'],
        $_POST['capacite_max'],
        $id
    ]);

    header('Location:index.php');
}
?>