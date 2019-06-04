<?php
$host = "localhost";
$username = "victor";
$password = "Victor4325";
$database = "php_beginner_crud";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Connection failed ") . mysqli_connect_error;
}

session_start();
?>