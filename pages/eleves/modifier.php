<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM eleve WHERE id_eleve = :id");
$stmt->execute([':id' => $id]);
$e = $stmt->fetch();
if (!$e) { header("Location: liste.php"); exit; }
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']); $prenom = trim($_POST['prenom']);
    $date_naissance = $_POST['date_naissance']; $sexe = $_POST['sexe'];
    $adresse = trim($_POST['adresse']);
    if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($sexe)) {
        $erreur = "Veuillez remplir tous les champs obligatoires.";
    } else {
        $stmt = $pdo->prepare("UPDATE eleve SET nom=:nom, prenom=:prenom, date_naissance=:date_naissance, sexe=:sexe, adresse=:adresse WHERE id_eleve=:id");
        $stmt->execute([':nom'=>$nom, ':prenom'=>$prenom, ':date_naissance'=>$date_naissance, ':sexe'=>$sexe, ':adresse'=>$adresse, ':id'=>$id]);
        header("Location: liste.php?msg=Élève modifié avec succès !"); exit;
    }
}
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
?>
<div class="form-center">
    <div class="form-col">
        <div class="card">
            <div class="card-header warning">Modifier l'élève</div>
            <div class="card-body">
                <?php if ($erreur): ?><div class="alert alert-danger"><?= $erreur ?></div><?php endif; ?>
                <form method="POST">
                    <div class="field"><label class="label">Nom *</label><input type="text" name="nom" class="input" value="<?= htmlspecialchars($e['nom']) ?>" required></div>
                    <div class="field"><label class="label">Prénom *</label><input type="text" name="prenom" class="input" value="<?= htmlspecialchars($e['prenom']) ?>" required></div>
                    <div class="field"><label class="label">Date de naissance *</label><input type="date" name="date_naissance" class="input" value="<?= $e['date_naissance'] ?>" required></div>
                    <div class="field">
                        <label class="label">Sexe *</label>
                        <select name="sexe" class="input" required>
                            <option value="M" <?= $e['sexe']==='M'?'selected':'' ?>>Masculin</option>
                            <option value="F" <?= $e['sexe']==='F'?'selected':'' ?>>Féminin</option>
                        </select>
                    </div>
                    <div class="field"><label class="label">Adresse</label><input type="text" name="adresse" class="input" value="<?= htmlspecialchars($e['adresse'] ?? '') ?>"></div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning"> Enregistrer</button>
                        <a href="liste.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>
