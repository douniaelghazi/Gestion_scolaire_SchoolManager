<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare(
"SELECT * FROM enseignant WHERE id_enseignant=?"
);

$stmt->execute([$id]);

$enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $pdo->prepare("
        UPDATE enseignant
        SET nom=?,
            prenom=?,
            email=?,
            telephone=?
        WHERE id_enseignant=?
    ");

    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        $id
    ]);

    header("Location:index.php");
    exit;
}
?>

<form method="POST">

    <input type="text"
           name="nom"
           value="<?= htmlspecialchars($enseignant['nom']) ?>"
           required>

    <input type="text"
           name="prenom"
           value="<?= htmlspecialchars($enseignant['prenom']) ?>"
           required>

    <input type="email"
           name="email"
           value="<?= htmlspecialchars($enseignant['email']) ?>"
           required>

    <input type="text"
           name="telephone"
           value="<?= htmlspecialchars($enseignant['telephone']) ?>"
           required>

    <button type="submit">Modifier</button>

</form>