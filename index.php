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
            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create new Product</a>";

            $action = isset($_GET["action"]) ? $_GET["action"] : "";
            
            if ($action == "deleted"){
                echo "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong>One product deleted.
            </div>";
            }
            
            if (isset($_GET["page_no"])){
                $page_no = $_GET["page_no"];
            } else{
                $page_no = 1;
            }
            $no_of_records_per_page = 5;
            $offset = ($no_of_records_per_page * $page_no)-$no_of_records_per_page;
            //echo $offset;
            $total_pages_query = "SELECT COUNT(*) FROM products";
            $result = mysqli_query($conn, $total_pages_query);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages =  ceil($total_rows / $no_of_records_per_page);
            $query = "SELECT * FROM products LIMIT $offset, $no_of_records_per_page";
            $res_data = mysqli_query($conn, $query);

            if(mysqli_num_rows($res_data) > 0 ){

            }else{
                echo mysqli_error($conn)."<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Warning!</strong> Zero records found.
            </div>";
            }

            
            // paginate records
         ?>
        <div id="ajax"></div>        
        <ul class="pagination">
            <li> <a href="?page_no=1">First</a> </li>
            <li class="<?php  if($page_no <= 1) {echo 'disabled';} ?>">
                <a href="<?php if($page_no <= 1){echo '#';} else {echo '?page_no='.($page_no-1);} ?>">Prev</a>
            </li>
            <li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo '?page_no='.($page_no+1);} ?>">Next</a>
            </li>
            <li><a href="?page_no=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
    </div>

    <!-- End container -->

     <!-- Jquery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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


        $(document).ready(function(){
            $.get("read.php", function(data,status){
                    //alert (`${data}  ${status}`);
                    var products = JSON.parse(data);
                    output = `
                    <table class='table table-hover table-responsive table-bordered'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    `;

                    for (var i in products){
                        output += `
                            <tr>
                                <td>${products[i].id}</td>
                                <td>${products[i].name}</td>
                                <td>${products[i].description}</td>
                                <td>${products[i].price}</td>
                                <td>
                                    <a href= ' read_one.php?id=${products[i].id}' class='btn btn-info m-r-1em'> Read </a>

                                    <a href='update.php?id=${products[i].id}' class='btn btn-primary m-r-1em'> Edit </a>

                                    <a href='#' id='delete'  onClick='deleteUser(${products[i].id})' class='btn btn-danger m-r-1em'> Delete </a>

                                </td>
                            </tr>
                        `
                    }
                    output += `
                        </table>
                    `;
                    $("#ajax").html(output);
                });
        });
    </script>
</body>
</html>