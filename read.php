<?php
    include "config/database.php";
    
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    $data = array();
    
    if($result){
        if(mysqli_num_rows($result) > 0){
            $data = [
                status => "success",
                message => mysqli_fetch_all($result, MYSQLI_ASSOC)
            ];
        }
        else{
            $data = [
                status => 404,
                message => "No Records found"
            ];
        }
    }else{
        $data =[
            status => "error",
            message => mysqli_error($conn)
        ];
    }

    $data = json_encode($data);
    echo $data;
?>