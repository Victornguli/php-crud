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
                $image = !empty($_FILES["image"]["name"]) ? sha1_file($_FILES["image"]["tmp_name"]) . "-" . basename($_FILES["image"]["name"]) : "";

                $image = htmlspecialchars(strip_tags($image));

                $query = "INSERT INTO products (name, description, price, created, image)
                        VALUES
                        ('$name','$description','$price', '$created','$image')";
                
                if(!$result = mysqli_query($conn, $query)){
                    echo "<div class='alert alert-danger alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Warning!</strong> Record could not be saved.
                        </div>";
                    //Could not save record
                }else{
                    //Record Saved
                    echo "<div class='alert alert-success alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Record saved.
                        </div>";
                    
                        if($image){
                            $target_directory = "uploads/";
                            $target_file = $target_directory . $image;
                            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

                            $file_upload_error_messages = "";

                            $check = getimagesize($_FILES["image"]["tmp_name"]);

                            if($check !== false){
                                //Image
                            }else{
                                $file_upload_error_messages .="<div>Submitted file is not an image</div>.";
                            }

                            $allowed_file_types = array("jpeg","jpg", "png", "gif");
                            if(!in_array($file_type, $allowed_file_types)){
                                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                            }
                            
                            if(file_exists($target_file)){
                                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                            }

                            if($_FILES['image']['size'] > (1024000)){
                                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
                            }

                            // make sure the 'uploads' folder exists
                            // if not, create it
                            if(!is_dir($target_directory)){
                                mkdir($target_directory, 0777, true);
                            }

                            // if $file_upload_error_messages is still empty
                            if(empty($file_upload_error_messages)){
                                // it means there are no errors, so try to upload the file
                                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                                    // it means photo was uploaded
                                }else{
                                    echo "<div class='alert alert-danger'>";
                                        echo "<div>Unable to upload photo.</div>";
                                        echo "<div>Update the record to upload photo.</div>";
                                    echo "</div>";
                                }
                            }
                            
                            // if $file_upload_error_messages is NOT empty
                            else{
                                // it means there are some errors, so show them to user
                                echo "<div class='alert alert-danger'>";
                                    echo "<div>{$file_upload_error_messages}</div>";
                                    echo "<div>Update the record to upload photo.</div>";
                                echo "</div>";
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