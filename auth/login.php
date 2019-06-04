<?php
require_once("../config/database.php");

print_r(count($_SESSION));

foreach ($_SESSION as $key => $value) {
    echo $key." ".$value;
}

?>