<?php


require_once 'db/config.php'; 


?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimsara Computers - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" href="fevicone/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        /* Basic Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212; 
            color: #eee; 
            cursor: url('images/blue.png'), auto; 
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #eee;
        }

        h1 {
            text-align: center;
            animation: fade-in 1s ease-in-out; 
            margin-bottom: 30px; /* Add spacing below the title */
        }

        p {
            line-height: 1.6;
            color: #ccc; 
        }

        /* Image Styling */
        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }

        .team-member img:hover {
            transform: scale(1.1);
        }

        /* Team Section */
        .team {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .team-member {
            text-align: center;
            margin-bottom: 30px;
            width: 45%; 
            animation: slide-up 1s ease-in-out; 
            background-color: #1f1f1f; /* Add background color to team member */
            padding: 20px;
            border-radius: 10px;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slide-up {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%; 
            }

            .team-member {
                width: 90%; 
            }
        }

        /* Remove Dropdown Area (Assuming you mean from the navbar) */
    
    </style>

</head>
<body class="main-body">



    <div class="container">
    <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i>Back</button>
        <h1>About Nimsara Computers</h1>

        <p>Welcome to Nimsara Computers! We are a team of technology enthusiasts dedicated to providing you with the best computer solutions and exceptional customer service.</p>

        <h2>Our Story</h2>
        <p>Established in 2020, Nimsara Computers was born out of a passion for all things tech. Our journey began with a mission to make quality computer services accessible to everyone. Over the years, we've grown alongside the ever-evolving technological landscape, constantly adapting and expanding our expertise to meet the diverse needs of our valued customers. </p>

        <h2>Our Values</h2>
        <ul>
            <li>Quality: We offer only the best products and services.</li>
            <li>Customer Focus: Your satisfaction is our top priority.</li>
            <li>Integrity: We operate with honesty and transparency.</li> 
        </ul>

        <h2>Meet Our Teams</h2>
        <div class="team">
            <div class="team-member">
             
                <h3>Nimsara Computers Group 1</h3>
                <p>Specializing in hardware solutions, Nimsara Computers Group 1 diagnoses and repairs computer issues, ensuring your devices run smoothly.</p>
            </div>

            <div class="team-member">
              
                <h3>Nimsara Computers Group 2</h3>
                <p>Focused on software and networks, Nimsara Computers Group 2  tackles software glitches, optimizes performance, and strengthens your online security.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
      include 'main footer.php';
    ?>
      <script src="swalw2.js"></script>
            <script src="swalw.js"></script>
</body>
</html>