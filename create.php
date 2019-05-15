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

                $query = "INSERT INTO products (name, description, price, created)
                        VALUES
                        ('$name','$description','$price', '$created')";
                
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
                }
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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