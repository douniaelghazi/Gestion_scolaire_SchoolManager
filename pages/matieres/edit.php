<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM matiere WHERE id_matiere=?");
$stmt->execute([$id]);
$matiere = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $pdo->prepare("
        UPDATE matiere
        SET nom_matiere=?, coefficient=?
        WHERE id_matiere=?
    ");

    $stmt->execute([
        $_POST['nom_matiere'],
        $_POST['coefficient'],
        $id
    ]);

    header("Location:index.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="nom_matiere" value="<?= $matiere['nom_matiere'] ?>" required>
    <input type="number" name="coefficient" value="<?= $matiere['coefficient'] ?>" required>
    <button>Modifier</button>
</form>