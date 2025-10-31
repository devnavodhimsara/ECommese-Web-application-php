<?php
session_start();
include "db/connections.php";

if (isset($_SESSION["u"])) {
    $order_id = isset($_POST["o"]) ? $_POST["o"] : '';
    $price = isset($_POST["p"]) ? $_POST["p"] : 0.0;
    $umail = $_SESSION["u"]["id"];
    $address = $_SESSION["u"]["address_line1"] . " " . $_SESSION["u"]["address_line2"];

    $userdetail = $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"];

    if (empty($order_id) || empty($price)) {
        echo "Order ID or price is missing";
        exit();
    }

    // Fetch cart data
    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='" . $umail . "'");
    if ($cart_rs->num_rows > 0) {
        while ($cart_data = $cart_rs->fetch_assoc()) {
            $qty = $cart_data["qty"];
            $pid = $cart_data["product_id"];

            // Fetch product data
            $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $pid . "'");
            if ($product_rs->num_rows > 0) {
                $product_data = $product_rs->fetch_assoc();
                $sellers_username =$product_data["sellers_username"];
                $new_qty = $product_data["qty"] - $qty;

                $product=$product_data["price"];
                $title= $product_data["title"];

                // Update product quantity
                Database::iud("UPDATE `products` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

                // Set timezone and get current date and time
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                // Insert invoice data
                $invoice_query = "
                    INSERT INTO `invoice` (`order_id`, `date`, `total`, `qty`, `status`, `products_id`, `users_id`,`sellers_name`,`title`,`price`,`useraddress`,`username`) 
                    VALUES ('$order_id', '$date', '$price', '$qty', '0', '$pid', '$umail','$sellers_username','$title','$product','  $address ','$userdetail')
                ";
                Database::iud($invoice_query);
            } else {
                echo "Product not found for ID: $pid";
                exit();
            }
        }

        // Delete cart data
        $delete_query = "DELETE FROM `cart` WHERE `user_id`='" . $umail . "'";
        Database::iud($delete_query);

        echo "success";
    } else {
        echo "Cart is empty for user ID: $umail";
    }
} else {
    echo "User not logged in";
}
?>
