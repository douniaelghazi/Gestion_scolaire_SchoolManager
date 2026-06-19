<?php
require_once '../../config/database.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $pdo->prepare("
        INSERT INTO enseignant
        (nom,prenom,email,telephone)
        VALUES (?,?,?,?)
    ");

    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone']
    ]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

    <input type="text" name="nom" placeholder="Nom" required>

    <input type="text" name="prenom" placeholder="Prénom" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="text" name="telephone" placeholder="Téléphone" required>

    <button type="submit">Ajouter</button>

</form>