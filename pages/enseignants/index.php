<?php
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM enseignant");
$enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Enseignants</title>
</head>
<body>

<h1>Liste des Enseignants</h1>

<a href="create.php">Ajouter un enseignant</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>

    <?php foreach($enseignants as $enseignant): ?>
    <tr>
        <td><?= $enseignant['id_enseignant']; ?></td>

        <td><?= htmlspecialchars($enseignant['nom']); ?></td>

        <td><?= htmlspecialchars($enseignant['prenom']); ?></td>

        <td><?= htmlspecialchars($enseignant['email']); ?></td>

        <td><?= htmlspecialchars($enseignant['telephone']); ?></td>

        <td>
            <a href="edit.php?id=<?= $enseignant['id_enseignant']; ?>">
                Modifier
            </a>

            |

            <a href="delete.php?id=<?= $enseignant['id_enseignant']; ?>"
               onclick="return confirm('Voulez-vous supprimer cet enseignant ?')">
                Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>