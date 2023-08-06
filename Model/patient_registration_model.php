<?php
function addPatient($doctor_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email) {
    require 'config.php';
    $stmt = $pdo->prepare('INSERT INTO patient (doctor_id,first_name, last_name, date_of_birth, gender, address, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$doctor_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email]);
}
?>