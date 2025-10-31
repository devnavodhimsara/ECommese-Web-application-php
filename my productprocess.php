<?php

require_once 'db/config.php';


require_once 'sellersessions.php';
$userName = $_SESSION['su'];
$sql1 = "SELECT profile_image FROM sellers WHERE username = '$userName'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) 
    $row = $result->fetch_assoc();

$resultsPerPage = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $resultsPerPage;
$sql = "SELECT id FROM sellers WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt->bind_result($sellerId);
$stmt->fetch();
$stmt->close();
$sql = "SELECT COUNT(*) FROM products WHERE seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sellerId);
$stmt->execute();
$stmt->bind_result($totalCount);
$stmt->fetch();
$stmt->close();
$totalPages = ceil($totalCount / $resultsPerPage);
$sql = "SELECT * FROM products WHERE seller_id = ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $sellerId, $resultsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>