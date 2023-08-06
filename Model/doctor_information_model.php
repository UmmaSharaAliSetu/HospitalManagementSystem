<?php
include 'config.php';
// Retrieve doctors information from database and display
$stmt = $pdo->prepare("SELECT * FROM doctor");
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
