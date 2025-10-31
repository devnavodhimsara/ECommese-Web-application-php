<?php
session_start();
include "db/connections.php";

if (isset($_POST["pid"], $_POST["status"]) && isset($_SESSION["sup"])) {
    $pid = $_POST["pid"];
    $status = $_POST["status"];

    // Make sure to validate and sanitize inputs 

    $updateResult = Database::iud("UPDATE `products` SET 
                                    `status` = '$status' 
                                    WHERE `id` = $pid 
                                    AND `sellers_username` = '" . $_SESSION["sup"]["username"] . "'");

    if ($updateResult) {
        echo "Product status updated successfully";
    } else {
        echo "Error updating product status";
    }
} else {
    echo "Invalid request";
}
?>