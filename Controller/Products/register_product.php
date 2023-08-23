<?php
    session_start();
    require("../../Config/connection.php");

    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $productCategory = $_POST['productCategory'];
    $productStatus = '1';

    $errors = array();

    //Validate if the code has 2 capital letters and 10 numbers
    if (!preg_match("/^[A-Z]{2}[0-9]{10}$/", $productCode)) {
        $errors[] = "The code must have the format ABDDMMYYYY12";
    }

    //Validate if the code already exists
    $sqlCheckCode = "SELECT COUNT(*) as count FROM products WHERE product_code = '$productCode'";
    $result = $connection->query($sqlCheckCode);
    $count = $result->fetch_object()->count;

    if ($count > 0) {
        $errors[] = "The code already exists";
    }

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
    } else {
        $sql = "INSERT INTO products (product_code, product_name, product_price, product_quantity, product_category, product_status) VALUES ('$productCode', '$productName', '$productPrice', '$productQuantity', '$productCategory', '$productStatus')";
        $result = mysqli_query($connection, $sql);

        if($result == true){
            $_SESSION['success'] = "Product registered successfully";
        }else{
            $_SESSION['error'] = "Error registering product";
        }
    }
    
    header("Location: ../../Views/products.php");
    exit();

?>