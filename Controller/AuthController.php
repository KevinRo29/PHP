<?php
    session_start();
    require ("../Config/connection.php");

    if(isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])){
        $email = $_POST['emailLogin'];
        $password = $_POST['passwordLogin'];

        $sql = $connection -> query("SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'");

        if($sql -> num_rows > 0){
            $is_active = true;
            $data = $sql -> fetch_object();
            $_SESSION['user_name'] = $data -> user_name;
            $_SESSION['user_email'] = $data -> user_email;
            $_SESSION['user_status'] = $data -> user_status;
            $_SESSION['is_active'] = $is_active;

            header("location: ../Views/products.php");
            exit();
        }else{
            $_SESSION['error'] = "Invalid email or password.";
            header("location: ../login.php");
            exit();
        }
    }
?>