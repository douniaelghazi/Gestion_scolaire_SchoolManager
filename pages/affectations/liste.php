<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

// On fait un JOIN pour afficher les noms au lieu des IDs
$stmt = $pdo->query("
    SELECT a.id_affectation, a.annee_scolaire,
           e.nom AS ens_nom, e.prenom AS ens_prenom,
           m.nom_matiere,
           c.nom_classe
    FROM affectation a
    JOIN enseignant e ON a.id_enseignant = e.id_enseignant
    JOIN matiere m    ON a.id_matiere    = m.id_matiere
    JOIN classe c     ON a.id_classe     = c.id_classe
    ORDER BY a.annee_scolaire DESC
");
$affectations = $stmt->fetchAll();
?>

<div class="page-header">
    <h2>Liste des Affectations</h2>
    <a href="ajouter.php" class="btn btn-primary">+ Ajouter une affectation</a>
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
                    <th>Enseignant</th>
                    <th>Matière</th>
                    <th>Classe</th>
                    <th>Année scolaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($affectations) === 0): ?>
                    <tr><td colspan="6" class="empty-row">Aucune affectation trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($affectations as $a): ?>
                    <tr>
                        <td><?= $a['id_affectation'] ?></td>
                        <td><?= htmlspecialchars($a['ens_nom'] . ' ' . $a['ens_prenom']) ?></td>
                        <td><?= htmlspecialchars($a['nom_matiere']) ?></td>
                        <td><?= htmlspecialchars($a['nom_classe']) ?></td>
                        <td><?= $a['annee_scolaire'] ?></td>
                        <td>
                            <a href="modifier.php?id=<?= $a['id_affectation'] ?>" class="btn btn-sm btn-warning"> Modifier</a>
                            <a href="supprimer.php?id=<?= $a['id_affectation'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Supprimer cette affectation ?')"> Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
