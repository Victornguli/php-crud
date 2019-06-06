<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config/database.php";

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $created = date("Y-m-d, H:i:s");
    $image = basename($_FILES["image"]["name"]);

    $image = htmlspecialchars(strip_tags($image));

    $query = "INSERT INTO products (name, description, price, created, image)
    VALUES
    ('$name','$description','$price', '$created','$image')";

    $data = array();
    if (!$result = mysqli_query($conn, $query)) {
        $data = [
            status => "error",
            message => mysqli_error($conn)
        ];
        //Could not save record
    } else {
        //Record Saved
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/".$image);
        $data = [
            status => "success",
            message => "One Product created"
        ];

    }

    echo json_encode($data);
}

?>
