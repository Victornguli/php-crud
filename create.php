<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create A record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <!-- Container -->
    <div class="container">
    
        <div class="page-header">
            <h1>Create product</h1>
        </div>
        <?php
            if($_POST){
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
                
                if(!$result = mysqli_query($conn, $query)){
                    echo "<div class='alert alert-danger alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Warning!</strong> Record could not be saved.  ".mysqli_error($conn). "</div>";
                    //Could not save record
                }else{
                    //Record Saved
                    echo "<div class='alert alert-success alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Record saved.
                        </div>";

                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            echo "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["image"]["size"] > 500000) {
                            echo "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                }
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <table class="table table-hover table-responsive table-bordered">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" class="form-control"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="price" class="form-control"></td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Save" class="btn btn-primary">
                    <a href="index.php" class="btn btn-danger">Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- End Container -->

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
