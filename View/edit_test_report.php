<?php
include '../Model/edit_test_report_model.php';
include '../Controller/edit_test_report_controller.php';
include 'header.php';
include 'menu.php'
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
            <legend>Load Test Result Information</legend>
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
            <label for="test_result_id">Enter Test Result ID:</label>
            <input type="text" id="test_result_id" name="test_result_id" value="<?php echo $test_result_id; ?>">
            <button type="submit" name="load" value="load">Load Information</button>
        </fieldset>
    </form>
    <br>
    <form method="post">
        <fieldset>
            <legend>Test Result Information</legend>
            <input type="hidden" id="test_result_id" name="test_result_id" value="<?php echo $test_result_id; ?>" readonly><br>

            <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"><br>

            <label for="test_name">Test Name:</label>
            <input type="text" id="test_name" name="test_name" value="<?php echo $test_name; ?>"><br>

            <label for="test_date">Test Date:</label>
            <input type="date" id="test_date" name="test_date" value="<?php echo $test_date; ?>"><br>

            <label for="test_result">Test Result:</label>
            <input type="text" id="test_result" name="test_result" value="<?php echo $test_result; ?>"><br>

            <br>
            <button type="submit" name="update" value="update">Update Appointment</button>
            <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this Test Result?')">Delete Test
                Result</button>
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm() {
        // Get form inputs
        var billingId = document.forms[0]["test_result_id"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (billingId.trim() === "") {
            errors.push("Please enter a test result ID.");
        } else if (!(/^\d+$/.test(billingId))) {
            errors.push("Test result ID must be a number.");
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