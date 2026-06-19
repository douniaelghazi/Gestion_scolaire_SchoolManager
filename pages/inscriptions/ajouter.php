<?php
require_once '../../config/database.php';

$eleves  = $pdo->query("SELECT id_eleve, nom, prenom FROM eleve ORDER BY nom")->fetchAll();
$classes = $pdo->query("SELECT id_classe, nom_classe FROM classe ORDER BY nom_classe")->fetchAll();

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_eleve       = $_POST['id_eleve'];
    $id_classe      = $_POST['id_classe'];
    $date_inscription = $_POST['date_inscription'];
    $annee_scolaire = trim($_POST['annee_scolaire']);

    if (empty($id_eleve) || empty($id_classe) || empty($date_inscription) || empty($annee_scolaire)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO inscription (id_eleve, id_classe, date_inscription, annee_scolaire)
                               VALUES (:eleve, :classe, :date, :annee)");
        $stmt->execute([':eleve'=>$id_eleve, ':classe'=>$id_classe, ':date'=>$date_inscription, ':annee'=>$annee_scolaire]);
        header("Location: liste.php?msg=Inscription ajoutée avec succès !");
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
                <h5 class="">Ajouter une inscription</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="field">
                        <label class="label">Élève *</label>
                        <select name="id_eleve" class="input" required>
                            <option value="">-- Choisir un élève --</option>
                            <?php foreach ($eleves as $e): ?>
                                <option value="<?= $e['id_eleve'] ?>">
                                    <?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Classe *</label>
                        <select name="id_classe" class="input" required>
                            <option value="">-- Choisir une classe --</option>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id_classe'] ?>">
                                    <?= htmlspecialchars($c['nom_classe']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Date d'inscription *</label>
                        <input type="date" name="date_inscription" class="input" required>
                    </div>
                    <div class="field">
                        <label class="label">Année scolaire *</label>
                        <input type="text" name="annee_scolaire" class="input" placeholder="ex: 2024-2025" required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <a href="liste.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
