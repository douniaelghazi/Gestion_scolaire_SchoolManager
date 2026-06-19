<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM matiere WHERE id_matiere=?");
$stmt->execute([$id]);

header("Location:index.php");
exit;