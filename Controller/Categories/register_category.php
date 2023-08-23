<?php
session_start();
require("../../Config/connection.php");
date_default_timezone_set('America/Mexico_City');

$categoryName = $_POST['categoryName'];
$categoryDescription = $_POST['categoryDescription'];
$categoryDateTime = date("Y-m-d H:i:s");
$categoryStatus = '1';

$errors = array();

//Validate length of name
if (strlen($categoryName) > 50 || strlen($categoryName) < 5) {
    $errors[] = "The name must be between 5 and 50 characters";
}

//Vlidate if the name already exists
$sqlCheckName = "SELECT COUNT(*) as count FROM categories WHERE category_name = '$categoryName'";
$result = $connection->query($sqlCheckName);
$count = $result->fetch_object()->count;

if ($count > 0) {
    $errors[] = "The name already exists";
}

if (!empty($errors)) {
    $_SESSION['error'] = $errors;
} else {
    $sql = "INSERT INTO categories (category_name, category_description, category_date, category_status) VALUES ('$categoryName', '$categoryDescription', '$categoryDateTime', '$categoryStatus')";
    $result = mysqli_query($connection, $sql);

    if($result == true){
        $_SESSION['success'] = "Category registered successfully";
    }else{
        $_SESSION['error'] = "Error registering category";
    }
}

header("Location: ../../Views/categories.php");
exit();

?>