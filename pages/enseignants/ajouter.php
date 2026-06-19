<?php
require_once '../../config/database.php';
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']); $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']); $telephone = trim($_POST['telephone']);
    if (empty($nom) || empty($prenom) || empty($telephone)) { $erreur = "Veuillez remplir tous les champs obligatoires."; }
    else {
        $stmt = $pdo->prepare("INSERT INTO enseignant (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)");
        $stmt->execute([':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email, ':telephone'=>$telephone]);
        header("Location: liste.php?msg=Enseignant ajouté avec succès !"); exit;
    }
}
require_once '../../includes/header.php'; require_once '../../includes/navbar.php';
?>
<div class="form-center"><div class="form-col"><div class="card">
    <div class="card-header primary"> Ajouter un enseignant</div>
    <div class="card-body">
        <?php if ($erreur): ?><div class="alert alert-danger"><?= $erreur ?></div><?php endif; ?>
        <form method="POST">
            <div class="field"><label class="label">Nom *</label><input type="text" name="nom" class="input" required></div>
            <div class="field"><label class="label">Prénom *</label><input type="text" name="prenom" class="input" required></div>
            <div class="field"><label class="label">Email</label><input type="email" name="email" class="input"></div>
            <div class="field"><label class="label">Téléphone *</label><input type="text" name="telephone" class="input" required></div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="liste.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div></div></div>
<?php require_once '../../includes/footer.php'; ?>
