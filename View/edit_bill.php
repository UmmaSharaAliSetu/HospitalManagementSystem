<?php
include '../Model/edit_bill_model.php';
include '../Controller/edit_bill_controller.php';
include 'header.php';
include 'menu.php'
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
            <legend>Load Billing Information</legend>
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
            <label for="billing_id">Enter Billing ID:</label>
            <input type="text" id="billing_id" name="billing_id" value="<?php echo $billing_id; ?>">
            <button type="submit" name="load" value="load">Load Information</button>
        </fieldset>
    </form>
    <br>
    <form method="post">
        <fieldset>
            <legend>Billing Information</legend>
            <input type="hidden" id="billing_id" name="billing_id" value="<?php echo $billing_id; ?>" readonly><br>

            <label for="patient_id">Patient ID:</label>
            <input type="number" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"><br>

            <label for="appointment_id">Appointment ID:</label>
            <input type="number" id="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>"><br>

            <label for="bill_date">Bill Date:</label>
            <input type="date" id="bill_date" name="bill_date" value="<?php echo $bill_date; ?>"><br>

            <label for="bill_amount">Test Result:</label>
            <input type="number" id="bill_amount" name="bill_amount" value="<?php echo $bill_amount; ?>"><br>

            <label for="payment_status">Payment Status:</label>
            <select id="payment_status" name="payment_status">
                <option value="paid" <?php if ($payment_status == 'paid') {
                                            echo ' selected';
                                        } ?>>Paid</option>
                <option value="unpaid" <?php if ($payment_status == 'unpaid') {
                                            echo ' selected';
                                        } ?>>Unpaid</option>
            </select><br>
            <br>
            <button type="submit" name="update" value="update">Update Billing Information</button>
            <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this Billing Information?')">Delete Billing
                Information</button>
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm() {
        // Get form inputs
        var billingId = document.forms[0]["billing_id"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (billingId.trim() === "") {
            errors.push("Please enter a billing ID.");
        } else if (!(/^\d+$/.test(billingId))) {
            errors.push("Billing ID must be a number.");
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