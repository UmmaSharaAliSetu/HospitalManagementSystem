<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Initialize variables for form fields
$patient_id = '';
$first_name = '';
$last_name = '';
$date_of_birth = '';
$gender = '';
$address = '';
$phone = '';
$email = '';

// Handle form submission
if (isset($_POST['load'])) {
    // Get patient ID from form submission
    $patient_id = $_POST['patient_id'];
    $patient = getPatientById($patient_id);
    // If patient is found, load their information into form fields
    if ($patient) {
        $first_name = $patient['first_name'];
        $last_name = $patient['last_name'];
        $date_of_birth = $patient['date_of_birth'];
        $gender = $patient['gender'];
        $address = $patient['address'];
        $phone = $patient['phone'];
        $email = $patient['email'];
    } else {
        // If patient is not found, display error message
        $loaderr = '<p align = "center">Patient not found with that patient id</p>';
    }
} elseif (isset($_POST['update'])) {
    // Get form data
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    updatePatient($patient_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email);
    // Redirect to patient records page
    header('Location: patient_information.php');
    exit();

} elseif (isset($_POST['delete'])) {
    // Get the patient ID from the form
    $patient_id = $_POST['patient_id'];

    deletePatientRecord($patient_id);

}
?>