<?php

$db_host = "localhost";
$db_name = "db_hms"; 
$db_user = "root"; 
$db_pass = ""; 

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the following line to display detailed error messages during development
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>
