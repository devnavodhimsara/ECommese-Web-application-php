<?php

// Start the session
session_start();

// Include your database connection file
require_once 'db/config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['u'])) {
    // Redirect to login page if not logged in
    header('Location: loging.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbY2dAuXVpvnD/wGShP21Nxdl2XGzQ7lLiJLfjYf1uj/5eAojjp/sQ/L2L7sHDz2uK1O7+zc/bQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>


.bcolor{
    background-color: black;
}
    body {
        background-color: #181818; /* Darker background */
        color: #fff; /* White text */
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }
    .dsl{
        color:white;
    }
    .container {
        background-color: #282c34; /* Slightly lighter dark background for container */
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        max-width: 800px;
        margin: 30px auto;
        position: relative;
        animation: fadeInUp 1s ease-in-out; /* Added animation */
    }

    .news-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #4CAF50; /* Green for the title */
        margin-bottom: 20px;
    }

    .news-image {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Added shadow */
    }

    .news-content {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .news-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50; /* Green for the button */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Added shadow */
    }

    .news-link:hover {
        background-color: #3e8e41; /* Darker green on hover */
    }

    /* Responsive design for smaller screens */
    @media screen and (max-width: 768px) {
        .container {
            max-width: 90%;
            padding: 25px;
        }
    }

    /* Header & Footer Styling */
    header {
        background-color: #181818; /* Dark background */
        padding: 20px 0;
        text-align: center;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 10; /* Ensure header stays on top */
    }

    footer {
        background-color: #181818; /* Dark background */
        padding: 20px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 10; /* Ensure header stays on top */
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #4CAF50; /* Green for the title */
    }

    .footer-text {
        font-size: 1rem;
        color: #888; /* Light gray for footer text */
    }

    /* Animation */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* New styles for the news content */
    .news-content {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .news-content p {
        margin-bottom: 10px;
    }

    /* Footer Styling */
    .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        margin-top: 40px; /* Add some spacing above the footer */
    }

    .footer-logo {
        margin-right: 20px;
    }

    .footer-links {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-right: 20px;
    }

    .footer-links a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #4CAF50;
    }

    .footer-newsletter {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .footer-newsletter input[type="email"] {
        padding: 8px;
        border: 1px solid #fff;
        border-radius: 5px 0 0 5px;
        margin-right: 5px;
    }

    .footer-newsletter button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 0 5px 5px 0;
        padding: 8px 15px;
        cursor: pointer;
    }

    .footer-newsletter button:hover {
        background-color: #3e8e41;
    }

    .footer-payment {
        display: flex;
        margin-top: 10px;
    }

    .footer-payment img {
        margin-right: 10px;
    }

    .footer-copyright {
        text-align: center;
        margin-top: 20px;
        font-size: 0.8rem;
        color: #888;
    }

    /* Responsive Design for Footer */
    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
        }

        .footer-links {
            flex-direction: column;
        }

        .footer-links li {
            margin-bottom: 10px;
            margin-right: 0;
        }

        .footer-newsletter {
            margin-top: 10px;
        }
    }
</style>
</head>

<body class="bcolor">
    <?php include 'navbars.php';?>

    <div class="container mt-5">
        <?php 
        // Include database connection file
        require_once 'db/config.php'; 

        // Get the news ID from the URL
        $newsId = $_GET['id'];

        // Prepare SQL query to fetch news details
        $sql = "SELECT * FROM news WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $newsId);

        // Execute the query
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                // Display news details
                echo "<h2 class='news-title'>{$row['title']}</h2>";
                if ($row['image'] != '') {
                    echo "<img src='{$row['image']}' alt='News Image' class='news-image'>";
                }
             

               echo "<div class='col-12'>
                <div class='row'>
                    <div class='col-12'>
                        <label class='dsl form-label fs-4 fw-bold'>Description : </label>
                    </div>
                    <div class='col-12'>
                        <textarea cols='60' rows='10' class='form-control' readonly>
                        {$row['description']}
                        </textarea>
                    </div>
                </div>
            </div>";







                if ($row['link'] != '') {
                    echo "<a href='{$row['link']}' class='news-link'>Read More</a>";
                }
            } else {
                echo "<p>News not found.</p>";
            }
        } else {
            echo "<p>Error fetching news details.</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="images\partY__1_-removebg-preview.png" alt="Nimsara Computers Logo" width="150"> </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Clothing Store</a></li>
                    <li><a href="#">Trending Shoes</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Payment Method</a></li>
                    <li><a href="#">Delivery</a></li>
                    <li><a href="#">Return and Exchange</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <input type="email" placeholder="Your Email" required>
                <button type="submit">Subscribe</button>
            </div>
        </div>
        <div class="footer-payment">
            <img src="https://i.postimg.cc/Nj9dgJ98/cards.png" alt="PayPal">
        </div>
        <div class="footer-copyright">
            <p>Nimsara computers: All Right Resolved</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>