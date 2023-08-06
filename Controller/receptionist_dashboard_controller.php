<?php
session_start();

// Check if user is logged in and has the Receptionist role
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>