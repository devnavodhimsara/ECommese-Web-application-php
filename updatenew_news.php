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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description']; // Get the description from the form

    // Handle image upload
    $image_name = '';
    $imagePath = ''; // Variable to store the full image path
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Define allowed image types
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_parts = pathinfo($_FILES['image']['name']);
        $extension = strtolower($file_parts['extension']);

        // Check if the file type is allowed
        if (in_array($extension, $allowed_types)) {
            // Generate a unique filename
            $image_name = uniqid() . '.' . $extension;
            $target_dir = 'navod/'; // Folder to store uploaded images
            $target_file = $target_dir . $image_name;
            $imagePath = $target_dir . $image_name; // Store the full image path

            // Move uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Image uploaded successfully
            } else {
                // Error uploading image
                echo 'Error uploading image.';
            }
        } else {
            // Invalid file type
            echo 'Invalid image type.';
        }
    }

    // Prepare SQL query to insert data - Include the description column
    $sql = "INSERT INTO news (title, date, image, description, link) VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Create a variable to hold the empty string
    $link = '';

    // Bind parameters to prevent SQL injection - Include the $description variable
    $stmt->bind_param("ssss", $title, $imagePath, $description, $link); 

    // Execute the query
    if ($stmt->execute()) {
        // Success! Redirect to news listing page 
        header('Location: news_list.php'); 
        exit();
    } else {
        // Error inserting data
        echo 'Error inserting data: ' . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            background-color: #181818; /* Darker background */
            color: #fff;
            font-family: 'Poppins', sans-serif; 
            overflow-x: hidden; 
        }
        .container {
            background-color: #282c34; /* Slightly lighter background for the form */
            padding: 30px; 
            border-radius: 15px; 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); 
            max-width: 800px; 
            margin: 30px auto; 
        }
        .form-label {
            font-weight: bold;
            font-size: 1.8rem; 
            color: #f5f5f5; /* Light gray for better contrast */
        }
        .form-control {
            font-size: 1.4rem; 
            padding: 15px;
            background-color: #212529; 
            border: 1px solid #495057; 
            color: #ddd; /* Lighter text for readability */
        }
        .btn-success {
            background-color: #4CAF50; /* Green color with more vibrancy */
            border: none;
            padding: 15px 30px; 
            font-size: 1.4rem; 
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
        }
        .btn-success:hover {
            background-color: #3e8e41; /* Darker green on hover */
            transform: scale(1.05); 
        }
        .form-group {
            margin-bottom: 30px; 
        }
        #title, #description {
            border-radius: 8px; 
        }
        #image {
            border: 1px dashed #ccc; 
            border-radius: 8px; 
            padding: 15px;
            text-align: center;
            font-size: 1.2rem; 
        }
        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .container {
                max-width: 90%; 
                padding: 25px;
            }
            .form-group {
                margin-bottom: 25px;
            }
        }
        /* Header & Footer Styling */
        header {
            background-color: #181818;
            padding: 20px 0;
            text-align: center;
        }
        footer {
            background-color: #181818;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .header-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4CAF50; /* Green color for the title */
        }
        .footer-text {
            font-size: 1rem;
            color: #888;
        }
        /* Animation for Fonts */
        .animate-text {
            animation: fadeInUp 1.2s ease-in-out;
        }
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
    </style>
</head>
<body>
<?php include 'navbars.php';?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <center> <label class="form-label fw-bold" style="font-size: 32px;">Update News</label></center>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" enctype="multipart/form-data" id="newsForm">
                    <div class="form-group">
                    <label for="title" class="form-label animate-text">Title:</label>
  <center><input type="text" class="form-control animate-text" name="title" id="title" required></center>
                    </div>
                    <label for="description" class="form-label animate-text">Description:</label>
                    <div class="form-group">
                        
                       <center> <textarea cols="30" rows="10" class="form-control animate-text" name="description" id="description"></textarea></center>
                    </div>





                    
                    <div class="form-group">
                        <label for="image" class="form-label animate-text">Upload Image:</label>
                        <input type="file" class="form-control animate-text" name="image" id="image" accept="image/*">
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <center>  <button type="submit" class="btn btn-success animate-text">Update News</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p class="footer-text animate-text">Copyright © 2024 Nimsara_computers. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje3t+tJSDkhd+r81Q96jFC+qZMGnPI+c==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add animation for form elements on focus
            const formInputs = document.querySelectorAll('#newsForm input, #newsForm textarea');
            formInputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.style.transition = 'box-shadow 0.2s ease-in-out';
                    input.style.boxShadow = '0 0 10px #007bff';
                });
                input.addEventListener('blur', () => {
                    input.style.boxShadow = 'none';
                });
            });
        });
        
    </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>