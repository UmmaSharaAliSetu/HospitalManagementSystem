<?php
function getAppointmentById($appointment_id) {
    require 'config.php';
    // Query database for appointment with matching ID
    $stmt = $pdo->prepare('SELECT * FROM appointment WHERE appointment_id = ?');
    $stmt->execute([$appointment_id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    return $appointment;
}
function updateAppointment($appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status) {
    require 'config.php';
    $stmt = $pdo->prepare("UPDATE appointment SET patient_id = ?, doctor_id = ?, appointment_date = ?, appointment_time = ?, appointment_status = ? WHERE appointment_id = ?");
    $stmt->execute([$patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status, $appointment_id]);
}

function deleteAppointment($appointment_id) {
    require 'config.php';
    // Prepare and execute the SQL query to delete the appointment record
    $stmt = $pdo->prepare("DELETE FROM appointment WHERE appointment_id = ?");
    $stmt->execute([$appointment_id]);
}
?>
