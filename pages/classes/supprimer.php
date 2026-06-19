<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM classe WHERE id_classe = :id");
$stmt->execute([':id' => $id]);
header("Location: liste.php?msg=Classe supprimée avec succès !");
exit;
?>
