<?php
session_start();
require("../../Config/connection.php");
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = $connection->query("SELECT * FROM categories WHERE category_id = '$productId'");
    $categoryData = $sql->fetch_object();
}

if (!isset($_SESSION['is_active']) || $_SESSION['is_active'] !== true) {
    header("location: ../../login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../sources/img/php.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../sources/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../sources/css/main.css">
    <title>Edit category</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Category</h5>
                        <form action="update_category.php" method="POST">
                            <input type="hidden" name="categoryId" value="<?= $categoryData->category_id ?>">
                            <div class="row py-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="categoryName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?= $categoryData->category_name ?>" placeholder="Insert the name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="categoryDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Insert the description" required style="max-height: 300px;"><?= $categoryData->category_description ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success mt-3 btn-sm" id="btnEditCategory" name="btnEditCategory">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible mt-3">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?= $_SESSION['success']; ?>
                            </div>
                        <?php unset($_SESSION['success']); endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible mt-3">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php
                                if (is_array($_SESSION['error'])) {
                                    echo "<ul>";
                                    foreach ($_SESSION['error'] as $error) {
                                        echo "<li>$error</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo $_SESSION['error'];
                                }
                                ?>
                            </div>
                        <?php unset($_SESSION['error']); endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../sources/js/bootstrap.min.js"></script>
</body>
</html>