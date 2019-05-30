<?php
include "config/database.php";

if (isset ($_GET["id"])){
    $id = $_GET["id"];

} else{
    $data = [
        status => "error",
        message => exit(mysqli_error($conn))
    ];
}

$query = "DELETE FROM products WHERE id='$id'";

if($result = mysqli_query($conn,$query))
{
    $data = [
        status => "success",
        message => "Product deleted successfully"
    ];
    // header("Location:index.php?action=deleted");
}
 
else
{   $data = [
        status => "error",
        message => exit(mysqli_error($conn))
    ];
}

$data = json_encode($data);
echo $data;
?>