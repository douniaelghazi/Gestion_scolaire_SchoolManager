<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$stmt = $pdo->query("SELECT * FROM eleve ORDER BY nom");
$eleves = $stmt->fetchAll();
?>

<div class="page-header">
    <h2>👨‍🎓 Liste des Élèves</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter un élève</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body no-pad">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th><th>Nom</th><th>Prénom</th><th>Date naissance</th><th>Sexe</th><th>Adresse</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($eleves) === 0): ?>
                    <tr><td colspan="7" class="empty-row">Aucun élève trouvé.</td></tr>
                <?php else: ?>
                    <?php foreach ($eleves as $e): ?>
                    <tr>
                        <td><?= $e['id_eleve'] ?></td>
                        <td><?= htmlspecialchars($e['nom']) ?></td>
                        <td><?= htmlspecialchars($e['prenom']) ?></td>
                        <td><?= $e['date_naissance'] ?></td>
                        <td><?= $e['sexe'] === 'M' ? '👦 M' : '👧 F' ?></td>
                        <td><?= htmlspecialchars($e['adresse'] ?? '-') ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $e['id_eleve'] ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                            <a href="supprimer.php?id=<?= $e['id_eleve'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cet élève ?')">🗑️ Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
