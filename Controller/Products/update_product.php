<?php
    session_start();
    require("../../Config/connection.php");

    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $productCategory = $_POST['productCategory'];

    $errors = array();

    //Validate length of name
    if (strlen($productName) > 50 || strlen($productName) < 5) {
        $errors[] = "The name must be between 5 and 50 characters";
    }

    //Validate length of product quantity
    if ($productQuantity > 999999 || $productQuantity < 1) {
        $errors[] = "The quantity must be between 1 and 999999";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
        header("Location: edit_product.php?code=$productCode"); // Vuelve a la página de edición con los errores
        exit();
    } else {
        $sql = "UPDATE products SET product_name = '$productName', product_price = '$productPrice', product_quantity = '$productQuantity', product_category = '$productCategory' WHERE product_code = '$productCode'";
        $result = mysqli_query($connection, $sql);

        if ($result == true) {
            $_SESSION['success'] = "Product updated successfully";
        } else {
            $_SESSION['error'] = "Error updating product";
        }
        
        header("Location: ../../Views/products.php");
        exit();
    }
?>
