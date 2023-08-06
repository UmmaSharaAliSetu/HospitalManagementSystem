<!DOCTYPE html>
<html>

<head>
    <title>HMS - Hospital Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <fieldset align='center'>
        <h1 align='center'>Hospital Management System</h1>
        <nav>
            <?php
            if (isset($_SESSION['username']) && $_SESSION['role'] == 'receptionist') {
                // User is logged in as doctor
                $uName = ucfirst($_SESSION['username']);
                echo "<div align='center'>
                <b>Welcome, " . $uName . "!</b> 
                <br><br>
                <button><a href='index.php'>Home</a></button>
                <button><a href='profile.php'>Profile</a></button>
                <button><a href='change_password.php'>Change Password</a></button>
                <button><a href='logout.php'>Logout</a></button>
                </div>";

            } else {
                // User is not logged in
                echo "<div align='center'>
                <button><a href='index.php'>Home</a></button>
                <button><a href='login.php'>Login</a></button>
                <button><a href='registration.php'>Register</a></button>
                </div>";
            }
            ?>
        </nav>
    </fieldset>
    <fieldset>