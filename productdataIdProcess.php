<?php
session_start();
include "db\connections.php";

$username = $_SESSION["sup"]["username"];
$productdata = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$productdata."' AND `sellers_username`='".$username."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){
    $product_data = $product_rs->fetch_assoc();
    $_SESSION["product"] = $product_data;

    echo ("Success");
}else{
    echo ("Something went wrong. Please try again later.");
}

?>