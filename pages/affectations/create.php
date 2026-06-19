<?php
require_once '../../config/database.php';

$enseignants=$pdo->query(
"SELECT * FROM enseignant"
)->fetchAll();

$matieres=$pdo->query(
"SELECT * FROM matiere"
)->fetchAll();

$classes=$pdo->query(
"SELECT * FROM classe"
)->fetchAll();

if($_SERVER['REQUEST_METHOD']=='POST'){

$stmt=$pdo->prepare("
INSERT INTO affectation
(id_enseignant,id_matiere,id_classe,annee_scolaire)
VALUES(?,?,?,?)
");

$stmt->execute([
$_POST['id_enseignant'],
$_POST['id_matiere'],
$_POST['id_classe'],
$_POST['annee_scolaire']
]);

header("Location:index.php");
}
?>

<form method="POST">

<select name="id_enseignant">

<?php foreach($enseignants as $e): ?>

<option value="<?= $e['id_enseignant'] ?>">
<?= $e['nom'].' '.$e['prenom'] ?>
</option>

<?php endforeach; ?>

</select>

<select name="id_matiere">

<?php foreach($matieres as $m): ?>

<option value="<?= $m['id_matiere'] ?>">
<?= $m['nom_matiere'] ?>
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

<input type="text"
name="annee_scolaire"
placeholder="2025-2026">

<button type="submit">
Ajouter
</button>

</form>