<?php
require_once '../../config/database.php';

$id=$_GET['id'];

$stmt=$pdo->prepare(
"DELETE FROM classe WHERE id_classe=?"
);

$stmt->execute([$id]);

header('Location:index.php');