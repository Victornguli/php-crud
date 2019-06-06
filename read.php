<?php
    include "config/database.php";
    
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    $data = '
        <table class="table table-resposive table-striped table-hover ">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        ';
    
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data .= "
                <tr>
                <td>{$row["id"]}</td>
                <td>{$row["name"]}</td>
                <td>{$row["description"]}</td>
                <td>{$row["price"]}</td>
                <td>
                    <button class='btn btn-info'
                    onclick='getDetails({$row["id"]})' data-toggle='modal'  data-target='#edit-modal'>Edit</button>
                    <!-- <button class='btn btn-success' id='{$row["id"]}'>Edit</button> --!>
                    <button class='btn btn-danger' onclick='deleteProduct({$row["id"]})' id='#delete_btn'>Delete</button>
                </td>
            </tr>
    
            <tr id='{$row["i"]}' class='collapse'>
                <td></td>
                <td colspan='4'><div id='edit{$row["i"]}'></div></td>
            </tr>
            ";
            }
        }
        else{
            $data = '<div class="alert alert-danger">Zero products found!</div>';
        }
    }else{
        $data = '<div class="alert alert-danger">Error failed to retreive products!</div>';
        
        //mysqli_error($conn);
    }

    echo $data;
?>