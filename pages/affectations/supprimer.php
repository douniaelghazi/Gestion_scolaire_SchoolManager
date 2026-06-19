<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM affectation WHERE id_affectation = :id");
$stmt->execute([':id' => $id]);
header("Location: liste.php?msg=Affectation supprimée avec succès !");
exit;
?>
