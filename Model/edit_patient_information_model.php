<?php
function getPatientById($patient_id) {
    require 'config.php';
    $stmt = $pdo->prepare('SELECT * FROM patient WHERE patient_id = ?');
    $stmt->execute([$patient_id]);
    $patient = $stmt->fetch();
    return $patient;
}
function updatePatient($patient_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email) {
    require 'config.php';
    $stmt = $pdo->prepare("UPDATE patient SET first_name = ?, last_name = ?, 
          date_of_birth = ?, gender = ?, address = ?, phone = ?, email = ? 
          WHERE patient_id = ?");
    $stmt->execute([$first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email, $patient_id]);
}
function deletePatientRecord($patient_id) {
    require 'config.php';
    // Prepare and execute the SQL query to delete the patient record
    $stmt = $pdo->prepare("DELETE FROM patient WHERE patient_id = ?");
    $stmt->execute([$patient_id]);

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the patient list page
        header('Location: patient_information.php');
        exit;
    } else {
        // Display an error message
        echo "Error deleting patient record.";
    }
}

?>