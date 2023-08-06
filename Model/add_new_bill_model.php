<?php
function insertBilling($patient_id, $appointment_id, $bill_date, $bill_amount, $payment_status) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO billing (patient_id, appointment_id, bill_date, bill_amount, payment_status) VALUES (?, ?, ?, ?, ?)');
    $stmt->bindValue(1, $patient_id);
    $stmt->bindValue(2, $appointment_id);
    $stmt->bindValue(3, $bill_date);
    $stmt->bindValue(4, $bill_amount);
    $stmt->bindValue(5, $payment_status);
    $stmt->execute();
}
?>
