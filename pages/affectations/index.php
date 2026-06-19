<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/gestion_scolaire_schoolmanager/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/gestion_scolaire_schoolmanager/includes/navbar.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/gestion_scolaire_schoolmanager/includes/footer.php";

$sql="
SELECT a.*,
e.nom,
e.prenom,
m.nom_matiere,
c.nom_classe
FROM affectation a
JOIN enseignant e
ON a.id_enseignant=e.id_enseignant
JOIN matiere m
ON a.id_matiere=m.id_matiere
JOIN classe c
ON a.id_classe=c.id_classe
";

$affectations=$pdo->query($sql)->fetchAll();
?>

<h1>Liste des Affectations</h1>

<a href="create.php">Nouvelle Affectation</a>

<table border="1">

<tr>
<th>Enseignant</th>
<th>Matière</th>
<th>Classe</th>
<th>Année</th>
</tr>

<?php foreach($affectations as $a): ?>

<tr>

<td><?= $a['nom'].' '.$a['prenom'] ?></td>

<td><?= $a['nom_matiere'] ?></td>

<td><?= $a['nom_classe'] ?></td>

<td><?= $a['annee_scolaire'] ?></td>

</tr>

<?php endforeach; ?>

</table>