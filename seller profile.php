

<?php

include "db\connections.php";
session_start();
if (isset($_SESSION["sup"])) {





?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | eShop</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="fevicone/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .container-fluid {
            margin-top: 20px;
        }

        .profile-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background-color: #007bff;

            padding: 20px;
            text-align: center;
        }

        .profile-header h4 {
            margin: 0;
        }

        .profile-body {
            padding: 20px;
        }

        .profile-img {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .profile-img img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #007bff;
        }

        .form-label {
            font-weight: bold;
        }


        .update-button {

            color: white;
            font-weight: bold;
        }

        .update-button:hover {
            background-color: #218838;
        }

        .ads-section {
            padding: 20px;
        }

        .ads-section span {
            display: block;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php
            require "navbaes.php";
         

            if (isset($_SESSION["sup"])) {
                $email = $_SESSION["sup"]["username"];
                $details_rs = Database::search("SELECT * FROM `sellers` WHERE `username`='$email'");
                $user_details = $details_rs->fetch_assoc();
            ?>
                <div class="col-12 col-md-10 col-lg-8 profile-container">
                    <div class="bg-primary text-dark text-center">
                        <h4 class=" bi-person-circle">Seller Profile Settings</h4>
                    </div>
                    <div class="profile-body ">
                        <div class="row">
                            <div class="col-md-3 text-center profile-img">
                                <?php if (empty($user_details["profile_image"])) { ?>
                                    <img src="resource/new_user.svg" id="img" />
                                <?php } else { ?>
                                    <img src="<?php echo $user_details["profile_image"]; ?>" id="img" />
                                <?php } ?>

                                <input type="file" class="d-none" id="profileimage" name="profileimage" accept="image/*">
                                <input type="file" class="d-none" id="profileimage" name="profileimage" accept="image/*">

                                <label for="profileimage" class="btn btn-success btn-sm mt-2" onclick="changeProfileImg();">
                                    <i class="bi bi-plus-lg ms-3"></i> Update Profile Image
                                </label>
                                <div class="row"> <span class="fw-bold text-dark"><?php echo $user_details["email"]; ?></span>
                                    <span class="fw-bold  text-dark"><?php echo $email; ?></span>
                                </div>
                            </div>
                            <div class="col-md-5 border-end">
                                <div class="p-3">
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <label class="form-label text-dark">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="<?php echo $user_details["password"]; ?>" readonly />
                                                <span class="input-group-text bg-primary">
                                                    <i class="bi bi-eye-slash-fill text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Email</label>
                                            <input type="text" class="form-control" readonly value="<?php echo $user_details["email"]; ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">First Name</label>
                                            <input type="text" class="form-control" value="<?php echo $user_details["first_name"]; ?>" id="fname" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-dark">Last Name</label>
                                            <input type="text" class="form-control" value="<?php echo $user_details["last_name"]; ?>" id="lname" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-dark">Address Line 1</label>
                                            <input type="text" class="form-control" value="<?php echo $user_details["address_line1"]; ?>" id="ad1" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-dark">Address Line 2</label>
                                            <input type="text" class="form-control" value="<?php echo $user_details["address_line2"]; ?>" id="ad2" />
                                        </div>
                                        <div class="col-12 d-grid mt-4">
                                            <button class="btn btn-outline-info btn btn-secondary" onclick="updateProfile();">Update My Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ads-section">
                                <span>

                                </span>
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="AUTOMATED FUTURE.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="AUTOMATED FUTURE.png" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="AUTOMATED FUTURE.png" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                    <img class="mt-5 ms-5" src="https://i.postimg.cc/Nj9dgJ98/cards.png" alt="cards">
                                </div>
                                <div class="text-center mt-3"><button class="btn btn-primary text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                        whats the nimsara computers
                                    </button></div>
                                </p>
                                <div style="min-height: 120px;">
                                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                        <div class="card card-body" style="width: 300px;">
                                            Nimsara Computers is a trusted retailer and service provider specializing in computer hardware, software, and related accessories. They offer a wide range of products, including laptops, desktops, peripherals, and networking equipment, catering to both individual and business needs. Known for their excellent customer service and technical expertise, Nimsara Computers also provides repair and maintenance services, ensuring that clients receive comprehensive support for all their computing requirements.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            <?php
            } else {
            ?>
                <script>
                    window.location = "index.php";
                </script>
            <?php
            }
            ?>
        </div>

    </div>

    <p>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <?php require "main footer.php"; ?>
        <script src="swalw2.js"></script>
            <script src="swalw.js"></script>

</body>

</html>


<?php

} else {
    header("Location:sellersingin.php");
}


?>