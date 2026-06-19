<?php
require_once '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM inscription WHERE id_inscription = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;