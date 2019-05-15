<!DOCTYPE HTML>
<html>
<head>
    <title>Update a Record - PHP CRUD</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
     
        <!-- PHP read record by ID will be here -->
        <?php
            include "config/database.php";

            if (isset ($_GET["id"])){
                $id = $_GET["id"];
                $query = "SELECT * FROM products WHERE id='$id'";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $name = $row["name"];
                        $description = $row["description"];
                        $price = $row["price"];
                    }
                }
            }

            if(isset($_POST["name"]) || isset($_POST["description"]) || isset($_POST["price"])){

                $name = htmlspecialchars($_POST["name"]);
                $price = htmlspecialchars($_POST["price"]);
                $description = htmlspecialchars($_POST["description"]);

                $query = "UPDATE products 
                        SET name='$name', description='$description', price='$price' WHERE id='$id'";
                
                //Error -> Record was not updated
                if(!$result = mysqli_query($conn, $query))
                {
                    echo "<div class='alert alert-danger alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Zero product updated!</strong>.
                        </div>";
                }
                //Record Updated successfully
                else
                {
                    echo "<div class='alert alert-success alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> One Record updated.
                        </div>";
                }
            }
        ?>
        <!-- HTML form to update record will be here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>


    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>