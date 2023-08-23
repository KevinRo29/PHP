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
    <title>Products</title>
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
                        <h5 class="card-title text-center">Products</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Add Product</h6>
                        <form action="../Controller/Products/register_product.php" method="POST">
                        <?php
                            if (isset($_SESSION['error'])) {
                                foreach ($_SESSION['error'] as $errorMessage) {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $errorMessage .
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                }
                                unset($_SESSION['error']);
                            }

                            // Mostrar mensaje de éxito en alerta
                            if (isset($_SESSION['success'])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['success'] .
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                unset($_SESSION['success']);
                            }
                        ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="productCode" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="productCode" name="productCode" placeholder="Insert the code (ABDDMMYYYY12)" required>
                                </div>
                            </div>

                            <div class="row py-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Insert the name" required>
                                </div>
                            </div>

                            <div class="row pb-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <?php
                                        require ("../Config/connection.php");
                                        $sql = $connection -> query("SELECT * FROM categories WHERE category_status = 1");
                                    ?>
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select class="form-select" id="productCategory" name="productCategory" required>
                                        <option value="">Select a category</option>
                                        <?php
                                            while($data = $sql -> fetch_object()){
                                        ?>
                                            <option value="<?= $data -> category_id ?>"><?= $data -> category_name ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Insert the price" required>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="Insert the quantity" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success mt-3 btn-sm" id="btnAddProduct" name="btnAddProduct">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                <div class="table-responsive">
                    <table class="table table-striped align-middle table-success table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Category</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                require ("../Config/connection.php");
                                $sql = $connection -> query("SELECT * FROM products
                                INNER JOIN categories ON products.product_category = categories.category_id
                                WHERE product_status = 1"); 

                                while($data = $sql -> fetch_object()){
                            ?>
                                <tr>
                                    <td><?= $data -> product_code ?></td>
                                    <td><?= $data -> product_name ?></td>
                                    <td><?= $data -> product_price ?></td>
                                    <td><?= $data -> product_quantity ?></td>
                                    <td><?= $data -> category_name ?></td>
                                    <td class="text-center">
                                        <a href="../Controller/Products/edit_product.php?code=<?= $data -> product_code ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm btn-delete-product" data-product-code="<?= $data->product_code ?>">
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