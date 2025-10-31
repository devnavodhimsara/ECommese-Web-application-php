<?php

include "db\connections.php";
session_start();
$user = $_SESSION["u"];

$stockList = array();
$qtyList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    //From Cart

    $rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='".$user["id"]."'");
    $num = $rs->num_rows;

    for ($i=0; $i < $num; $i++) { 
        $d = $rs->fetch_assoc();

        $stockList[] = $d["id"];
        $qtyList[] = $d["qty"];
    }

} else {
    //From Buy Now
    
    $stockList[] = $_POST["id"];
    $qtyList[]= $_POST["qty"];

}

$merchantId = "1227714";

$merchant_secret = "MzI3OTU4MDE2ODI5NzM5Nzg4MDQ3MjYxMjU4NjQxOTE0MDQ2NjA4";
$items = "1";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i=0; $i < sizeof($stockList); $i++) { 
    
    $rs2 = Database::search("SELECT * FROM `products`WHERE `products`.`id`='".$stockList[$i]."'");

    $d2 = $rs2->fetch_assoc();
    $stockQty = $d2["qty"];
    
    if ($stockQty >= $qtyList[$i]) {
        //Stock Available
        $items .= $d2["title"];

        if ($i != sizeof($stockList) - 1) {
            $items .= ", ";
        }

        $netTotal += (intval($d2["price"]) * intval($qtyList[$i]));

    } else {
        echo("Product has no available stock.");
    }   
}

//Delivary Fee
$netTotal += 500;

$hash = strtoupper(
    md5(
        $merchantId . 
        $orderId . 
        number_format($netTotal, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchantSecret)) 
    ) 
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["first_name"];
$payment["last_name"] = $user["last_name"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile_number"];
$payment["address"] = $user["address_line1"].",".$user["address_line2"];
$payment["city"] = $user["address_line2"];
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);


?>