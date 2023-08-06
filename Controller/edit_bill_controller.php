<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Initialize variables for form fields
$billing_id = '';
$patient_id = '';
$appointment_id = '';
$bill_date = '';
$bill_amount = '';
$payment_status = '';

// Handle form submission
if (isset($_POST['load'])) {
    // Get billing_id from form submission
    $billing_id = $_POST['billing_id'];

    $billing = getBillingById($billing_id);

    // If appointment is found, load their information into form fields
    if ($billing) {
        $billing_id = $billing['billing_id'];
        $patient_id = $billing['patient_id'];
        $appointment_id = $billing['appointment_id'];
        $bill_date = $billing['bill_date'];
        $bill_amount = $billing['bill_amount'];
        $payment_status = $billing['payment_status'];
    } else {
        // If test_result is not found, display error message
        $loaderr = '<p align = "center">Billing Information not found with that billing id</p>';
    }
} elseif (isset($_POST['update'])) {
    // Get form data
    $billing_id = $_POST['billing_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_id = $_POST['appointment_id'];
    $bill_date = $_POST['bill_date'];
    $bill_amount = $_POST['bill_amount'];
    $payment_status = $_POST['payment_status'];

    updateBilling($patient_id, $appointment_id, $bill_date, $bill_amount, $payment_status, $billing_id);

    // Redirect to billing records page
    header('Location: billing.php');
    exit();

} elseif (isset($_POST['delete'])) {
    // Get the appointment ID from the form
    $billing_id = $_POST['billing_id'];
    deleteBillingRecord($billing_id);
    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the billing list page
        header('Location: billing.php');
        exit;
    } else {
        // Display an error message
        echo "Error deleting billing information.";
    }
}
?>