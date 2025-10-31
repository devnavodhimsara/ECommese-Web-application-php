<?php

include "db\connections.php";
session_start();
if (isset($_SESSION["admin"])) {





?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NIMSARA COMPUTERS - admindashboard</title>
        <link rel="stylesheet" href="styles.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="css\bootstrap.css" />
        <link rel="icon" href="fevicone\favicon.ico">
    </head>
    <?php
    include "adminnavbar.php";
    ?>

    <body class="main-body">

        <div class="text-center fst-italic">
            <lable style="font-size: 50px;">
                admin dashboard
            </lable>
        </div>

        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                background-color: #181818;
                color: #f0f0f0;
            }

            .background_img {
                background-image: url("images/bg.jpg");
            }

            .container {
                max-width: 960px;
                margin: 0 auto;
                padding: 20px;
            }




            @keyframes shine {
                100% {
                    transform: translateX(100%) skewX(-30deg);
                }
            }



            /* Dashboard Content Styles */
            .dashboard-content {
                display: flex;
                flex-direction: column;
                /* Stack elements vertically */
                justify-content: space-between;
                align-items: center;
                margin-top: 30px;
            }

            .user-profile {
                text-align: center;
            }

            .user-profile img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                object-fit: cover;
            }

            .user-info h3 {
                margin-top: 10px;
            }

            .user-info p {
                margin-bottom: 0;
            }

            /* Side Navigation Styles */


            .side-nav ul {
                list-style: none;
                margin: 0;
                padding: 0;

                flex-direction: column;
                /* Stack navigation items vertically */
            }

            .side-nav li {
                margin-bottom: 10px;
            }



            .side-nav a:hover {
                background-color: #333;
                /* Darker background on hover */
            }

            /* Main Content Styles */
            .main-content {
                flex: 1;
                padding: 20px;
            }

            .main-content h2 {
                margin-top: 0;
            }

            .dashboard-overview {
                background-color: #212529;
                /* Dark background for dashboard overview */
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
            }

            .dashboard-overview .overview-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .overview-item .icon {
                font-size: 24px;
                color: #5cb85c;
                /* Green color for icons */
            }

            .overview-item .value {
                font-size: 18px;
                font-weight: bold;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .dashboard-content {
                    flex-direction: column;
                    /* Stack elements vertically */
                }

                .side-nav {
                    width: 100%;

                }

                .main-content {
                    margin-left: 0;

                }

                .side-nav li {
                    margin-bottom: 5px;

                }
            }

            /* Button Styling */
            .side-nav li .btn {
                display: block;
                width: 100%;
                padding: 10px 15px;
                border-radius: 4px;

            }
        </style>
        <main>
            <div class="container">
                <div class="dashboard-content">
                    <div class="user-profile">
                     <?php
                        // Use a default image if the profile image is not set
                        if (isset($_SESSION["admin"])) {
                            $datas = $_SESSION["admin"]; {
                        ?>
                            <?php
                            }
                            ?>
                        <?php


                        }
                        ?>
                        <img src="<?php echo $datas['profile_image']; ?>" class="rounded-circle" width="30" height="30" onerror="this.src='default_img/256-2569650_men-profile-icon-png-image-free-download-searchpng.png'"> <!-- Default image on error -->
                    </div>
                    <p>Seller</p>
                </div>

                <div class="user-info">

                </div>
            </div>

            <div class="side-nav p-4">
                <ul>
                    <li><a href="admindashboard.php" class="btn btn-primary">Dashboard</a></li>
                    <li><a href="requestadmin.php" class="btn btn-primary">request admin</a></li>
                    <li><a href="admincustomer.php" class="btn btn-primary">Customers</a></li>
                    <li><a href="adminseller.php" class="btn btn-primary">sellers</a></li>

                    <li><a href="userandsellermesseges.php" class="btn btn-primary">seller and customer messeges</a>
                    <li>
                </ul>
            </div>

            <?php

            if (isset($_SESSION['admin'])) {
                $datas = $_SESSION['admin']; {
            ?>
                    <div class="main-content">
                        <h2 class="text-center fst-italic">your profile detailes</h2>
                        <div class="dashboard-overview">
                            <h3 class="text-center  fst-italic"><?php echo $datas["fname"] . " " . $datas["lname"]; ?></h3>
                            <h3 class="text-center  fst-italic"><?php echo $datas["email"]; ?></h3>
                        </div>
                    </div><?php } ?>
            <?php
            } else {
            ?>
                <!-- Handle the case where $datas is not defined -->
                <div class="main-content">
                    <div class="text-center fst-italic">your profile detailes</div>
                    <div class="dashboard-overview">
                        <div class="text-center fst-italic">Username not found</div>
                        <div class="text-center fst-italic">Email not found</div>
                    </div>
                </div>
            <?php
            }
            ?>



        </main>

        <?php include 'main footer.php'; ?>
        <script src="js\bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script src="swalw2.js"></script>
        <script src="swalw.js"></script>
    </body>


    </html>
<?php

} else {
    header("Location:adminsingin.php");
}


?>