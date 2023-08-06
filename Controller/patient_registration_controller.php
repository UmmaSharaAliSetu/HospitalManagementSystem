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
$first_name = '';
$last_name = '';
$date_of_birth = '';
$gender = '';
$address = '';
$phone = '';
$email = '';
$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $doctor_id = sanitize($_POST['doctor_id']);
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $date_of_birth = sanitize($_POST['date_of_birth']);
    if (isset($_POST['gender'])) {
        $gender = sanitize($_POST['gender']);
    } else {
        $gender = '';
    }
    $address = sanitize($_POST['address']);
    $phone = sanitize($_POST['phone']);
    $email = sanitize($_POST['email']);

    // Validate inputs
    if (empty($doctor_id)) {
        $errors[] = 'Doctor ID is required';
    }
    if (empty($first_name)) {
        $errors[] = 'First name is required';
    }
    if (empty($last_name)) {
        $errors[] = 'Last name is required';
    }
    if (empty($date_of_birth)) {
        $errors[] = 'Date of birth is required';
    }
    if (empty($gender)) {
        $errors[] = 'Gender is required';
    }
    if (empty($address)) {
        $errors[] = 'Address is required';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    // If there are no errors, insert the data into the database
    if (empty($errors)) {
        try {
            addPatient($doctor_id, $first_name, $last_name, $date_of_birth, $gender, $address, $phone, $email);
            $message = 'Patient registered successfully';
        } catch (PDOException $e) {
            echo 'Error adding patient: ' . $e->getMessage();
        }
    }
}
?>