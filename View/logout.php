<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['role']);
session_destroy();
setcookie('username', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');
header('Location: index.php');
exit();
?>
