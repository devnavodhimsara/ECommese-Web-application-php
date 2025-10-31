<?php
include "db\connections.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `sellers` WHERE `id`='".$product_id."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){

    $product_data = $product_rs->fetch_assoc();
    $status = $product_data["status"];

    if($status == 1){
        Database::iud("UPDATE `sellers` SET `status`='2' WHERE `id`='".$product_id."'");
        echo ("deactivated");
    }else if($status == 2){
        Database::iud("UPDATE `sellers` SET `status`='1' WHERE `id`='".$product_id."'");
        echo ("activated");
    }

}else{
    echo ("Something went wrong. Please try again later.");
}

?>