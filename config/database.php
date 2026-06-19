<?php
// =============================================
//  Connexion à la base de données
// =============================================

$host     = "localhost";
$dbname   = "gestion_scolaire_schoolmanager";
$username = "root";
$password = "";   // Change si tu as un mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Afficher les erreurs SQL (utile pour débutants)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
?>
