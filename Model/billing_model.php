<?php
function getBillingRecords() {
    require 'config.php';
    $stmt = $pdo->prepare("SELECT * FROM billing");
    $stmt->execute();
    $billings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $billings;
}
$billings = getBillingRecords();
?>
