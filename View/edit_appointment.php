<?php
include '../Model/edit_appointment_model.php';
include '../Controller/edit_appointment_controller.php';
include 'header.php';
include 'menu.php'
?>

<td>
    <form method="post" onsubmit="return validateForm();">
        <fieldset>
            <legend>Load Appointment Information</legend>
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
            <label for="appointment_id">Enter Appointment ID:</label>
            <input type="text" id="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>">
            <button type="submit" name="load" value="load">Load Information</button>
        </fieldset>
    </form>
    <br>
    <form method="post">
        <fieldset>
            <legend>Appointment Information</legend>
            <label for="appointment_id">Appointment ID:</label>
            <input type="text" id="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>"><br>

            <label for="doctor_id">Doctor ID:</label>
            <input type="text" id="doctor_id" name="doctor_id" value="<?php echo $doctor_id; ?>"><br>

            <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"><br>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointment_date; ?>"><br>

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $appointment_time; ?>"><br>
            <label for="appointment_status">Appointment Status:</label>
            <select id="appointment_status" name="appointment_status">
                <option value="rescheduled" <?php if ($appointment_status == 'rescheduled')
                                                echo 'selected'; ?>>Reschedule
                </option>
                <option value="Cancelled" <?php if ($appointment_status == 'Cancelled')
                                                echo 'selected'; ?>>Cancel
                </option>
            </select><br>
            <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>">
            <button type="submit" name="update" value="update">Update Appointment</button>
            <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this Appointment?')">Delete
                Appointment</button>
        </fieldset>
    </form>
</td>
</table>

<script>
    function validateForm() {
        // Get form inputs
        var appointmentId = document.forms[0]["appointment_id"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (appointmentId === "") {
            errors.push("Please enter an appointment ID.");
        } else if (!(/^\d+$/.test(appointmentId))) {
            errors.push("Appointment ID must be a number.");
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