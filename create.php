<?php

if ($_POST) {
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
        $data = [
            status => "success",
            message => "One Product created"
        ];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    echo json_encode($data);
}

?>
