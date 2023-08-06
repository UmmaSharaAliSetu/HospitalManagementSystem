<?php
function addAppointment($patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO appointment (patient_id, doctor_id, appointment_date, appointment_time, appointment_status) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status]);
}
?>