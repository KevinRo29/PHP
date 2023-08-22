<?php
session_start();
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
    <title>PHP Project</title>
</head>
<body>
    <div class="container">
        <div class="row pt-5 pb-4">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Products</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Add Product</h6>
                        <form action="Controller/register_product.php" method="POST">
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
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                require ("Config\connection.php");
                                $sql = $connection -> query("SELECT * FROM products WHERE product_status = 1");

                                while($data = $sql -> fetch_object()){
                            ?>
                                <tr>
                                    <td><?= $data -> product_code ?></td>
                                    <td><?= $data -> product_name ?></td>
                                    <td><?= $data -> product_price ?></td>
                                    <td><?= $data -> product_quantity ?></td>
                                    <td class="text-center">
                                        <a href="Controller/edit_product.php?code=<?= $data -> product_code ?>" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '<?= $data->product_code ?>')">
                                        Delete
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

    <script src="sources/js/bootstrap.min.js"></script>
    <script src="sources/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>