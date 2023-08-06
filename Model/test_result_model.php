<?php
include 'config.php';
// Retrieve test_results from database and display
$stmt = $pdo->prepare("SELECT * FROM test_results");
$stmt->execute();
$test_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>