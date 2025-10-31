<?php
// Include database connection
require_once 'db/config.php';

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $productId = $_POST['productId']; 

    // Update product status to 2 (unpushed)
    $sql = "UPDATE product SET product_status = 2 WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("i", $productId);
        if ($stmt->execute()) {
            echo "Product unpushed successfully!";
        } else {
            echo "Error updating product status: " . $conn->error;
        }
        $stmt->close();
    }
}
?>