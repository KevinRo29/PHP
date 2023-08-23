<?php
session_start();
require("../../Config/connection.php");

if(isset($_GET['code'])) {
    $productCode = $_GET['code'];

    $updateQuery = "UPDATE products SET product_status = 0 WHERE product_code = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("s", $productCode);

    if($stmt->execute()) {
        $_SESSION['success'] = "Product deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting product.";
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Product code not provided.";
}

$connection->close();
header("Location: ../../Views/products.php");
exit();
?>
