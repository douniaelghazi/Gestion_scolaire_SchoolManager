<?php
require_once '../../config/database.php';

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_classe    = trim($_POST['nom_classe']);
    $niveau        = trim($_POST['niveau']);
    $annee_scolaire = trim($_POST['annee_scolaire']);
    $capacite_max  = (int)$_POST['capacite_max'];

    if (empty($nom_classe) || empty($niveau) || empty($annee_scolaire) || $capacite_max <= 0) {
        $erreur = "Veuillez remplir tous les champs correctement.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO classe (nom_classe, niveau, annee_scolaire, capacite_max)
                               VALUES (:nom_classe, :niveau, :annee_scolaire, :capacite_max)");
        $stmt->execute([
            ':nom_classe'     => $nom_classe,
            ':niveau'         => $niveau,
            ':annee_scolaire' => $annee_scolaire,
            ':capacite_max'   => $capacite_max
        ]);
        header("Location: liste.php?msg=Classe ajoutée avec succès !");
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
                <h5 class="">➕ Ajouter une classe</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="field">
                        <label class="label">Nom de la classe *</label>
                        <input type="text" name="nom_classe" class="input" placeholder="ex: TC-SCI-1" required>
                    </div>
                    <div class="field">
                        <label class="label">Niveau *</label>
                        <input type="text" name="niveau" class="input" placeholder="ex: Tronc Commun" required>
                    </div>
                    <div class="field">
                        <label class="label">Année scolaire *</label>
                        <input type="text" name="annee_scolaire" class="input" placeholder="ex: 2024-2025" required>
                    </div>
                    <div class="field">
                        <label class="label">Capacité max *</label>
                        <input type="number" name="capacite_max" class="input" min="1" required>
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
