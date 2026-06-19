<?php
require_once '../../config/database.php';
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']); $prenom = trim($_POST['prenom']);
    $date_naissance = $_POST['date_naissance']; $sexe = $_POST['sexe'];
    $adresse = trim($_POST['adresse']);
    if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($sexe)) {
        $erreur = "Veuillez remplir tous les champs obligatoires.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO eleve (nom, prenom, date_naissance, sexe, adresse) VALUES (:nom, :prenom, :date_naissance, :sexe, :adresse)");
        $stmt->execute([':nom'=>$nom, ':prenom'=>$prenom, ':date_naissance'=>$date_naissance, ':sexe'=>$sexe, ':adresse'=>$adresse]);
        header("Location: liste.php?msg=Élève ajouté avec succès !"); exit;
    }
}
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
?>
<div class="form-center">
    <div class="form-col">
        <div class="card">
            <div class="card-header primary">➕ Ajouter un élève</div>
            <div class="card-body">
                <?php if ($erreur): ?><div class="alert alert-danger"><?= $erreur ?></div><?php endif; ?>
                <form method="POST">
                    <div class="field"><label class="label">Nom *</label><input type="text" name="nom" class="input" required></div>
                    <div class="field"><label class="label">Prénom *</label><input type="text" name="prenom" class="input" required></div>
                    <div class="field"><label class="label">Date de naissance *</label><input type="date" name="date_naissance" class="input" required></div>
                    <div class="field">
                        <label class="label">Sexe *</label>
                        <select name="sexe" class="input" required>
                            <option value="">-- Choisir --</option>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>
                    <div class="field"><label class="label">Adresse</label><input type="text" name="adresse" class="input"></div>
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
