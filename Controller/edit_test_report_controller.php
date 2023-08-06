<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Initialize variables for form fields
$test_result_id = '';
$patient_id = '';
$test_name = '';
$test_date = '';
$test_result = '';

// Handle form submission
if (isset($_POST['load'])) {
    // Get appointment ID from form submission
    $test_result_id = $_POST['test_result_id'];

    $test_result = getTestResultById($test_result_id);

    // If appointment is found, load their information into form fields
    if ($test_result) {
        $test_result_id = $test_result['test_result_id'];
        $patient_id = $test_result['patient_id'];
        $test_name = $test_result['test_name'];
        $test_date = $test_result['test_date'];
        $test_result = $test_result['test_result'];
    } else {
        // If test_result is not found, display error message
        $loaderr = '<p align = "center">Test result not found with that test result id</p>';
    }
} elseif (isset($_POST['update'])) {
    // Get form data
    $test_result_id = $_POST['test_result_id'];
    $patient_id = $_POST['patient_id'];
    $test_name = $_POST['test_name'];
    $test_date = $_POST['test_date'];
    $test_result = $_POST['test_result'];

    updateTestResult($patient_id, $test_name, $test_date, $test_result, $test_result_id);
    // Redirect to patient records page
    header('Location: test_result.php');
    exit();

} elseif (isset($_POST['delete'])) {
    // Get the appointment ID from the form
    $test_result_id = $_POST['test_result_id'];
    deleteTestResult($test_result_id);

}
?>