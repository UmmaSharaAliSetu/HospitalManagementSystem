<?php 
include '../Controller/billing_controller.php';
include '../Model/billing_model.php';
include 'header.php';
include 'menu.php';
?>
<td>
    <fieldset>
        <legend>Billing Information</legend>
        <h2 align='center'>Billing Information</h2>
        <table align="center" border='1'>
            <thead>
                <tr>
                    <th>Billing ID</th>
                    <th>Patient ID</th>
                    <th>Appointment ID</th>
                    <th>Bill Date</th>
                    <th>Bill Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($billings as $billing): ?>
                    <tr>
                        <td>
                            <?php echo $billing['billing_id']; ?>
                        </td>
                        <td>
                            <?php echo $billing['patient_id']; ?>
                        </td>
                        <td>
                            <?php echo $billing['appointment_id']; ?>
                        </td>
                        <td>
                            <?php echo $billing['bill_date']; ?>
                        </td>
                        <td>
                            <?php echo $billing['bill_amount']; ?>
                        </td>
                        <td>
                            <?php echo $billing['payment_status']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table align="center">
            <tr>
                <td>
                    <button><a href="add_new_bill.php">Add New Bill</a></button>
                    <button><a href="edit_bill.php">Edit Bill Information</a></button>
                </td>
            </tr>
        </table>
    </fieldset>
</td>
</table>
<?php include 'footer.php'; ?>