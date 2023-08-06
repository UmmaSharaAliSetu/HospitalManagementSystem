<?php
session_start(); // Start session
include "header.php";
include '../Model/config.php';

$error_msg = '';

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    // Check username and password against database
    $stmt = $pdo->prepare("SELECT * FROM User WHERE username=:username AND password=:password");
    $stmt->execute([':username' => $_COOKIE['username'], ':password' => $_COOKIE['password']]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        // Set session variables
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'receptionist') {
            header('Location: receptionist_dashboard.php');
            exit();
        }
    }
}

if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        $error_msg = "Username is required.";
    } elseif (empty($_POST['password'])) {
        $error_msg = "Password is required.";
    } elseif (empty($_POST['username']) && empty($_POST['password'])) {
        $error_msg = "Both username and password are required.";
    } else {
        // Check username and password against database
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);

        if (!$pdo) {
            $error_msg = "Error connecting to database.";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM User WHERE username=:username and password=:password");
            $stmt->execute([':username' => $username, ':password' => $password]);
            if (!$stmt->execute()) {
                $error_msg = "Error executing query.";
            } else {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $row['role'];

                    // Set cookie if remember me is checked
                    if (isset($_POST['remember_me'])) {
                        setcookie('username', $row['username'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                        setcookie('password', $row['password'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                    }

                    if ($row['role'] == 'receptionist') {
                        header('Location: receptionist_dashboard.php');
                        exit();
                    } else {
                        $error_msg = "Unknown user role";
                    }
                } else {
                    $error_msg = "Incorrect username or password";
                }
            }
        }
    }
}
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1 align='center'>Login</h1>
    <form method="post" action="<?php echo sanitize($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
        <center>
            <fieldset align='center'>
                <legend>Login Information</legend>
                <?php
                if ($error_msg != '') {
                    echo "<p align='center'>$error_msg</p>";
                }
                ?>
                <div id="error_messages">
                    <?php if (!empty($errors)) : ?>
                        <div class="error">
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <?= $error ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <br>
                <input type='checkbox' name='remember_me' value='1'>Remember Me
                <br>
                <input type="submit" name="submit" value="Login">
                <input type="reset" value="Reset">
                <p align='center'>Forget Password? Click <a href="forget_password.php">Here</a></p>
                <p align='center'>Don't have an account? Register <a href="registration.php">Here</a></p>
            </fieldset>
        </center>
    </form>

    <script>
        function validateForm() {
            // Get form inputs
            var username = document.forms[0]["username"].value;
            var password = document.forms[0]["password"].value;

            // Clear previous error messages
            document.getElementById("error_messages").innerHTML = "";

            // Perform validation
            var errors = [];
            if (username === "") {
                errors.push("Please enter a username.");
            }
            if (password === "") {
                errors.push("Please enter a password.");
            }

            // Display error messages
            if (errors.length > 0) {
                var errorHtml = '<div class="error"><ul>';
                for (var i = 0; i < errors.length; i++) {
                    errorHtml += errors[i] + '<br>';
                }
                errorHtml += '</ul></div>';
                document.getElementById("error_messages").innerHTML = errorHtml;
                return false; // prevent form submission
            } else {
                return true; // allow form submission
            }
        }
    </script>
</body>

</html>
<?php
include "footer.php";
?>