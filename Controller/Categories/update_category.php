<?php
    session_start();
    require("../../Config/connection.php");

    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];
    $categoryDescription = $_POST['categoryDescription'];

    $errors = array();

    // Check if the user has changed the category name
    $sqlGetOldName = "SELECT category_name FROM categories WHERE category_id = '$categoryId'";
    $oldNameResult = $connection->query($sqlGetOldName);
    $oldCategoryName = $oldNameResult->fetch_object()->category_name;

    if ($categoryName !== $oldCategoryName) {
        // User has changed the name, validate it
        if (strlen($categoryName) > 50 || strlen($categoryName) < 5) {
            $errors[] = "The name must be between 5 and 50 characters";
        }

        $sqlCheckName = "SELECT COUNT(*) as count FROM categories WHERE category_name = '$categoryName'";
        $result = $connection->query($sqlCheckName);
        $count = $result->fetch_object()->count;

        if ($count > 0) {
            $errors[] = "The name already exists";
        }
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
        header("Location: edit_category.php?id=$categoryId");
        exit();
    } else {
        $sql = "UPDATE categories SET category_description = '$categoryDescription'";

        // Update the name only if the user has changed it
        if ($categoryName !== $oldCategoryName) {
            $sql .= ", category_name = '$categoryName'";
        }

        $sql .= " WHERE category_id = '$categoryId'";
        
        $result = mysqli_query($connection, $sql);

        if ($result == true) {
            $_SESSION['success'] = "Category updated successfully";
        } else {
            $_SESSION['error'] = "Error updating category";
        }
        
        header("Location: ../../Views/categories.php");
        exit();
    }
?>
