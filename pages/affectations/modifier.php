<?php
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM affectation WHERE id_affectation = :id");
$stmt->execute([':id' => $id]);
$a = $stmt->fetch();

if (!$a) { header("Location: liste.php"); exit; }

$enseignants = $pdo->query("SELECT id_enseignant, nom, prenom FROM enseignant ORDER BY nom")->fetchAll();
$matieres    = $pdo->query("SELECT id_matiere, nom_matiere FROM matiere ORDER BY nom_matiere")->fetchAll();
$classes     = $pdo->query("SELECT id_classe, nom_classe FROM classe ORDER BY nom_classe")->fetchAll();

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_enseignant  = $_POST['id_enseignant'];
    $id_matiere     = $_POST['id_matiere'];
    $id_classe      = $_POST['id_classe'];
    $annee_scolaire = trim($_POST['annee_scolaire']);

    if (empty($id_enseignant) || empty($id_matiere) || empty($id_classe) || empty($annee_scolaire)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("UPDATE affectation SET id_enseignant=:ens, id_matiere=:mat, id_classe=:cls, annee_scolaire=:annee WHERE id_affectation=:id");
        $stmt->execute([':ens'=>$id_enseignant, ':mat'=>$id_matiere, ':cls'=>$id_classe, ':annee'=>$annee_scolaire, ':id'=>$id]);
        header("Location: liste.php?msg=Affectation modifiée avec succès !");
        exit;
    }
}

require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
?>

<div class="form-center">
    <div class="form-col">
        <div class="card">
            <div class="card-header warning">
                <h5 class="">✏️ Modifier l'affectation</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="field">
                        <label class="label">Enseignant *</label>
                        <select name="id_enseignant" class="input" required>
                            <?php foreach ($enseignants as $e): ?>
                                <option value="<?= $e['id_enseignant'] ?>"
                                    <?= $e['id_enseignant'] == $a['id_enseignant'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Matière *</label>
                        <select name="id_matiere" class="input" required>
                            <?php foreach ($matieres as $m): ?>
                                <option value="<?= $m['id_matiere'] ?>"
                                    <?= $m['id_matiere'] == $a['id_matiere'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($m['nom_matiere']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Classe *</label>
                        <select name="id_classe" class="input" required>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id_classe'] ?>"
                                    <?= $c['id_classe'] == $a['id_classe'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['nom_classe']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Année scolaire *</label>
                        <input type="text" name="annee_scolaire" class="input" value="<?= $a['annee_scolaire'] ?>" required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">Enregistrer</button>
                        <a href="liste.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
