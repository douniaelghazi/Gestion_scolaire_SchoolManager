<?php
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM classe");
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Classes</title>
</head>
<body>

<h1>Liste des Classes</h1>

<a href="create.php">Ajouter une classe</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nom Classe</th>
        <th>Niveau</th>
        <th>Année Scolaire</th>
        <th>Capacité Max</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($classes as $classe): ?>
    <tr>
        <td><?= $classe['id_classe']; ?></td>

        <td><?= htmlspecialchars($classe['nom_classe']); ?></td>

        <td><?= htmlspecialchars($classe['niveau']); ?></td>

        <td><?= htmlspecialchars($classe['annee_scolaire']); ?></td>

        <td><?= $classe['capacite_max']; ?></td>

        <td>
            <a href="edit.php?id=<?= $classe['id_classe']; ?>">
                Modifier
            </a>

            |

            <a href="delete.php?id=<?= $classe['id_classe']; ?>"
               onclick="return confirm('Voulez-vous supprimer cette classe ?');">
                Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>