<?php
    session_start();
    require("../../Config/connection.php");

    if(isset($_GET['id'])) {
        $categoryId = $_GET['id'];
    
        $updateQuery = "UPDATE categories SET category_status = 0 WHERE category_id = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("s", $categoryId);
    
        if($stmt->execute()) {
            $_SESSION['success'] = "Category deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting category.";
        }
    
        $stmt->close();
    } else {
        $_SESSION['error'] = "Category id not provided.";
    }
    
    $connection->close();
    header("Location: ../../Views/categories.php");
    exit();
?>