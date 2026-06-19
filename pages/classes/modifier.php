<?php
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM classe WHERE id_classe = :id");
$stmt->execute([':id' => $id]);
$c = $stmt->fetch();

if (!$c) { header("Location: liste.php"); exit; }

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_classe     = trim($_POST['nom_classe']);
    $niveau         = trim($_POST['niveau']);
    $annee_scolaire = trim($_POST['annee_scolaire']);
    $capacite_max   = (int)$_POST['capacite_max'];

    if (empty($nom_classe) || empty($niveau) || empty($annee_scolaire) || $capacite_max <= 0) {
        $erreur = "Veuillez remplir tous les champs correctement.";
    } else {
        $stmt = $pdo->prepare("UPDATE classe SET nom_classe=:nom_classe, niveau=:niveau,
                               annee_scolaire=:annee_scolaire, capacite_max=:capacite_max
                               WHERE id_classe=:id");
        $stmt->execute([
            ':nom_classe'     => $nom_classe,
            ':niveau'         => $niveau,
            ':annee_scolaire' => $annee_scolaire,
            ':capacite_max'   => $capacite_max,
            ':id'             => $id
        ]);
        header("Location: liste.php?msg=Classe modifiée avec succès !");
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
                <h5 class="">✏️ Modifier la classe</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="field">
                        <label class="label">Nom de la classe *</label>
                        <input type="text" name="nom_classe" class="input" value="<?= htmlspecialchars($c['nom_classe']) ?>" required>
                    </div>
                    <div class="field">
                        <label class="label">Niveau *</label>
                        <input type="text" name="niveau" class="input" value="<?= htmlspecialchars($c['niveau']) ?>" required>
                    </div>
                    <div class="field">
                        <label class="label">Année scolaire *</label>
                        <input type="text" name="annee_scolaire" class="input" value="<?= $c['annee_scolaire'] ?>" required>
                    </div>
                    <div class="field">
                        <label class="label">Capacité max *</label>
                        <input type="number" name="capacite_max" class="input" value="<?= $c['capacite_max'] ?>" min="1" required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">💾 Enregistrer</button>
                        <a href="liste.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
