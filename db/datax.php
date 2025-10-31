
<?php

$servername = "[localhost]";
$username = "[root]";
$password = "[navod]";
$dbname = "[nimsara_computers]";

// Create connection
$conn = new mysqli("localhost", "root", "navod", "nimsara_computers");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

