<?php
// Database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "navod";
$dbname = "nimsara_computers";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle liking/unliking (You'll need to implement logic to get the user ID)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = mysqli_real_escape_string($conn, $_POST["product_id"]);
    $user_id = 1; // Replace with the user's ID

    // Check if product is already liked
    $sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Unlike the product
        $sql = "DELETE FROM likes WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $conn->query($sql);
        echo "Product unliked.";
    } else {
        // Like the product
        $sql = "INSERT INTO likes (user_id, product_id) VALUES ('$user_id', '$product_id')";
        $conn->query($sql);
        echo "Product liked.";
    }
}

// Close connection
$conn->close();
?>