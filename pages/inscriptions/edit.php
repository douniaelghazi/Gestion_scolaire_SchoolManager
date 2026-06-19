<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$eleves = $pdo->query("SELECT * FROM eleve")->fetchAll();
$classes = $pdo->query("SELECT * FROM classe")->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM inscription WHERE id_inscription = ?");
$stmt->execute([$id]);
$inscription = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $pdo->prepare("
        UPDATE inscription
        SET id_eleve=?,
            id_classe=?,
            date_inscription=?,
            annee_scolaire=?
        WHERE id_inscription=?
    ");

    $stmt->execute([
        $_POST['id_eleve'],
        $_POST['id_classe'],
        $_POST['date_inscription'],
        $_POST['annee_scolaire'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

<select name="id_eleve">
<?php foreach($eleves as $e): ?>
<option value="<?= $e['id_eleve'] ?>"
<?= $e['id_eleve']==$inscription['id_eleve'] ? 'selected' : '' ?>>
<?= $e['nom'].' '.$e['prenom'] ?>
</option>
<?php endforeach; ?>
</select>

<select name="id_classe">
<?php foreach($classes as $c): ?>
<option value="<?= $c['id_classe'] ?>"
<?= $c['id_classe']==$inscription['id_classe'] ? 'selected' : '' ?>>
<?= $c['nom_classe'] ?>
</option>
<?php endforeach; ?>
</select>

<input type="date" name="date_inscription"
value="<?= $inscription['date_inscription'] ?>">

<input type="text" name="annee_scolaire"
value="<?= $inscription['annee_scolaire'] ?>">

<button type="submit">Modifier</button>

</form>