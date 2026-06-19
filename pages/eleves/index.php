<?php
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM eleve");
$eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Liste des élèves</h1>

<a href="create.php">Ajouter un élève</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date naissance</th>
        <th>Sexe</th>
        <th>Adresse</th>
        <th>Actions</th>
    </tr>

    <?php foreach($eleves as $eleve): ?>

    <tr>
        <td><?= $eleve['id_eleve'] ?></td>
        <td><?= htmlspecialchars($eleve['nom']) ?></td>
        <td><?= htmlspecialchars($eleve['prenom']) ?></td>
        <td><?= $eleve['date_naissance'] ?></td>
        <td><?= $eleve['sexe'] ?></td>
        <td><?= htmlspecialchars($eleve['adresse']) ?></td>

        <td>
            <a href="edit.php?id=<?= $eleve['id_eleve'] ?>">Modifier</a>

            <a href="delete.php?id=<?= $eleve['id_eleve'] ?>"
               onclick="return confirm('Supprimer cet élève ?')">
               Supprimer
            </a>
        </td>
    </tr>

    <?php endforeach; ?>
</table>