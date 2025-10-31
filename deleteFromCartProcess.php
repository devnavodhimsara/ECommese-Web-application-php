<?php

include "db\connections.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");
    echo ("Removed");

}else{
    echo ("Something went wrong.");
}

?>