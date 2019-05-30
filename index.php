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
        <a href="create.php" class='btn btn-primary m-b-1em'>Create New Product</a>
        <div id="feedback"></div>
        <div class="panel panel-info">
            <div class="panel-heading">All Products</div>
            <div class="panel-body" id="contents">
            </div>

            <div class="panel-footer">
                <div id="demo" class="collapse">Lorem</div>
            </div>

        </div>

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