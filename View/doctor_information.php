<?php 
include '../Controller/doctor_information_controller.php';
include '../Model/doctor_information_model.php';
include 'header.php';
include 'menu.php';
?>
<td>
    <fieldset>
        <legend>Doctor Information</legend>
        <h2 align='center'>Available Doctor</h2>
        <table align="center" border='1'>
            <thead>
                <tr>
                    <th>Doctor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctors as $doctor): ?>
                    <tr>
                        <td>
                            <?php echo $doctor['doctor_id']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['date_of_birth']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['gender']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['address']; ?>
                        </td>
                        <td>
                            <?php echo $doctor['phone']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
</td>
</table>


<?php include 'footer.php'; ?>