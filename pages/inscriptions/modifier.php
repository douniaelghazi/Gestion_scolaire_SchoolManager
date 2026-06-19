<?php
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM inscription WHERE id_inscription = :id");
$stmt->execute([':id' => $id]);
$i = $stmt->fetch();

if (!$i) { header("Location: liste.php"); exit; }

$eleves  = $pdo->query("SELECT id_eleve, nom, prenom FROM eleve ORDER BY nom")->fetchAll();
$classes = $pdo->query("SELECT id_classe, nom_classe FROM classe ORDER BY nom_classe")->fetchAll();

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_eleve         = $_POST['id_eleve'];
    $id_classe        = $_POST['id_classe'];
    $date_inscription = $_POST['date_inscription'];
    $annee_scolaire   = trim($_POST['annee_scolaire']);

    if (empty($id_eleve) || empty($id_classe) || empty($date_inscription) || empty($annee_scolaire)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("UPDATE inscription SET id_eleve=:eleve, id_classe=:classe, date_inscription=:date, annee_scolaire=:annee WHERE id_inscription=:id");
        $stmt->execute([':eleve'=>$id_eleve, ':classe'=>$id_classe, ':date'=>$date_inscription, ':annee'=>$annee_scolaire, ':id'=>$id]);
        header("Location: liste.php?msg=Inscription modifiée avec succès !");
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
                <h5 class="">✏️ Modifier l'inscription</h5>
            </div>
            <div class="card-body">
                <?php if ($erreur): ?>
                    <div class="btn alert-danger"><?= $erreur ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="field">
                        <label class="label">Élève *</label>
                        <select name="id_eleve" class="input" required>
                            <?php foreach ($eleves as $e): ?>
                                <option value="<?= $e['id_eleve'] ?>"
                                    <?= $e['id_eleve'] == $i['id_eleve'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Classe *</label>
                        <select name="id_classe" class="input" required>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id_classe'] ?>"
                                    <?= $c['id_classe'] == $i['id_classe'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['nom_classe']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label">Date d'inscription *</label>
                        <input type="date" name="date_inscription" class="input" value="<?= $i['date_inscription'] ?>" required>
                    </div>
                    <div class="field">
                        <label class="label">Année scolaire *</label>
                        <input type="text" name="annee_scolaire" class="input" value="<?= $i['annee_scolaire'] ?>" required>
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
