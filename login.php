<?php

session_start();

if (isset($_SESSION['is_active']) && $_SESSION['is_active'] === true) {
    header("location: Views/products.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="sources/img/php.ico" type="image/x-icon">
    <link rel="stylesheet" href="sources/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sources/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>PHP Project</title>
</head>
<body class="bg-secondary bg-opacity-25">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-0 col-sm-0 col-md-0 col-lg-7 col-xl-6 col-xxl-6 d-none d-lg-block text-center">
                <img src="sources/img/login.jpg" class="img-fluid rounded-3" alt="login" style="height: 80vh;">
            </div>
            <div class="col-12 col-sm-12 col-md-10 col-lg-5 col-xl-6 col-xxl-6">
                <div class="card border border-black shadow">
                    <div class="d-flex flex-column align-items-center py-2">
                        <img src="sources/img/user_login.png" class="card-img-top" alt="login" style="width: 150px; ">
                        <h2>Welcome!</h2>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10">
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible mt-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <?= $_SESSION['error']; ?>
                                </div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="Controller/AuthController.php" method="POST">
                            <div class="mb-3">
                                <label for="emailLogin" class="form-label">Email</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="emailLogin" name="emailLogin" placeholder="Insert your email">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="passwordLogin" class="form-label">Password</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Insert your password">
                                </div>
                            </div>
                            <div class="mb-3 text-end">
                                <a href="Views/recoveryPassword.php" class="text-decoration-none">Forgot your password?</a>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary rounded-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="sources/js/bootstrap.min.js"></script>
    <script src="sources/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>