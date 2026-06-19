<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$stmt = $pdo->query("SELECT * FROM classe ORDER BY annee_scolaire DESC, nom_classe");
$classes = $stmt->fetchAll();
?>

<div class="page-header">
    <h2>🏛️ Liste des Classes</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter une classe</a>
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
                    <th>Nom classe</th>
                    <th>Niveau</th>
                    <th>Année scolaire</th>
                    <th>Capacité max</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($classes) === 0): ?>
                    <tr><td colspan="6" class="empty-row">Aucune classe trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($classes as $c): ?>
                    <tr>
                        <td><?= $c['id_classe'] ?></td>
                        <td><?= htmlspecialchars($c['nom_classe']) ?></td>
                        <td><?= htmlspecialchars($c['niveau']) ?></td>
                        <td><?= $c['annee_scolaire'] ?></td>
                        <td><?= $c['capacite_max'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $c['id_classe'] ?>" class="btn btn-sm btn-warning">✏️ Modifier</a>
                            <a href="supprimer.php?id=<?= $c['id_classe'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cette classe ?')">🗑️ Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
