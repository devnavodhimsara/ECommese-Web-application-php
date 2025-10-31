<?php

include "db/connections.php";

if (isset($_GET["qty"]) && isset($_GET["id"])) {
    $qty = $_GET["qty"];
    $cid = $_GET["id"];

    if (empty($qty)) {
        echo "Invalid request";
    } else if ($qty < 1) {
        echo "Invalid Quantity";
    } else {
        // Get cart item details
        $cartRs = Database::search("SELECT * FROM `cart` WHERE `id` = '$cid'");
        $cartNum = $cartRs->num_rows;

        if ($cartNum > 0) {
            $cartRow = $cartRs->fetch_assoc();
            $stockId = $cartRow["product_id"]; // Assuming you have a "product_id" column in your cart table

            // Get product stock details
            $stockRs = Database::search("SELECT * FROM `products` WHERE `id` = '$stockId'");
            if ($stockRs->num_rows > 0) {
                $stock = $stockRs->fetch_assoc();

                // Check if available stock is enough
                if ($stock["qty"] >= $qty) {
                    // Update cart quantity
                    Database::iud("UPDATE `cart` SET `qty` = '$qty' WHERE `id` = '$cid'");
                    echo "Updated";
                } else {
                    echo "Not enough stock available."; // Handle the scenario where stock is insufficient
                    
                }
            } else {
                echo "Product not found."; // Handle the scenario where the product is not found
            }
        } else {
            echo "Cart item not found."; // Handle the scenario where the cart item is not found
        }
    }
} else {
    echo "Something went wrong.";
}

?>