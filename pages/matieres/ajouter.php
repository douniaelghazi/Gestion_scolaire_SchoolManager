<?php
require_once '../../config/database.php';

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_matiere = trim($_POST['nom_matiere']);
    $coefficient = $_POST['coefficient'];

    if (empty($nom_matiere) || $coefficient === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO matiere (nom_matiere, coefficient) VALUES (:nom, :coef)");
        $stmt->execute([':nom' => $nom_matiere, ':coef' => $coefficient]);
        header("Location: liste.php?msg=Matière ajoutée avec succès !");
        exit;
    }
}

require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
?>

<div class="form-center">
    <div class="form-col">
        <div class="card">
            <div class="card-header primary">
                <h5 class="">➕ Ajouter une matière</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="field">
                        <label class="label">Nom de la matière *</label>
                        <input type="text" name="nom_matiere" class="input" required>
                    </div>
                    <div class="field">
                        <label class="label">Coefficient *</label>
                        <input type="number" name="coefficient" class="input" step="0.01" min="0" required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                        <a href="liste.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
