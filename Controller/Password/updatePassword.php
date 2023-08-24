<?php

session_start();
include '../../config/connection.php';

$tokenCode = $_POST['token'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if ($newPassword != $confirmPassword) {
    $_SESSION['error'] = "The passwords don't match";
    header("Location: changePassword.php?token=$tokenCode");
}

$sqlGetUserId = "SELECT token_user FROM tokens WHERE token_code = '$tokenCode'";
$result = $connection->query($sqlGetUserId);
$row = $result->fetch_assoc();
$userId = $row['token_user'];

$sqlGetUser = "SELECT * FROM users WHERE user_id = '$userId'";
$result = $connection->query($sqlGetUser);
$row = $result->fetch_assoc();

if ($row) {
    $sqlUpdatePassword = "UPDATE users SET user_password = '$newPassword' WHERE user_id = '$userId'";
    $result = $connection->query($sqlUpdatePassword);
    if ($result) {
        $sqlDeleteToken = "DELETE FROM tokens WHERE token_code = '$tokenCode'";
        $result = $connection->query($sqlDeleteToken);

        $_SESSION['success'] = "Password updated successfully";
        header("Location: ../../login.php");
    } else {
        $_SESSION['error'] = "Error updating the password";
        header("Location: changePassword.php?token=$tokenCode");
    }
} else {
    $_SESSION['error'] = "User not found";
    header("Location: changePassword.php?token=$tokenCode");
}
?>