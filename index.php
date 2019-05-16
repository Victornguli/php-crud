<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
    .m-r-1em{ 
        margin-right:1em; 
    }
    .m-b-1em{ 
        margin-bottom:1em;
    }
    .m-l-1em{
        margin-left:1em; 
    }
    .mt0{ 
        margin-top:0; 
    }
    </style>

</head>
<body>

    <!-- Container -->
    <div class="container">

        <div class="page-header">
            <h1>Read Products</h1>
        </div>

        <?php
            include "config/database.php";
            
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $records_per_page = 5;

            $from_record_num = ($records_per_page * $page) - $records_per_page;


            $action = isset($_GET["action"]) ? $_GET["action"] : "";
            
            if ($action == "deleted"){
                echo "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong>One product deleted.
            </div>";
            }


            $query = "SELECT id,name,description,price,created,modified FROM products ORDER BY id DESC
                LIMIT :from_record_num, :record_per_page";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
            $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
            $stmt->execute();

            $result = mysqli_query($conn, $query);
            
            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create new Product</a>";

            if(mysqli_num_rows($result) > 0){
                    //Data
                    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
                    //creating our table heading
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>Description</th>";
                        echo "<th>Price</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";

                    //Table with records from database
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                            echo "<td>{$row["id"]}</td>";
                            echo "<td>{$row["name"]}</td>";
                            echo "<td>{$row["description"]}</td>";
                            echo "<td>&#36; {$row["price"]}</td>";
                            echo "<td>";
                                //Read one record
                                echo "<a href='read_one.php?id={$row["id"]}' class='btn btn-info m-r-1em'> Read </a>";
                                
                                //Update one record
                                echo "<a href='update.php?id={$row["id"]}' class='btn btn-primary m-r-1em'> Edit </a>";

                                //Delete User
                                echo "<a href='#' onclick='deleteUser({$row["id"]})' class='btn btn-danger m-r-1em'> Delete </a>";
                            echo "</td>";
                        echo "</tr>";

                    }
                    $query = "SELECT COUNT(*) as total_rows FROM products";
                    $stmt = $con->prepare($query);
                    
                    // execute query
                    $stmt->execute();
                    
                    // get total rows
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total_rows = $row['total_rows'];
                    // end table
                    echo "</table>";
            }else{
                echo "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Warning!</strong> Zero records found.
            </div>";
            }

            // paginate records
            $page_url="index.php?";
            include_once "paging.php";
         ?>
    </div>
    <!-- End container -->

     <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    
    <!-- Delete Confirmation -->
    <script>
        function deleteUser(id){

            var answer = confirm("Do you want to delete this product? ");
            if(answer){
                window.location = `delete.php?id=${id}`;
            }
        }
    </script>
</body>
</html>