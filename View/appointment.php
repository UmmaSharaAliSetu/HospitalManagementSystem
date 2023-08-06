<?php
include '../Model/appointment_model.php';
include '../Controller/appointment_controller.php';
include 'header.php';
include 'menu.php';
?>

<td>
    <fieldset>
        <legend>Appointment Information</legend>
        <h2 align='center'>Appointment Information</h2>
        <table align="center" border='1'>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Doctor ID</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Appointment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                    <td>
                            <?php echo $appointment['appointment_id']; ?>
                        </td>
                        <td>
                            <?php echo $appointment['patient_id']; ?>
                        </td>
                        <td>
                            <?php echo $appointment['doctor_id']; ?>
                        </td>
                        <td>
                            <?php echo $appointment['appointment_date']; ?>
                        </td>
                        <td>
                            <?php echo $appointment['appointment_time']; ?>
                        </td>
                        <td>
                            <?php echo $appointment['appointment_status']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table align="center">
            <tr>
                <td>
                    <button><a href="schedule_appointment.php">Schedule New Appointment</a></button>
                    <button><a href="edit_appointment.php">Edit Appointment</a></button>
                </td>
            </tr>
        </table>
    </fieldset>
</td>
</table>

<?php include 'footer.php'; ?>