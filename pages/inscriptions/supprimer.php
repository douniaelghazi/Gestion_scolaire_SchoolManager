<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM inscription WHERE id_inscription = :id");
$stmt->execute([':id' => $id]);
header("Location: liste.php?msg=Inscription supprimée avec succès !");
exit;
?>
