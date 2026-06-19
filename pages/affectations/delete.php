<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM affectation WHERE id_affectation = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;