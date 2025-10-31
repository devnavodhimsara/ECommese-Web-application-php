<?php 
include 'db/config.php'; 
$sql = "SELECT * FROM news ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $news = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle case where no news is found 
    $news = [
      [
        'title' => 'No news available',
        'date' => 'N/A',
        'image' => 'https://via.placeholder.com/640x360',
        'link' => '#'
      ]
    ];
}?>