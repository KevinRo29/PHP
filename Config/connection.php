<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "php_project";

$connection =  new mysqli($host, $user, $password, $database);
$connection->set_charset("utf8");

if(!$connection){
    echo "Error: " . mysqli_connect_error();
}
?>