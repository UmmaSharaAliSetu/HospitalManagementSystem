<?php
include '../Controller/schedule_appointment_controller.php';
include '../Model/schedule_appointment_model.php';
include 'header.php';
include 'menu.php';
?>

<td>
    <form method="post" onsubmit="return validateForm()">
        <fieldset>
            <legend>Scheduled Appointment</legend>
            <h2 align='center'>Scheduled Appointment</h2>
            <div id="error_messages"></div>
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
            <input type="text" name="patient_id">
            <br><br>
            <label for="doctor_id">Doctor ID:</label>
            <input type="text" name="doctor_id">
            <br><br>
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date">
            <br><br>
            <label for="appointment_time">Appointment Time:</label>
            <input type="time" name="appointment_time">
            <br><br>
            <input type="submit" name="submit" value="Schedule Appointment">
            <input type="reset" value="Reset">
        </fieldset>
    </form>
</td>
</table>
<script>
    function validateForm() {
        // Get form inputs
        var doctorId = document.forms[0]["doctor_id"].value;
        var patientId = document.forms[0]["patient_id"].value;
        var appointmentDate = document.forms[0]["appointment_date"].value;
        var appointmentTime = document.forms[0]["appointment_time"].value;

        // Clear previous error messages
        document.getElementById("error_messages").innerHTML = "";

        // Perform validation
        var errors = [];
        if (doctorId === "") {
            errors.push("Please enter a doctor ID.");
        } else if (!(/^\d+$/.test(doctorId))) {
            errors.push("Doctor ID must be a number.");
        }

        if (patientId === "") {
            errors.push("Please enter a patient ID.");
        } else if (!(/^\d+$/.test(patientId))) {
            errors.push("Patient ID must be a number.");
        }

        if (appointmentDate === "") {
            errors.push("Please enter an appointment date.");
        }

        if (appointmentTime === "") {
            errors.push("Please enter an appointment time.");
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