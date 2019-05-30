<?php

include "config/database.php";

if (isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];
    $query = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    $data = array();
    if($result){
        if(mysqli_num_rows($result) > 0){
            $data = [
                status => "success",
                message => mysqli_fetch_all($result, MYSQLI_ASSOC)
            ];
        }else{
            $data =[
                status => 404,
                message => "No such record"
            ];
        }
    }else{
        $data = [
            status => "error",
            message => mysqli_error($conn)
        ];

    }

    echo json_encode($data);
}

?>
