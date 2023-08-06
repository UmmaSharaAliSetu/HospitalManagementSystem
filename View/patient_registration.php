<?php
include '../Controller/patient_registration_controller.php';
include '../Model/patient_registration_model.php';
include 'header.php';
include 'menu.php';
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
            <legend>Patient Information</legend>
            <h2 align='center'>Patient Registration</h2>
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
            <?php if (isset($message)) : ?>
                <p>
                    <?= $message ?>
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
            <label for="doctor_id">Doctor ID:</label>
            <input type="text" name="doctor_id" id="doctor_id">
            <br><br>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name">
            <br><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name">
            <br><br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth">
            <br><br>
            <label for="gender">Gender:</label>
            <label><input type="radio" name="gender" value="Male">Male</label>
            <label><input type="radio" name="gender" value="Female">Female</label>
            <label><input type="radio" name="gender" value="Other">Other</label>
            <br><br>
            <label for="address">Address:</label>
            <textarea name="address" id="address"></textarea>
            <br><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone">
            <br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <br><br>
            <input type="submit" name="submit" value="Register Patient">
            <input type="reset" value="Reset">
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm() {
        // Get form inputs
        var doctorId = document.forms[0]["doctor_id"].value;
        var firstName = document.forms[0]["first_name"].value;
        var lastName = document.forms[0]["last_name"].value;
        var dob = document.forms[0]["date_of_birth"].value;
        var gender = document.forms[0]["gender"].value;
        var address = document.forms[0]["address"].value;
        var phone = document.forms[0]["phone"].value;
        var email = document.forms[0]["email"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (doctorId === "") {
            errors.push("Please enter a doctor ID.");
        } else if (!(/^\d+$/.test(doctorId))) {
            errors.push("Doctor ID must be a number.");
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

        if (email === "") {
            errors.push("Please enter an email address.");
        } else if (!(/\S+@\S+\.\S+/.test(email))) {
            errors.push("Please enter a valid email address.");
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
</script>
<?php
include 'footer.php';
?>