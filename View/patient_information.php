<?php 
include '../Controller/patient_information_controller.php';
include '../Model/patient_information_model.php';
include 'header.php';
include 'menu.php';
?>
<td>
    <fieldset>
        <legend>Patient Information</legend>
        <h2 align='center'>Patient Information</h2>
        <table align="center" border='1'>
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td>
                            <?php echo $patient['patient_id']; ?>
                        </td>
                        <td>
                            <?php echo $patient['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $patient['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $patient['date_of_birth']; ?>
                        </td>
                        <td>
                            <?php echo $patient['gender']; ?>
                        </td>
                        <td>
                            <?php echo $patient['address']; ?>
                        </td>
                        <td>
                            <?php echo $patient['phone']; ?>
                        </td>
                        <td>
                            <?php echo $patient['email']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table align="center">
            <tr>
                <td>
                    <button><a href="patient_registration.php">Add New Patient</a></button>
                    <button><a href="edit_patient_information.php">Edit Patient Information</a></button>
                </td>
            </tr>
        </table>
    </fieldset>
</td>
</table>

<?php include 'footer.php'; ?>