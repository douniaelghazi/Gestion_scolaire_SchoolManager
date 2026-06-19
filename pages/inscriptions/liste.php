<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$stmt = $pdo->query("
    SELECT i.id_inscription, i.date_inscription, i.annee_scolaire,
           e.nom AS eleve_nom, e.prenom AS eleve_prenom,
           c.nom_classe
    FROM inscription i
    JOIN eleve e  ON i.id_eleve  = e.id_eleve
    JOIN classe c ON i.id_classe = c.id_classe
    ORDER BY i.date_inscription DESC
");
$inscriptions = $stmt->fetchAll();
?>

<div class="page-header">
    <h2>Liste des Inscriptions</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter une inscription</a>
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
                    <th>Élève</th>
                    <th>Classe</th>
                    <th>Date inscription</th>
                    <th>Année scolaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($inscriptions) === 0): ?>
                    <tr><td colspan="6" class="empty-row">Aucune inscription trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($inscriptions as $i): ?>
                    <tr>
                        <td><?= $i['id_inscription'] ?></td>
                        <td><?= htmlspecialchars($i['eleve_nom'] . ' ' . $i['eleve_prenom']) ?></td>
                        <td><?= htmlspecialchars($i['nom_classe']) ?></td>
                        <td><?= $i['date_inscription'] ?></td>
                        <td><?= $i['annee_scolaire'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $i['id_inscription'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="supprimer.php?id=<?= $i['id_inscription'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cette inscription ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
