<?php
include "config/database.php";

if (isset ($_GET["id"])){
    $id = $_GET["id"];
    echo $id;
} else{
    die("ERROR : Record not found");
}

$query = "DELETE FROM products WHERE id='$id'";

if($result = mysqli_query($conn,$query))
{
    header("Location:index.php?action=deleted");
} 
else
{
    die("Unable to delete record");
}


?>