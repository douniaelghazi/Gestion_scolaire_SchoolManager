<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM matiere WHERE id_matiere = :id");
$stmt->execute([':id' => $id]);
header("Location: liste.php?msg=Matière supprimée avec succès !");
exit;
?>
