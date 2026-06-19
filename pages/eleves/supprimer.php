<?php
require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;

// Supprimer l'élève
$stmt = $pdo->prepare("DELETE FROM eleve WHERE id_eleve = :id");
$stmt->execute([':id' => $id]);

header("Location: liste.php?msg=Élève supprimé avec succès !");
exit;
?>
