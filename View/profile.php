<?php
session_start(); // Start the session to access session variables
include 'header.php';
// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit();
}

// Include the database connection file
include '../Model/config.php';

$update_success = false; // variable to check if update was successful

try {
    // Retrieve user information from the user table
    $username = $_SESSION["username"];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_id = $row["user_id"];
    $email = $row["email"];
    $role = $row["role"];
    $stmt = $pdo->prepare("SELECT * FROM receptionist WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $date_of_birth = $row["date_of_birth"];
    $gender = $row["gender"];
    $address = $row["address"];
    $phone = $row["phone"];

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Update user information if form is submitted
if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Prepare the update statement based on the role

    $stmt = $pdo->prepare("UPDATE receptionist SET first_name=?, last_name=?, date_of_birth=?, gender=?, address=?, phone=? WHERE user_id=?");
    $stmt->execute([$first_name, $last_name, $date_of_birth, $gender, $address, $phone, $user_id]);

    // Update the email field in the user table
    $stmt_user = $pdo->prepare("UPDATE user SET email=? WHERE user_id=?");
    $stmt_user->execute([$email, $user_id]);

    if ($stmt->rowCount() > 0 || $stmt_user->rowCount() > 0) {
        $update_success = true;
    }
}
include 'menu.php';
?>

<td>
    <fieldset>
        <legend>Update and View Profile Page</legend>
        <h2 align='center'>Profile Page</h2>
        <?php if ($update_success) { // Show success message if update was successful ?>
            <p align='center'>Profile updated successfully!</p>
        <?php } ?>
        <form method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>"
                required><br><br>

            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male" <?php if ($gender == "male")
                echo "checked"; ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php if ($gender == "female")
                echo "checked"; ?>>
            <label for="female">Female</label>
            <input type="radio" id="others" name="gender" value="others" <?php if ($gender == "others")
                echo "checked"; ?>>
            <label for="others">Other</label><br><br>

            <label for="address">Address</label>
            <textarea id="address" name="address" required><?php echo $address; ?></textarea><br><br>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required><br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </fieldset>
</td>
</table>

<?php include 'footer.php'; ?>