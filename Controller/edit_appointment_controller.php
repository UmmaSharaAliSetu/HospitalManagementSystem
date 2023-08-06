<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Initialize variables for form fields
$appointment_id = '';
$doctor_id = '';
$patient_id = '';
$appointment_date = '';
$appointment_time = '';
$appointment_status = '';

// Handle form submission
if (isset($_POST['load'])) {
    // Get appointment ID from form submission
    $appointment_id = $_POST['appointment_id'];
    $appointment = getAppointmentById($appointment_id);

    // If appointment is found, load their information into form fields
    if ($appointment) {
        $doctor_id = $appointment['doctor_id'];
        $patient_id = $appointment['patient_id'];
        $appointment_date = $appointment['appointment_date'];
        $appointment_time = $appointment['appointment_time'];
        $appointment_status = $appointment['appointment_status'];
    } else {
        // If appointment is not found, display error message
        $loaderr = '<p align = "center">Appointment not found with that appointment id</p>';
    }
} elseif (isset($_POST['update'])) {
    // Get form data
    $appointment_id = $_POST['appointment_id'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_status = $_POST['appointment_status'];

    updateAppointment($appointment_id, $patient_id, $doctor_id, $appointment_date, $appointment_time, $appointment_status);

    // Redirect to patient records page
    header('Location: appointment.php');
    exit();

} elseif (isset($_POST['delete'])) {
    // Get the appointment ID from the form
    $appointment_id = $_POST['appointment_id'];
    deleteAppointment($appointment_id);
    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the appointment list page
        header('Location: appointment.php');
        exit;
    } else {
        // Display an error message
        echo "Error deleting appointment.";
    }
}
?>