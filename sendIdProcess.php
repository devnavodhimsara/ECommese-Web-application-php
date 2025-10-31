<?php
session_start();
include "db\connections.php";

$email = $_SESSION["sup"]["username"];
$pid = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$pid."' AND `sellers_username`='".$email."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){
    $product_data = $product_rs->fetch_assoc();
    $_SESSION["p"] = $product_data;

    echo ("Success");
}else{
    echo ("Something went wrong. Please try again later.");
}else {
    echo("sumthing went wrong")
}

?>