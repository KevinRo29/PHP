<?php
session_start();
 
require("../../Config/connection.php");
require("../../Sendgrid-PHP/sendgrid-php.php");

$emailRecoveryPassword = $_POST['emailRecoveryPassword'];

$errors = array();

$sqlCheckEmail = "SELECT COUNT(*) as count, user_id FROM users WHERE user_email = '$emailRecoveryPassword'";
$result = $connection->query($sqlCheckEmail);
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $errors['email'] = "Email not found";
    $_SESSION['message'] = "Email not found";
    $_SESSION['message_type'] = "danger";
    header("Location: ../../Views/recoveryPassword.php");
    exit();
} else {
    $userId = $row['user_id'];

    //Token with 32 characters
    $token = bin2hex(random_bytes(16));
    
    $sqlInsertToken = "INSERT INTO tokens (token_user, token_code) VALUES ('$userId', '$token')";
    $connection->query($sqlInsertToken);
    
    $resetLink = "https://localhost/PHP/Controller/Password/changePassword.php?token=$token";

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("kevinro0829@gmail.com", "Kevin Romero");
    $email->setSubject("Password Recovery");
    $email->addTo($emailRecoveryPassword, "User");
    $email->addContent("text/plain", "This is a email for password recovery");
    $email->addContent(
        "text/html", "
        <div>
            <h2>Password Recovery</h2>
            <p>Hello,</p>
            <p>This is an email for password recovery. Please click the link below to reset your password:</p>
            <a href='$resetLink'>Reset Password</a>
            <p>If you didn't request a password reset, you can ignore this email.</p>
            <p>Best regards,<br>Kevin Romero</p>
        </div>
        "
    );

    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        $_SESSION['message'] = "Email sent";
        $_SESSION['message_type'] = "success";
        header("Location: ../../Views/recoveryPassword.php");
        exit();
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
    
}
?>
