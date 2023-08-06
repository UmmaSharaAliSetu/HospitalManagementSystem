<?php
include 'config.php';
// Retrieve patient records from database and display
$stmt = $pdo->prepare("SELECT * FROM patient");
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>