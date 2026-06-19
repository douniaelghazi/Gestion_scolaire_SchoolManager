<?php
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM matiere");
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Liste des Matières</h1>

<a href="create.php">Ajouter une matière</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom Matière</th>
        <th>Coefficient</th>
        <th>Actions</th>
    </tr>

    <?php foreach($matieres as $matiere): ?>
    <tr>
        <td><?= $matiere['id_matiere'] ?></td>
        <td><?= htmlspecialchars($matiere['nom_matiere']) ?></td>
        <td><?= $matiere['coefficient'] ?></td>

        <td>
            <a href="edit.php?id=<?= $matiere['id_matiere'] ?>">Modifier</a>
            <a href="delete.php?id=<?= $matiere['id_matiere'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>