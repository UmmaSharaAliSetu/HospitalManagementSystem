<?php
session_start(); // Start session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

include 'sanitize.php';
// Initialize variables
$doctor_id = '';
$patient_id = '';
$appointment_date = '';
$appointment_time = '';
$appointment_status = 'Scheduled';
$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $doctor_id = sanitize($_POST['doctor_id']);
    $patient_id = sanitize($_POST['patient_id']);
    $appointment_date = sanitize($_POST['appointment_date']);
    $appointment_time = sanitize($_POST['appointment_time']);

    // Validate inputs
    if (empty($doctor_id)) {
        $errors[] = 'Doctor ID is required';
    }
    if (empty($patient_id)) {
        $errors[] = 'Patient id is required';
    }
    if (empty($appointment_date)) {
        $errors[] = 'Appointment date is required';
    }
    if (empty($appointment_time)) {
        $errors[] = 'Appointment time is required';
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addAppointment($patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status);
            $message = 'Appointment scheduled successfully';
        } catch (PDOException $e) {
            echo 'Error adding patient: ' . $e->getMessage();
        }
    }
}
?>