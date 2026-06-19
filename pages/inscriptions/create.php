<?php
require_once '../../config/database.php';

$eleves=$pdo->query("SELECT * FROM eleve")->fetchAll();
$classes=$pdo->query("SELECT * FROM classe")->fetchAll();

if($_SERVER['REQUEST_METHOD']=='POST'){

$stmt=$pdo->prepare("
INSERT INTO inscription
(id_eleve,id_classe,date_inscription,annee_scolaire)
VALUES(?,?,?,?)
");

$stmt->execute([
$_POST['id_eleve'],
$_POST['id_classe'],
$_POST['date_inscription'],
$_POST['annee_scolaire']
]);

header("Location:index.php");
}
?>

<form method="POST">

<select name="id_eleve">

<?php foreach($eleves as $e): ?>

<option value="<?= $e['id_eleve'] ?>">
<?= $e['nom'].' '.$e['prenom'] ?>
</option>

<?php endforeach; ?>

</select>

<select name="id_classe">

<?php foreach($classes as $c): ?>

<option value="<?= $c['id_classe'] ?>">
<?= $c['nom_classe'] ?>
</option>

<?php endforeach; ?>

</select>

<input type="date" name="date_inscription">

<input type="text" name="annee_scolaire"
placeholder="2025-2026">

<button type="submit">Ajouter</button>

</form>