<?php
include '../Controller/forget_password_controller.php';
//include '../Model/forget_password_model.php';
include 'header.php';
?>
<h1 align='center'>Forget Password</h1>
<fieldset>
    <legend>Forget Password</legend>
    <?php if (isset($error)) : ?>
        <p align='center'>
            <?php echo $error; ?>
        </p>
    <?php endif; ?>
    <?php if (isset($success)) : ?>
        <p align='center'>
            <?php echo $success; ?>
        </p>
    <?php endif; ?>
    <div id="error_messages">
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <ul >
                    <?php foreach ($errors as $error) : ?>
                        <li style="text-align: center;">
                            <?= $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <form method="post" onsubmit="return validateForm();">
        <div align='center'>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <br>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</fieldset>

<script>
    function validateForm() {
        // Get form inputs
        var email = document.forms[0]["email"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (email.trim() === "") {
            errors.push("Please enter an email address.");
        } else if (!validateEmail(email)) {
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

    // Email validation function
    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
</script>
<?php
include 'footer.php';
?>