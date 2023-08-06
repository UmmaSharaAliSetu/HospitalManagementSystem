<?php
function insertTestResult($patient_id, $test_name, $test_date, $test_result) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO test_results (patient_id, test_name, test_date, test_result) VALUES (?, ?, ?, ?)');
    $stmt->bindValue(1, $patient_id);
    $stmt->bindValue(2, $test_name);
    $stmt->bindValue(3, $test_date);
    $stmt->bindValue(4, $test_result);
    $stmt->execute();
}
?>
