<?php
    include "config/database.php";
    
    // $searchwords = $_POST["word"];

    $query = "SELECT * FROM products WHERE";
    $word = strtolower(htmlspecialchars($_POST["word"])); 

    $keywords = explode(" ", $word); 
    $keyCount = 0;

    foreach ($keywords as $key => $value) { 
        
        if ($value == ""){
            // echo $query;           
        }else{
            if ($keyCount > 0){
                $query .= " OR";
            }
            $query .= " name LIKE '%$value%'";
        }

        //echo "<br>".$value. " =>> " .$query;
        ++$keyCount;
    }
    echo $query;

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

    }

    echo $data;
?>