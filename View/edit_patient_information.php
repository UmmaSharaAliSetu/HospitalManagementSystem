<?php
include '../Model/edit_patient_information_model.php';
include '../Controller/edit_patient_information_controller.php';
include 'header.php';
include 'menu.php'
?>

<td>
    <form method="post" onsubmit="return validateForm1();">
        <fieldset>
            <legend>Load Patient Information</legend>
            <?php if (!empty($loaderr)) : ?>
                <p>
                    <?= $loaderr ?>
                </p>
            <?php endif; ?>
            <div id="error_messages">
                <?php if (!empty($errors)) : ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li>
                                    <?= $error ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>">
            <button type="submit" name="load" value="load">Load Info</button>
        </fieldset>
    </form>
    <br>
    <form method="post" onsubmit="return validateForm2();">
        <fieldset>
            <legend>Patient Information</legend>
            <div id="error_message">
                <?php if (!empty($errors)) : ?>
                    <div class="error">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li>
                                    <?= $error ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>"><br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>"><br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>"><br>
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="Male" <?php if ($gender == 'male')
                                                                            echo 'checked'; ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female" <?php if ($gender == 'female')
                                                                                echo 'checked'; ?>>
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="Other" <?php if ($gender == 'other')
                                                                            echo 'checked'; ?>>
            <label for="other">Other</label><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>"><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
            <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"><br>
            <button type="submit" name="update" value="update">Update Information</button>
            <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this patients information?')">Delete Patient</button>
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm1() {
        // Get form inputs
        var billingId = document.forms[0]["patient_id"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (billingId.trim() === "") {
            errors.push("Please enter a patient ID.");
        } else if (!(/^\d+$/.test(billingId))) {
            errors.push("Patient ID must be a number.");
        }

        // Display error messages
        if (errors.length > 0) {
            var errorHtml = '<div class="error"><ul>';
            for (var i = 0; i < errors.length; i++) {
                errorHtml += '<li>' + errors[i] + '</li>';
            }
            errorHtml += '</ul></div>';
            document.getElementById("error_messages").innerHTML = errorHtml;
            return false; // prevent form submission
        } else {
            return true; // allow form submission
        }
    }

    function validateForm2() {
        // Get form inputs
        var firstName = document.forms[1]["first_name"].value;
        var lastName = document.forms[1]["last_name"].value;
        var dateOfBirth = document.forms[1]["date_of_birth"].value;
        var address = document.forms[1]["address"].value;
        var phone = document.forms[1]["phone"].value;
        var email = document.forms[1]["email"].value;

        // Clear previous error messages
        document.getElementById("error_message").innerHTML = "";

        // Perform validation
        var errors = [];
        if (firstName.trim() === "") {
            errors.push("Please enter a first name.");
        }
        if (lastName.trim() === "") {
            errors.push("Please enter a last name.");
        }
        if (dateOfBirth.trim() === "") {
            errors.push("Please enter a date of birth.");
        }
        if (address.trim() === "") {
            errors.push("Please enter an address.");
        }
        if (phone.trim() === "") {
            errors.push("Please enter a phone number.");
        } else if (!(/^\d+$/.test(phone))) {
            errors.push("Phone number must be numeric.");
        }
        if (email.trim() === "") {
            errors.push("Please enter an email.");
        } else if (!validateEmail(email)) {
            errors.push("Please enter a valid email.");
        }

        // Display error messages
        if (errors.length > 0) {
            var errorHtml = '<div class="error"><ul>';
            for (var i = 0; i < errors.length; i++) {
                errorHtml += '<li>' + errors[i] + '</li>';
            }
            errorHtml += '</ul></div>';
            document.getElementById("error_message").innerHTML = errorHtml;
            return false; // prevent form submission
        } else {
            return true; // allow form submission
        }
    }

    // Email validation function
    function validateEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
</script>

<?php
include 'footer.php';
?>