<?php// Include database connection
require_once 'db/config.php';

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $productId = $_POST['productId'];
    $newStatus = $_POST['newStatus']; // Get the new status from AJAX

    // Update product status
    $sql = "UPDATE product SET product_status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("ii", $newStatus, $productId);
        if ($stmt->execute()) {
            echo "Product status updated successfully!";
        } else {
            echo "Error updating product status: " . $conn->error;
        }
        $stmt->close();
    }
}
?>