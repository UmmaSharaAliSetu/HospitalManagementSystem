<?php 
include '../Controller/test_result_controller.php';
include '../Model/test_result_model.php';
include 'header.php';
include 'menu.php';
?>
<td>
    <fieldset>
        <legend>Test Results Information</legend>
        <h2 align='center'>Test Results Information</h2>
        <table align="center" border='1'>
            <thead>
                <tr>
                    <th>Test Result ID</th>
                    <th>Patient ID</th>
                    <th>Test Name</th>
                    <th>Test Date</th>
                    <th>Test Result</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($test_results as $test_result): ?>
                    <tr>
                    <td>
                            <?php echo $test_result['test_result_id']; ?>
                        </td>
                        <td>
                            <?php echo $test_result['patient_id']; ?>
                        </td>
                        <td>
                            <?php echo $test_result['test_name']; ?>
                        </td>
                        <td>
                            <?php echo $test_result['test_date']; ?>
                        </td>
                        <td>
                            <?php echo $test_result['test_result']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table align="center">
            <tr>
                <td>
                    <button><a href="add_test_report.php">Add New Test Report</a></button>
                    <button><a href="edit_test_report.php">Edit Test Report</a></button>
                </td>
            </tr>
        </table>
    </fieldset>
</td>
</table>

<?php include 'footer.php'; ?>