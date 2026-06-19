<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
$stmt = $pdo->query("SELECT * FROM enseignant ORDER BY nom");
$enseignants = $stmt->fetchAll();
?>
<div class="page-header">
    <h2>Liste des Enseignants</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter un enseignant</a>
</div>
<?php if (isset($_GET['msg'])): ?><div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div><?php endif; ?>
<div class="card">
    <div class="card-body no-pad">
        <table class="table">
            <thead><tr><th>#</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (count($enseignants) === 0): ?>
                    <tr><td colspan="6" class="empty-row">Aucun enseignant trouvé.</td></tr>
                <?php else: ?>
                    <?php foreach ($enseignants as $e): ?>
                    <tr>
                        <td><?= $e['id_enseignant'] ?></td>
                        <td><?= htmlspecialchars($e['nom']) ?></td>
                        <td><?= htmlspecialchars($e['prenom']) ?></td>
                        <td><?= htmlspecialchars($e['email'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($e['telephone']) ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $e['id_enseignant'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="supprimer.php?id=<?= $e['id_enseignant'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>
