<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$stmt = $pdo->query("SELECT * FROM matiere ORDER BY nom_matiere");
$matieres = $stmt->fetchAll();
?>

<div class="page-header">
    <h2>📚 Liste des Matières</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter une matière</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body no-pad">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la matière</th>
                    <th>Coefficient</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($matieres) === 0): ?>
                    <tr><td colspan="4" class="empty-row">Aucune matière trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($matieres as $m): ?>
                    <tr>
                        <td><?= $m['id_matiere'] ?></td>
                        <td><?= htmlspecialchars($m['nom_matiere']) ?></td>
                        <td><?= $m['coefficient'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $m['id_matiere'] ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                            <a href="supprimer.php?id=<?= $m['id_matiere'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cette matière ?')">🗑️ Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
