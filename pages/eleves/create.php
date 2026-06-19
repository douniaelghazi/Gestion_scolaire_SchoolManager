<?php
require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $adresse = $_POST['adresse'];

    $sql = "INSERT INTO eleve(nom, prenom, date_naissance, sexe, adresse)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nom,
        $prenom,
        $date_naissance,
        $sexe,
        $adresse
    ]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required>

    <input type="text" name="prenom" placeholder="Prénom" required>

    <input type="date" name="date_naissance" required>

    <select name="sexe">
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
    </select>

    <textarea name="adresse"></textarea>

    <button type="submit">Ajouter</button>
</form>