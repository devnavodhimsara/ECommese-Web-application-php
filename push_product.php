<?php


require_once 'db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    
    $productId = $_POST['productId']; 

  
    $sql = "UPDATE product SET product_status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("i", $productId);
        if ($stmt->execute()) {
            echo "Product pushed successfully!";
    
        } else {
            echo "Error updating product status: " . $conn->error;
        }
        $stmt->close();
        {
        $stmt->close();

        }
    }
}
?>