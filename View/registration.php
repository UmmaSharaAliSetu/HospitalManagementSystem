<?php
include 'header.php';
include '../Model/config.php';

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Define variables and set to empty values
$usernameErr = $passwordErr = $emailErr = $roleErr = $firstNameErr = $lastNameErr = $date_of_birthErr = $genderErr = $addressErr = $phoneErr = "";
$username = $password = $email = $firstName = $lastName = $date_of_birth = $gender = $address = $phone = "";
$role = "receptionist";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = sanitize($_POST["username"]);
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username=:username");
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $usernameErr = "Username already exists";
        }
    }
    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = sanitize($_POST["password"]);
        // check if password contains at least one uppercase letter, one lowercase letter, one digit, and one special character
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $passwordErr = "Password must be 8 characters long.";
        }
    }
    if (!empty($_POST["password"]) && $passwordErr == "") {
        $password = sanitize($_POST["password"]);
    }
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize($_POST["email"]);
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $emailErr = "Email already exists";
        }
    }
    // Validate first name
    if (empty($_POST["first_name"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = sanitize($_POST["first_name"]);
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = sanitize($_POST["last_name"]);
    }

    // Validate date of birth
    if (empty($_POST["date_of_birth"])) {
        $date_of_birthErr = "Date of birth is required";
    } else {
        $date_of_birth = sanitize($_POST["date_of_birth"]);
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = sanitize($_POST["gender"]);
    }

    // Validate address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = sanitize($_POST["address"]);
    }

    // Validate phone
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = sanitize($_POST["phone"]);
    }

    // If no errors, insert data into user table and appropriate role table
    if (
        $usernameErr == "" && $passwordErr == "" && $emailErr == ""
        && $firstNameErr == "" && $lastNameErr == ""
        && $date_of_birthErr == "" && $genderErr == "" && $addressErr == "" && $phoneErr == ""
    ) {
        // Insert data into user table
        $stmt = $pdo->prepare("INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'role' => $role]);
        // Insert data into  receptionist  table
        $user_id = $pdo->lastInsertId(); // Get last inserted user id
        $stmt = $pdo->prepare("INSERT INTO receptionist (user_id, first_name, last_name, date_of_birth, gender, address, phone) VALUES (:user_id, :first_name, :last_name, :date_of_birth, :gender, :address, :phone)");
        $stmt->execute(['user_id' => $user_id, 'first_name' => $firstName, 'last_name' => $lastName, 'date_of_birth' => $date_of_birth, 'gender' => $gender, 'address' => $address, 'phone' => $phone]);
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    }
}
?>
<h1 align='center'>Registration</h1>
<fieldset>
    <legend>Register</legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
        <div align='center'>
            <span class="error">
                <?php
                $errors = array($usernameErr, $passwordErr, $emailErr, $firstNameErr, $lastNameErr, $date_of_birthErr, $genderErr, $addressErr, $phoneErr);
                foreach ($errors as $error) {
                    if (isset($error) && !empty($error)) {
                        echo '<br>' . $error;
                    }
                }
                ?>
            </span>
            <br>
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
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <br>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $firstName; ?>">
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $lastName; ?>">
            <br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
            <br>
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male" <?php if (isset($gender) && $gender == "male")
                                                                            echo "checked"; ?>>Male
            <input type="radio" id="female" name="gender" value="female" <?php if (isset($gender) && $gender == "female")
                                                                                echo "checked"; ?>>Female
            <input type="radio" id="other" name="gender" value="other" <?php if (isset($gender) && $gender == "other")
                                                                            echo "checked"; ?>>Other
            <br>
            <label for="address">Address:</label>
            <textarea id="address" name="address"><?php echo $address; ?></textarea>
            <br>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
            <br>
            <br>
            <input type="submit" value="Register">
            <input type="reset" value="Reset">
        </div>
    </form>
    <p align='center'>Already have an account? Login <a href="login.php">Here</a></p>
</fieldset>
<script>
    function validateForm() {
        // Get form inputs
        var username = document.forms[0]["username"].value;
        var password = document.forms[0]["password"].value;
        var email = document.forms[0]["email"].value;
        var firstName = document.forms[0]["first_name"].value;
        var lastName = document.forms[0]["last_name"].value;
        var dob = document.forms[0]["date_of_birth"].value;
        var gender = document.forms[0]["gender"].value;
        var address = document.forms[0]["address"].value;
        var phone = document.forms[0]["phone"].value;

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

        if (email === "") {
            errors.push("Please enter an email address.");
        } else if (!(/\S+@\S+\.\S+/.test(email))) {
            errors.push("Please enter a valid email address.");
        }

        if (firstName === "") {
            errors.push("Please enter a first name.");
        }

        if (lastName === "") {
            errors.push("Please enter a last name.");
        }

        if (dob === "") {
            errors.push("Please enter a date of birth.");
        }

        if (gender === "") {
            errors.push("Please select a gender.");
        }

        if (address === "") {
            errors.push("Please enter an address.");
        }

        if (phone === "") {
            errors.push("Please enter a phone number.");
        } else if (!(/^\d+$/.test(phone))) {
            errors.push("Phone number must be a number.");
        }

        // Display error messages
        if (errors.length > 0) {
            var errorHtml = '<div class="error"><ul>';
            for (var i = 0; i < errors.length; i++) {
                errorHtml += errors[i] + '<br> <br>';
            }
            errorHtml += '</ul></div>';
            document.getElementById("error_messages").innerHTML = errorHtml;
            return false; // prevent form submission
        } else {
            return true; // allow form submission
        }
    }
</script>

<?php
include 'footer.php';
?>