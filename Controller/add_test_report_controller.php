<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
include 'sanitize.php';
// Initialize variables
$test_result_id = '';
$patient_id = '';
$test_name = '';
$test_date = '';
$test_result = '';
$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $patient_id = sanitize($_POST['patient_id']);
    $test_name = sanitize($_POST['test_name']);
    $test_date = sanitize($_POST['test_date']);
    $test_result = sanitize($_POST['test_result']);

    // Validate inputs
    if (empty($patient_id)) {
        $errors[] = 'Patient id is required';
    }
    if (empty($test_name)) {
        $errors[] = 'Test name is required';
    }
    if (empty($test_date)) {
        $errors[] = 'Test date is required';
    }
    if (empty($test_result)) {
        $errors[] = 'Test result is required';
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            insertTestResult($patient_id, $test_name, $test_date, $test_result);
            $message = 'Test Result added successfully';
        } catch (PDOException $e) {
            echo 'Error adding test result ' . $e->getMessage();
        }
    }
}
?>