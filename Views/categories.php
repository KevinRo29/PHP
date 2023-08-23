<?php
session_start();

if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("location: ../login.php");
    exit();
}

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
    <title>Categories</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <h1 class="navbar-brand">PHP</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item d-flex d-lg-none">
                        <a class="nav-link text-danger" href="../Controller/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-block">
                <a href="../Controller/logout.php" class="btn btn-danger btn-sm" style="width: 100px;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row pt-5 pb-4">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Categories</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Add Category</h6>
                        <form action="../Controller/Categories/register_category.php" method="POST">
                        <?php
                            if (isset($_SESSION['error'])) {
                                foreach ($_SESSION['error'] as $errorMessage) {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $errorMessage .
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                }
                                unset($_SESSION['error']);
                            }

                            if (isset($_SESSION['success'])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['success'] .
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                unset($_SESSION['success']);
                            }
                        ?>
                            <div class="row py-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="categoryName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Insert the name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="categoryDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Insert the description" required style="max-height: 200px;"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success mt-3 btn-sm" id="btnAddCategory" name="btnAddCategory">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                <div class="table-responsive" style="max-height: 500px;">
                    <table class="table table-striped align-middle table-success table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                require ("../Config/connection.php");
                                $sql = $connection -> query("SELECT * FROM categories WHERE category_status = 1");

                                while($data = $sql -> fetch_object()){
                            ?>
                                <tr>
                                    <td><?= $data -> category_name ?></td>
                                    <td><?= $data -> category_description ?></td>
                                    <td><?= $data -> category_date ?></td>
                                    <td class="text-center">
                                        <a href="../Controller/Categories/edit_category.php?id=<?= $data -> category_id ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm btn-delete-category" data-category-id="<?= $data->category_id ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../sources/js/bootstrap.min.js"></script>
    <script src="../sources/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>