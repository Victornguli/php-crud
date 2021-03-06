<?php 
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo $_SESSION["id"];
    header("location: auth/login.php");
    exit;
}
?>
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
    .modal-content:hover{
        border: 1px solid skyblue;
    }
    #search-form{
        width: 50%;
        margin: 10px 0px 10px 10px;
    }
    </style>

</head>
<body>
    <!-- Container -->
    <div class="container">

        <div class="page-header">
            <h1>Read Products</h1>
        </div>
        <button data-toggle="modal" data-target="#add_modal" id="create_btn" class='btn btn-primary m-b-1em'>Create New Product</button>
        <div id="feedback"></div>
        <div class="panel panel-info">
            <div class="panel-heading">All Products</div>

            <form id="search-form">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Search Products">
                    <div class="input-group-btn">
                    <button class="btn btn-default" id="search-btn" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                    </div>
                </div>
            </form>

            <!-- Add Modal -->
            <div class="modal fade" id="add_modal" role="dialog" style="">
                <div class="modal-dialog modal-center" style="position:absolute; width:50%; top:10%; left:25%;">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header bg-warning" style="border-radius:10px">
                    <button type="button" class="close" data-dismiss="modal" style="font-size:30px;">&times;</button>
                    <h4 class="modal-title">Add New Product<span </span></h4>
                    </div>
                    <div class="modal-body">
                    <form action="" id="addproduct" enctype="multipart/form-data" method="post">
                    <input type="" id="edit_id" hidden>
                    <label for="add_name">Product Name</label>
                    <input type="text" class="form-control" id="add_name">
                    <hr>
                    <label for="add_description" rows="5">Product description</label>
                    <textarea class="form-control" id="add_description"></textarea>
                    <hr>
                    <label for="add_price" rows="5">Price</label>
                    <input type="number" class="form-control" id="add_price">
                    <label for="file">Picture</label>
                    <input type="file" name="file" id="file">
                    </div>
                    <div class="modal-footer">
                    <div id="error_msg"></div>
                    <input type="button" value="Add Product" id="add_submit_btn" class="btn btn-primary">
                    </form>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Add Modal -->

            <!-- Edit Modal -->
            <div class="modal fade" id="edit-modal" role="dialog" style="">
                <div class="modal-dialog modal-center" style="position:absolute; width:50%; top:0%; left:25%;">
                <div class="modal-content" style="border-radius:10px">
                    <div class="modal-header bg-warning" style="border-radius:10px">
                    <button type="button" class="close" data-dismiss="modal" style="font-size:30px;">&times;</button>
                    <h4 class="modal-title">Edit Product<span </span></h4>
                    </div>
                    <div class="modal-body">
                    <input type="" id="edit_id" hidden>
                    <label for="edit_name">Product Name</label>
                    <input type="text" class="form-control" id="edit_name">
                    <hr>
                    <label for="edit_description" rows="5">Product description</label>
                    <textarea class="form-control" id="edit_description"></textarea>
                    <hr>
                    <label for="edit_price" rows="5">Price</label>
                    <input type="number" class="form-control" id="edit_price">
                    <hr>
                    <img src="" id="edit_image" alt="" height="100%" width="100%">
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="edit_submit_btn" class="btn btn-primary" data-dismiss="modal">Edit</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Edit Modal -->

            <!-- Products -->
            <div class="panel-body" id="contents">

            </div>

        </div>

        <a href="auth/logout.php" class="btn btn-danger mb-5">Logout</a>

        <a href="auth/reset_password.php" class="btn btn-warning mb-5">Reset</a>

        <div id="ajax"></div>        
        <!-- <ul class="pagination">
            <li> <a href="?page_no=1">First</a> </li>
            <li class="<?php  if($page_no <= 1) {echo 'disabled';} ?>">
                <a href="<?php if($page_no <= 1){echo '#';} else {echo '?page_no='.($page_no-1);} ?>">Prev</a>
            </li>
            <li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo '?page_no='.($page_no+1);} ?>">Next</a>
            </li>
            <li><a href="?page_no=<?php echo $total_pages; ?>">Last</a></li>
        </ul> -->
    </div>

    <!-- End container -->

     <!-- Jquery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    
    <!-- Custom Script -->
    <script src="script.js"></script>
    
</body>
</html>