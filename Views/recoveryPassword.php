<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../sources/img/php.ico" type="image/x-icon">
    <link rel="stylesheet" href="../sources/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Recovery Password</title>
</head>
<body class="bg-secondary bg-opacity-25">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-12 col-sm-12 col-md-10 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card">
                    <div class="card-header">
                        <a href="../login.php" class="text-decoration-none text-info">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-center">Insert your email</h5>
                        <?php
                        if (isset($_SESSION['message'])) {
                            $message = $_SESSION['message'];
                            $messageType = $_SESSION['message_type'];

                            echo "<div class='alert alert-$messageType alert-dismissible fade show' role='alert'>$message
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                            unset($_SESSION['message']);
                            unset($_SESSION['message_type']);
                        }
                        ?>
                        <form action="../Controller/Password/sendEmailRecovery.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="emailRecoveryPassword" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailRecoveryPassword" name="emailRecoveryPassword" placeholder="Insert your email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info rounded-3">Send Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../sources/js/bootstrap.min.js"></script>
    <script src="../sources/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>