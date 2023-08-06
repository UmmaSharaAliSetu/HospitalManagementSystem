<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (empty($email)) {
        $error = "Enter email!";
    } else {
        require_once '../Model/forget_password_model.php';
        $user = getUserByEmail($email);
        if (!$user) {
            $error = "invalid email!";
        } else {
            $to = $email;
            $subject = "Forget Password for HMS";
            $message = "HMS Password: " . $user['password'];
            $headers = "From: 20-43223-1@student.aiub.edu";

            if (mail($to, $subject, $message, $headers)) {
                $success = "Password sent to your email.";
            } else {
                $error = "Unable to send email";
            }
        }
    }
}
?>