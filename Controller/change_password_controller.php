<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve current password from database and do something with it
    $currentPassword = getCurrentPassword($_SESSION['username']);
    // Verify current password
    if ($_POST['current_password'] === $currentPassword) {
        // Verify new and confirm passwords match
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            // Verify password strength
            if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST['new_password'])) {
                // Update user's password in database
                $newPassword = $_POST['new_password'];
                updatePassword($_SESSION['username'], $newPassword);
                $message = 'Password changed successfully';
            } else {
                $message = 'Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long';
            }
        } else {
            $message = 'New password and confirm password do not match';
        }
    } else {
        $message = 'Current password is incorrect';
    }
}
?>
