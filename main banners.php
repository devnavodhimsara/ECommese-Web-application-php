<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="fevicone\favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page_update!Nimsara_computers</title>
    <style>
        body {
            background-color: #282828; /* Dark background */
            color: #fff; /* White text */
            font-family: 'Roboto', sans-serif;
        }

        .container {
            background-color:black; /* Slightly lighter background for content */
            padding: 20px;
            border-radius: 10px;
        }

        .form-label,
        .btn {
            color: #fff; /* White text for labels and buttons */
        }

        .btn-primary {
            background-color: #007bff; /* Blue button */
            border: none;
        }

        .btn-primary:hover {
            background-color: #0069d9; /* Darker blue on hover */
        }

        .img-fluid {
            animation: fadeInOut 3s ease-in-out infinite; /* Add fade-in/out animation */
            max-width: 100%; /* Ensure images scale responsively */
            height: auto; /* Maintain aspect ratio */
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        /* Responsive Styling for Smaller Screens */
        @media (max-width: 768px) {
            .offset-lg-3 {
                /* Remove offset for smaller screens */
                offset: 0;
            }

            .col-lg-6 {
                /* Make columns full width on smaller screens */
                width: 100%;
            }

            .img-fluid {
                width: 100%; /* Images fill full width */
                height: auto; /* Maintain aspect ratio */
            }
        }
    </style>
</head>

<body>
    <?php
    session_start(); 
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php");
        exit;
    }
    ?>
    <?php include 'adminnavbar.php';?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <center> <label class="form-label fw-bold" style="font-size: 20px;">Change main banners</label>
                </center>
            </div>
            <div class="offset-lg-3 col-12 col-lg-6">
                <div class="row">
                    <form method="POST" action="upload_banners.php" enctype="multipart/form-data">
                        <div class="col-12 border border-primary rounded mb-3">
                            <img src="AUTOMATED FUTURE.png" class="img-fluid" id="i0" />
                        </div>
                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mb-3">
                            <label class="form-label" for="banner1Upload">Select Image 1:</label>
                            <input type="file" class="form-control" name="banner1" id="banner1Upload" accept="image/*"
                                onchange="previewImage(this, 'i0')"/>
                        </div>
                        <button class="col-12 btn btn-primary" type="submit" name="updateBanner1">Update Image</button>

                        <div class="col-12 border border-primary rounded mb-3">
                            <img src="AUTOMATED FUTURE.png" class="img-fluid" id="i1" />
                        </div>
                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mb-3">
                            <label class="form-label" for="banner2Upload">Select Image 2:</label>
                            <input type="file" class="form-control" name="banner2" id="banner2Upload" accept="image/*"
                                onchange="previewImage(this, 'i1')"/>
                        </div>
                        <button class="col-12 btn btn-primary" type="submit" name="updateBanner2">Update Image</button>

                        <div class="col-12 border border-primary rounded mb-3">
                            <img src="AUTOMATED FUTURE.png" class="img-fluid" id="i2" />
                        </div>
                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mb-3">
                            <label class="form-label" for="banner3Upload">Select Image 3:</label>
                            <input type="file" class="form-control" name="banner3" id="banner3Upload" accept="image/*"
                                onchange="previewImage(this, 'i2')"/>
                        </div>
                        <button class="col-12 btn btn-primary" type="submit" name="updateBanner3">Update Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function previewImage(input, imgId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(imgId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
       
        window.onload = function () {
            const successMessage = document.querySelector("#upload_response").textContent.trim();
            if (successMessage === "Banner updated successfully!") {
              
                setTimeout(() => {
                    alert("Banner updated successfully!");
                    window.location.href = "admindashboard.php";
                }, 1000);
            }
        };
    </script>

</body>
<?php
      include 'main footer.php';
      ?>
</html>