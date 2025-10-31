<?php

session_start();
include "db\connections.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){

        $pid = $_GET["id"];
        $uid = $_SESSION["u"]["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_id`='".$uid."'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();

        $product_qty = $product_data["qty"];

        if($cart_num == 1){

            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if($product_qty >= $new_qty){
                Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `id`='".$cart_data["id"]."'");
                echo ("Cart updated");
            }else{
                echo ("The items you requested are currently out of stock");
            }

        }else{
            Database::iud("INSERT INTO `cart`(`qty`,`user_id`,`product_id`) VALUES ('1','".$uid."','".$pid."')");
            echo ("New product added to the cart.");
        }

    }else{
        echo ("Someting Went Wrong.");
    }
}else{
    echo ("Please Login or Signup first.");
}

?>