<?php
include "config/database.php";

if (isset ($_GET["id"])){
    $id = $_GET["id"];
    echo $id;
} else{
    die("ERROR : Record not found");
}

$query = "DELETE FROM products WHERE id='$id'";

if(!$result = mysqli_query($conn,$query))
{
    die("Unable to delete record");
} 
else
{
    header("Location:index.php?action=deleted");

}


?>