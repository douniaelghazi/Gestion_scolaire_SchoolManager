<?php
require_once '../../config/database.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt=$pdo->prepare("
        INSERT INTO matiere(nom_matiere,coefficient)
        VALUES(?,?)
    ");

    $stmt->execute([
        $_POST['nom_matiere'],
        $_POST['coefficient']
    ]);

    header("Location:index.php");
}
?>

<form method="POST">

    <input type="text" name="nom_matiere" placeholder="Nom matière" required>

    <input type="number" name="coefficient" required>

    <button type="submit">Ajouter</button>

</form>