<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read one record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <!-- Container -->
    <div class="container">
    
        <div class="page-header">
            <h1>Read product</h1>
        </div>
        <?php
        include "config/database.php";

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $query = "SELECT * FROM products WHERE id = '$id' LIMIT 0,1";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "
                    <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Name</td>
                        <td>{$row["name"]}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{$row["description"]}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{$row["price"]}</td>
                    </tr>

                    <tr>
                        <td>Image</td>
                        <td>";
                        echo $row["image"] ? "<img src='../../../REST_API/php-jquery/uploads/{$row["image"]}' style='width:300px;height:300px;border-radius:50%' />" : "No image found.";
                        echo "</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href='index.php' class='btn btn-danger'>Back to read products</a>
                        </td>
                    </tr>
                </table>                    
                    ";
                }
                
            }else{
                echo 
                "<div class='alert alert-danger alert-dismissible'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Warning!</strong> No product found.
                </div>";
            }
        }else{
            echo(
            "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Record ID not found!</strong>.
            </div>");
        }
        ?>

    </div>
    <!-- End Container -->

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>