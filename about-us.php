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
<html>
<head>
  <title>Nimsara Computers</title>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color:black; /* Dark background */
      color: black; /* Light text */
      margin: 0; /* Reset default margins */
      line-height: 1.6; /* Improve readability */
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
    }

    h1, h2 {
      color: #007bff; /* Blue heading color */
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    ul {
      list-style-type: disc;
      padding-left: 40px;
    }

    a {
      color: #007bff; /* Blue link color */
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Section styling for better visual separation */
    section {
      margin-bottom: 40px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.05); /* Slightly lighter background for sections */
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow effect */
    }

    /* Animation for the main heading */
    @keyframes slideInFromLeft {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }
    .bac1{
        background-color:dark;
    }

    h1 {
      animation-name: slideInFromLeft;
      animation-duration: 1s;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="fevicone\favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include 'navbars.php';?>
  <div class="container">
    <section class="bac1">
      <h1>Nimsara Computers</h1>
    </section>

    <section>
      <h2>Welcome!</h2>
      <p>
        At Nimsara Computers, we are passionate about technology and dedicated to providing top-notch products and services to meet all your computing needs. Founded with a vision to deliver excellence, we have grown to become a trusted name in the computer retail and service industry.
      </p>
    </section>

    <section>
      <h2>Our Mission</h2>
      <p>
        Our mission is to empower individuals and businesses with cutting-edge technology solutions that enhance productivity and innovation. We strive to provide exceptional customer service, ensuring that every client receives personalized attention and support.
      </p>
    </section>

    <section>
      <h2>What We Offer</h2>
      <ul>
        <li>Wide Range of Products: From the latest laptops, desktops, and peripherals to software and accessories, we offer a comprehensive selection of high-quality products from leading brands.</li>
        <li>Custom-Built PCs: Tailor-made systems designed to meet your specific requirements, whether for gaming, professional use, or everyday computing.</li>
        <li>Expert Repairs and Upgrades: Our skilled technicians are ready to handle any repair or upgrade, ensuring your devices run smoothly and efficiently.</li>
        <li>Networking Solutions: We provide reliable networking services to keep your home or business connected and secure.</li>
        <li>Consultation and Support: Our knowledgeable team is here to assist you with any questions or concerns, providing expert advice and solutions tailored to your needs.</li>
      </ul>
    </section>

    <section>
      <h2>Why Choose Us?</h2>
      <ul>
        <li>Experience and Expertise: With years of experience in the industry, our team possesses the knowledge and skills to address all your computing needs.</li>
        <li>Customer-Centric Approach: We prioritize customer satisfaction, offering friendly and reliable service that you can count on.</li>
        <li>Quality Assurance: We only stock products from reputable brands, ensuring that you receive the best quality and performance.</li>
        <li>Competitive Pricing: Our pricing is transparent and competitive, providing excellent value for your money.</li>
        <li>Community Focus: As a locally-owned business, we are committed to supporting our community and contributing to its growth and development.</li>
      </ul>
    </section>

    <section>
      <h2>Visit Us</h2>
      <p>
        Conveniently located at galgamuwa north maharachchimulla, our store is designed to provide a welcoming and informative shopping experience. Whether you're looking for a new computer, need technical support, or simply want to explore the latest tech trends, we invite you to visit Nimsara Computers and discover the difference.
      </p>

      <p>Thank you for choosing Nimsara Computers. We look forward to serving you!</p>
    </section>

    <section>
      <h2>Contact Us</h2>
      <ul>
        <li>Phone: <a href="tel:+94763423663">+94 76 342 3663</a></li> 
        <li>Email: <a href="mailto:nhanavodhimsara77@gmail.com">nhanavodhimsara77@gmail.com</a></li>
        <li>Address: galgamuwa north maharachchimulla</li>
        <li>Store Hours: 24/7</li>
      </ul>
    </section>

  </div>
</body>
<?php include 'main footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="swalw2.js"></script>
            <script src="swalw.js"></script>
</html>