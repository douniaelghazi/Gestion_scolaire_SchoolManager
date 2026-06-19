<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM eleve WHERE id_eleve = ?");
$stmt->execute([$id]);
$eleve = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $adresse = $_POST['adresse'];

    $sql = "UPDATE eleve
            SET nom=?, prenom=?, date_naissance=?, sexe=?, adresse=?
            WHERE id_eleve=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $prenom,
        $date_naissance,
        $sexe,
        $adresse,
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

    <input type="text" name="nom"
           value="<?= htmlspecialchars($eleve['nom']) ?>" required>

    <input type="text" name="prenom"
           value="<?= htmlspecialchars($eleve['prenom']) ?>" required>

    <input type="date" name="date_naissance"
           value="<?= $eleve['date_naissance'] ?>" required>

    <select name="sexe">
        <option value="M" <?= $eleve['sexe']=='M'?'selected':'' ?>>Masculin</option>
        <option value="F" <?= $eleve['sexe']=='F'?'selected':'' ?>>Féminin</option>
    </select>

    <textarea name="adresse"><?= htmlspecialchars($eleve['adresse']) ?></textarea>

    <button type="submit">Modifier</button>

</form>