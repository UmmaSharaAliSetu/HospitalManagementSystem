<?php
include '../Controller/add_test_report_controller.php';
include '../Model/add_test_report_model.php';
include 'header.php';
include 'menu.php';
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
            <legend>Add Test Result</legend>
            <h2 align='center'>Add Test Result</h2>
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
            <div>
                <label for="patient_id">Patient ID:</label>
                <input type="text" name="patient_id" id="patient_id">
                <br><br>
                <label for="test_name">Test Name:</label>
                <input type="text" name="test_name" id="test_name">
                <br><br>
                <label for="test_date">Test Date:</label>
                <input type="date" name="test_date" id="test_date">
                <br><br>
                <label for="test_result">Test Result:</label>
                <input type="text" name="test_result" id="test_result">
                <br><br>
                <input type="submit" name="submit" value="Add Test Result">
                <input type="reset" value="Reset">
            </div>
        </fieldset>
    </form>
</td>
</table>

<script>
    function validateForm() {
        // Get form inputs
        var patientId = document.forms[0]["patient_id"].value;
        var testName = document.forms[0]["test_name"].value;
        var testDate = document.forms[0]["test_date"].value;
        var testResult = document.forms[0]["test_result"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (patientId.trim() === "") {
            errors.push("Please enter a Patient ID.");
        }
        if (testName.trim() === "") {
            errors.push("Please enter a Test Name.");
        }
        if (testDate.trim() === "") {
            errors.push("Please select a Test Date.");
        }
        if (testResult.trim() === "") {
            errors.push("Please enter a Test Result.");
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