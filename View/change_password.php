<?php
include '../Model/change_password_model.php';
include '../Controller/change_password_controller.php';

include 'header.php';
include 'menu.php';
?>
<td>
    <fieldset>
        <legend>Change Password</legend>
        <h2 align='center'>Change Password</h2>
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
        <form method="post" action="change_password.php" onsubmit="return validateForm();">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password"><br>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password"><br>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password"><br>

            <input type="submit" value="Change Password">
            <input type="reset" value="Reset">
        </form>
    </fieldset>
</td>
</table>

<script>
    function validateForm() {
        // Get form inputs
        var currentPassword = document.forms[0]["current_password"].value;
        var newPassword = document.forms[0]["new_password"].value;
        var confirmNewPassword = document.forms[0]["confirm_password"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (currentPassword === "") {
            errors.push("Please enter your current password.");
        }
        if (newPassword === "") {
            errors.push("Please enter a new password.");
        } else if (newPassword.length < 6) {
            errors.push("New password must be at least 6 characters long.");
        }
        if (confirmNewPassword === "") {
            errors.push("Please confirm your new password.");
        } else if (confirmNewPassword !== newPassword) {
            errors.push("New password and confirm password do not match.");
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