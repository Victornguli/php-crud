<?php
    include "config/database.php";
    
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    echo json_encode($products);
?>