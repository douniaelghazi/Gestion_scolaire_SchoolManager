<?php
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM matiere WHERE id_matiere = :id");
$stmt->execute([':id' => $id]);
$m = $stmt->fetch();

if (!$m) { header("Location: liste.php"); exit; }

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_matiere = trim($_POST['nom_matiere']);
    $coefficient = $_POST['coefficient'];

    if (empty($nom_matiere) || $coefficient === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("UPDATE matiere SET nom_matiere=:nom, coefficient=:coef WHERE id_matiere=:id");
        $stmt->execute([':nom' => $nom_matiere, ':coef' => $coefficient, ':id' => $id]);
        header("Location: liste.php?msg=Matière modifiée avec succès !");
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
                <h5 class="">✏️ Modifier la matière</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="field">
                        <label class="label">Nom de la matière *</label>
                        <input type="text" name="nom_matiere" class="input" value="<?= htmlspecialchars($m['nom_matiere']) ?>" required>
                    </div>
                    <div class="field">
                        <label class="label">Coefficient *</label>
                        <input type="number" name="coefficient" class="input" step="0.01" min="0" value="<?= $m['coefficient'] ?>" required>
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
