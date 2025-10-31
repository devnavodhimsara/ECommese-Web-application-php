<?php
session_start(); 

// Include database connection
require_once 'db/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id']; 
    $user_id = $_SESSION['u']['id']; 

    // Get the cart item row ID (primary key)
    $sql = "SELECT id FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $cart_item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cart_item_row_id = $row['id']; // Get the cart item's ID

        // Now, delete the specific cart item by its ID
        $sql = "DELETE FROM cart WHERE id = ?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $cart_item_row_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Item removed successfully, redirect or display a message
            header("Location: cart.php");
            exit; 
        } else {
            // Error removing item
            echo "Error removing item from cart.";
        }
    } else {
        // Item not found in cart
        echo "Item not found in cart.";
    }

    $stmt->close();
    $conn->close();
} 
?>