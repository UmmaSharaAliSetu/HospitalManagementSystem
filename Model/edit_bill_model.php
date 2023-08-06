<?php
function getBillingById($billing_id) {
    require 'config.php';
    $stmt = $pdo->prepare('SELECT * FROM billing WHERE billing_id = ?');
    $stmt->execute([$billing_id]);
    return $stmt->fetch();
    }
    function updateBilling($patient_id, $appointment_id, $bill_date, $bill_amount, $payment_status, $billing_id) {
        require 'config.php';
        $stmt = $pdo->prepare("UPDATE billing SET patient_id = ?, appointment_id = ?, bill_date = ?, bill_amount = ?, payment_status = ? WHERE billing_id = ?");
        $stmt->execute([$patient_id, $appointment_id, $bill_date, $bill_amount, $payment_status, $billing_id]);
    }
    function deleteBillingRecord($billing_id) {
        require 'config.php';
        // Prepare and execute the SQL query to delete the billing record
        $stmt = $pdo->prepare("DELETE FROM billing WHERE billing_id = ?");
        $stmt->execute([$billing_id]);
    }
    
?>