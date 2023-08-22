<?php
session_start();
require("../Config/connection.php"); // Asegúrate de incluir la conexión a la base de datos aquí si aún no está incluida.

// Obtener los datos del producto a editar (suponiendo que se pasa el código del producto como parámetro en la URL)
if (isset($_GET['code'])) {
    $productCode = $_GET['code'];
    $sql = $connection->query("SELECT * FROM products WHERE product_code = '$productCode'");
    $productData = $sql->fetch_object();
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
    <title>Edit product</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Product</h5>
                        <form action="update_product.php" method="POST">
                            <input type="hidden" name="productCode" value="<?= $productData->product_code ?>">
                            <div class="row py-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" value="<?= $productData->product_name ?>" placeholder="Insert the name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?= $productData->product_price ?>" placeholder="Insert the price" required>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantity" name="productQuantity" value="<?= $productData->product_quantity ?>" placeholder="Insert the quantity" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success mt-3 btn-sm" id="btnEditProduct" name="btnEditProduct">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../sources/js/bootstrap.min.js"></script>
</body>
</html>