<?php

session_start();
include "db\connections.php";

if(isset($_SESSION["u"])){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $product=$product_data["price"];
    $title= $product_data["title"];
    $address = $_SESSION["u"]["address_line1"] . " " . $_SESSION["u"]["address_line2"];
    $userdetail = $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"];

    $sellers_username =$product_data["sellers_username"];

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `products` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`products_id`,`users_id`,`sellers_name`,`title`,`price`,`useraddress`,`username`) 
    VALUES ('".$order_id."','".$date."','".$amount."','".$qty."','0','".$pid."','".$mail."','".$sellers_username."','".$title."','".$product."','".$address."','".$userdetail."')");

    echo ("success");

}

?>