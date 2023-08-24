<?php

session_start();
require("../../Config/connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../sources/img/php.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../sources/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../sources/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Recovery Password</title>
</head>
<body class="bg-secondary bg-opacity-25">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Change Password</h3>
                    </div>
                    <div class="card-body">
                    <?php
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];

                        $sqlCheckToken = "SELECT * FROM tokens WHERE token_code = '$token'";
                        $tokenResult = $connection->query($sqlCheckToken);

                        if ($tokenResult->num_rows === 1) {
                            if (isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> ' . $_SESSION['error'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                unset($_SESSION['error']);
                            }

                            echo '
                            <form action="updatePassword.php" method="POST">
                                <input type="hidden" name="token" value="' . $token . '">
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                </div>
                                <div class="form-group py-3">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info">Change Password</button>
                                </div>
                            </form>';
                        } else {
                            echo '<p class="text-danger text-center">Invalid token. Please check the link or request a new one.</p>';
                        }
                    } else {
                        echo '<p class="text-danger text-center">Token not provided.</p>';
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../sources/js/bootstrap.min.js"></script>
    <script src="../../sources/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>