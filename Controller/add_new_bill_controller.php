<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
include 'sanitize.php';
// Initialize variables
$patient_id = '';
$appointment_id = '';
$bill_date = '';
$bill_amount = '';
$payment_status = '';

$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $appointment_id = sanitize($_POST['appointment_id']);
    $bill_date = sanitize($_POST['bill_date']);
    $bill_amount = sanitize($_POST['bill_amount']);
    $payment_status = $_POST['payment_status'];

    // Validate inputs
    if (empty($patient_id)) {
        $errors[] = 'Patient id is required';
    }
    if (empty($appointment_id)) {
        $errors[] = 'Appointment id is required';
    }
    if (empty($bill_date)) {
        $errors[] = 'Bill date is required';
    }
    if (empty($bill_amount)) {
        $errors[] = 'Bill amount is required';
    }
    if (empty($payment_status)) {
        $errors[] = 'Payment status is required';
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            insertBilling($patient_id, $appointment_id, $bill_date, $bill_amount, $payment_status);
            $message = 'Bill added successfully';
        } catch (PDOException $e) {
            echo 'Error adding Bill' . $e->getMessage();
        }
    }
}
?>