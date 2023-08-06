<?php
include '../Model/add_new_bill_model.php';
include '../Controller/add_new_bill_controller.php';
include 'header.php';
include 'menu.php';
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
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
            <label for="patient_id">Patient ID:</label>
            <input type="number" name="patient_id" id="patient_id" value="<?php echo $patient_id; ?>">
            <br><br>
            <label for="appointment_id">Appointment ID:</label>
            <input type="number" name="appointment_id" id="appointment_id" value="<?php echo $appointment_id; ?>">
            <br><br>
            <label for="bill_date">Bill Date:</label>
            <input type="date" name="bill_date" id="bill_date" value="<?php echo $bill_date; ?>">
            <br><br>
            <label for="bill_amount">Bill Amount:</label>
            <input type="number" name="bill_amount" id="bill_amount" value="<?php echo $bill_amount; ?>">
            <br><br>
            <label for="payment_status">Payment Status:</label>
            <select name="payment_status" id="payment_status">
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Add New Bill">
            <input type="reset" value="Reset">
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm() {
        // Get form inputs
        var patientId = document.forms[0]["patient_id"].value;
        var appointmentId = document.forms[0]["appointment_id"].value;
        var billDate = document.forms[0]["bill_date"].value;
        var billAmount = document.forms[0]["bill_amount"].value;
        var paymentStatus = document.forms[0]["payment_status"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (patientId == "") {
            errors.push("Please enter a Patient ID.");
        }
        if (appointmentId == "") {
            errors.push("Please enter an Appointment ID.");
        }
        if (billDate == "") {
            errors.push("Please select a Bill Date.");
        }
        if (billAmount == "") {
            errors.push("Please enter a Bill Amount.");
        } else if (isNaN(billAmount) || billAmount <= 0) {
            errors.push("Please enter a valid positive number for Bill Amount.");
        }
        if (paymentStatus == "") {
            errors.push("Please select a Payment Status.");
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