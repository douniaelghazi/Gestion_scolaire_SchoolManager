<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM enseignant WHERE id_enseignant = :id");
$stmt->execute([':id' => $id]);
header("Location: liste.php?msg=Enseignant supprimé avec succès !");
exit;
?>
