<?php
function getTestResultById($test_result_id) {
    require 'config.php';
    // Query database for test result with matching ID
    $stmt = $pdo->prepare('SELECT * FROM test_results WHERE test_result_id = ?');
    $stmt->execute([$test_result_id]);
    $test_result = $stmt->fetch();
    
    return $test_result;
}
function updateTestResult($patient_id, $test_name, $test_date, $test_result, $test_result_id) {
    require 'config.php';
    // Prepare and execute the SQL query to update the test_result record
    $stmt = $pdo->prepare("UPDATE test_results SET patient_id = ?, test_name = ?, 
          test_date = ?, test_result = ? 
          WHERE test_result_id = ?");
    $stmt->execute([$patient_id, $test_name, $test_date, $test_result, $test_result_id]);
}
function deleteTestResult($test_result_id) {
    require 'config.php';
    $stmt = $pdo->prepare("DELETE FROM test_results WHERE test_result_id = ?");
    $stmt->execute([$test_result_id]);

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the test_result list page
        header('Location: test_result.php');
        exit;
    } else {
        // Display an error message
        echo "Error deleting test result.";
    }
}

?>