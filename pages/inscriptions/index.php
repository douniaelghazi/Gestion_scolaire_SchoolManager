<?php
require_once '../../config/database.php';

$sql="
SELECT i.*,e.nom,e.prenom,c.nom_classe
FROM inscription i
JOIN eleve e ON i.id_eleve=e.id_eleve
JOIN classe c ON i.id_classe=c.id_classe
";

$inscriptions=$pdo->query($sql)->fetchAll();
?>

<h1>Liste des Inscriptions</h1>

<a href="create.php">Nouvelle inscription</a>

<table border="1">

<tr>
    <th>Élève</th>
    <th>Classe</th>
    <th>Date</th>
    <th>Année</th>
</tr>

<?php foreach($inscriptions as $i): ?>

<tr>

<td><?= $i['nom'].' '.$i['prenom'] ?></td>

<td><?= $i['nom_classe'] ?></td>

<td><?= $i['date_inscription'] ?></td>

<td><?= $i['annee_scolaire'] ?></td>

</tr>

<?php endforeach; ?>

</table>