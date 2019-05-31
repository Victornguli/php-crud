<?php
include "config/database.php";


if (isset($_POST["id"]) && (isset($_POST["name"]) || isset($_POST["description"]) || isset($_POST["price"]))){
    $id = htmlspecialchars($_POST["id"]);
    $name = htmlspecialchars($_POST["name"]);
    $price = htmlspecialchars($_POST["price"]);
    $description = htmlspecialchars($_POST["description"]);
    $query = "UPDATE products 
        SET name='$name',description='$description',price='$price' WHERE id='$id'";

    $data = array();
    //Error -> Record was not updated
    if (!$result = mysqli_query($conn, $query)) {
        $data = [
            status => "error",
            message => mysqli_error($conn)
        ];
    }
    //Record Updated successfully
    else {
        $data = [
            status => "success",
            message => "Record updated successfully"
        ];
    }

    echo json_encode($data);
}
?>