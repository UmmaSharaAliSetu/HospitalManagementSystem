<?php
function getAppointments() {
    require 'config.php';
    $stmt = $pdo->prepare("SELECT * FROM appointment");
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $appointments;
}
?>
