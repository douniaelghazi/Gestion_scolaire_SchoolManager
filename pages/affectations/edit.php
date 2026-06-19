<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$enseignants = $pdo->query("SELECT * FROM enseignant")->fetchAll();
$matieres = $pdo->query("SELECT * FROM matiere")->fetchAll();
$classes = $pdo->query("SELECT * FROM classe")->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM affectation WHERE id_affectation = ?");
$stmt->execute([$id]);
$affectation = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $pdo->prepare("
        UPDATE affectation
        SET id_enseignant=?,
            id_matiere=?,
            id_classe=?,
            annee_scolaire=?
        WHERE id_affectation=?
    ");

    $stmt->execute([
        $_POST['id_enseignant'],
        $_POST['id_matiere'],
        $_POST['id_classe'],
        $_POST['annee_scolaire'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

<select name="id_enseignant">
<?php foreach($enseignants as $e): ?>
<option value="<?= $e['id_enseignant'] ?>"
<?= $e['id_enseignant']==$affectation['id_enseignant'] ? 'selected' : '' ?>>
<?= $e['nom'].' '.$e['prenom'] ?>
</option>
<?php endforeach; ?>
</select>

<select name="id_matiere">
<?php foreach($matieres as $m): ?>
<option value="<?= $m['id_matiere'] ?>"
<?= $m['id_matiere']==$affectation['id_matiere'] ? 'selected' : '' ?>>
<?= $m['nom_matiere'] ?>
</option>
<?php endforeach; ?>
</select>

<select name="id_classe">
<?php foreach($classes as $c): ?>
<option value="<?= $c['id_classe'] ?>"
<?= $c['id_classe']==$affectation['id_classe'] ? 'selected' : '' ?>>
<?= $c['nom_classe'] ?>
</option>
<?php endforeach; ?>
</select>

<input type="text" name="annee_scolaire"
value="<?= $affectation['annee_scolaire'] ?>">

<button type="submit">Modifier</button>

</form>