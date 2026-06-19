<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM enseignant WHERE id_enseignant = :id");
$stmt->execute([':id' => $id]); $e = $stmt->fetch();
if (!$e) { header("Location: liste.php"); exit; }
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']); $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']); $telephone = trim($_POST['telephone']);
    if (empty($nom) || empty($prenom) || empty($telephone)) { $erreur = "Veuillez remplir tous les champs obligatoires."; }
    else {
        $stmt = $pdo->prepare("UPDATE enseignant SET nom=:nom, prenom=:prenom, email=:email, telephone=:telephone WHERE id_enseignant=:id");
        $stmt->execute([':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email, ':telephone'=>$telephone, ':id'=>$id]);
        header("Location: liste.php?msg=Enseignant modifié avec succès !"); exit;
    }
}
require_once '../../includes/header.php'; require_once '../../includes/navbar.php';
?>
<div class="form-center"><div class="form-col"><div class="card">
    <div class="card-header warning">✏️ Modifier l'enseignant</div>
    <div class="card-body">
        <?php if ($erreur): ?><div class="alert alert-danger"><?= $erreur ?></div><?php endif; ?>
        <form method="POST">
            <div class="field"><label class="label">Nom *</label><input type="text" name="nom" class="input" value="<?= htmlspecialchars($e['nom']) ?>" required></div>
            <div class="field"><label class="label">Prénom *</label><input type="text" name="prenom" class="input" value="<?= htmlspecialchars($e['prenom']) ?>" required></div>
            <div class="field"><label class="label">Email</label><input type="email" name="email" class="input" value="<?= htmlspecialchars($e['email'] ?? '') ?>"></div>
            <div class="field"><label class="label">Téléphone *</label><input type="text" name="telephone" class="input" value="<?= htmlspecialchars($e['telephone']) ?>" required></div>
            <div class="btn-group">
                <button type="submit" class="btn btn-warning">💾 Enregistrer</button>
                <a href="liste.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div></div></div>
<?php require_once '../../includes/footer.php'; ?>
