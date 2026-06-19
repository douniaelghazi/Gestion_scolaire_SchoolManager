<?php
require_once '../../config/database.php';

$sql = "SELECT * FROM eleves";
$stmt = $pdo->query($sql);
$eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Liste des élèves</h1>

<a href="create.php">Ajouter un élève</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Actions</th>
    </tr>

    <?php foreach($eleves as $eleve): ?>
    <tr>
        <td><?= $eleve['id'] ?></td>
        <td><?= htmlspecialchars($eleve['nom']) ?></td>
        <td><?= htmlspecialchars($eleve['prenom']) ?></td>

        <td>
            <a href="edit.php?id=<?= $eleve['id'] ?>">Modifier</a>
            <a href="delete.php?id=<?= $eleve['id'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>