<?php
function getCurrentPassword($username) {
    require 'config.php';
    $stmt = $pdo->prepare('SELECT `password` FROM `user` WHERE `username` = ?');
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentPassword = $row['password'];
    return $currentPassword;
}
function updatePassword($username, $newPassword) {
    require 'config.php';
    $stmt = $pdo->prepare('UPDATE user SET password = ? WHERE username = ?');
    $stmt->execute([$newPassword, $username]);
}
?>
