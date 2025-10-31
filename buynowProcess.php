<?php
session_start();
include "db\connections.php";

if(isset($_SESSION["u"])){ // Check if the user is logged in

    $id = $_GET["id"]; // Product ID from the URL
    $qty = $_GET["qty"]; // Quantity from the URL
    $umail = $_SESSION["u"]["id"]; // User's email address

    $order_id = uniqid(); // Generate a unique order ID

    // Fetch product details from the database
    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    // Calculate order amount
    $delivery = 200;
    $item = $product_data["title"];
    $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

    // Fetch user details from the session
    $fname = $_SESSION["u"]["first_name"];
    $lname = $_SESSION["u"]["last_name"];
    $mobile = $_SESSION["u"]["mobile_number"];

    //  This part is problematic, you're trying to access variables without defining them.
    //  Need to implement a method to retrieve the user's address.
    // $uaddress = $address;
    // $city = $district_data["city_name"];

    // PayHere credentials
    $merchant_id = "1227714";
    $merchant_secret = "MzI3OTU4MDE2ODI5NzM5Nzg4MDQ3MjYxMjU4NjQxOTE0MDQ2NjA4";
    $currency = "LKR";

    // Generate the PayHere hash
    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );

    // Create the array to be encoded as JSON
    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    //  $array["address"] = $uaddress; // Replace with the actual address from the user's data
    //  $array["city"] = $city; // Replace with the actual city from the user's data
    $array["umail"] = $umail;
    $array["mid"] = $merchant_id;
    $array["msecret"] = $merchant_secret;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    // Output the data as JSON
    echo json_encode($array);

} else {
    echo ("1"); //  Return a value to indicate the user is not logged in
}

?>