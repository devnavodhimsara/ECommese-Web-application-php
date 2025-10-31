<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Nimsara Computers</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="icon" href="fevicone/favicon.ico" />
    <style>
        /* General Body Styling */
        .main-body {
            background-color: transparent; /* Transparent background */
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }

        /* Carousel Item Styling */
        .carousel-item {
            position: relative;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item img {
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item:hover img {
            transform: scale(1.05);
        }

        /* Carousel Caption Styling */
        .carousel-caption {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
        }

        .carousel-caption h5,
        .carousel-caption p {
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for text */
            padding: 10px;
            border-radius: 5px;
        }

        /* Card Styling */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            border: 1px solid transparent;
            background-color: rgba(44, 44, 44, 0.8); /* Semi-transparent dark background */
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
        }

        .card-img-top {
            border-radius: 10px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .card-img-top:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }

        .card-title {
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .card-title:hover {
            color: #00bfff;
        }

        .card-text {
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for text */
            padding: 5px;
            border-radius: 3px;
        }

        /* Button Styling */
        .btn-primary {
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(51, 51, 51, 0.8); /* Semi-transparent background for primary button */
            border-color: rgba(51, 51, 51, 0.8);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004494;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .btn-success {
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Form Control Focus */
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            border-color: #007bff;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .carousel-item img {
                height: auto;
            }

            .card {
                width: 100%;
            }
        }
    </style>
</head>

<body class="main-body">
    <?php
    include "db/connections.php";
    session_start();
    if (isset($_SESSION["u"])) {
    ?>

    <div>
        <?php include "navbars.php"; ?>

        <div class="d-flex mt-3 container animate__animated animate__fadeIn" role="search">
            <input class="form-control me-2 animate__animated animate__fadeIn" type="search" placeholder="Search" aria-label="Search" id="basic_search_txt">
            <button class="btn btn-outline-success animate__animated animate__fadeIn" onclick="basicSearch(0);">Search</button>
            <a href="advancedsearch.php" class="btn btn-outline-primary ms-2 animate__animated animate__fadeIn">Advanced Search</a>
        </div>

        <div class="col-12" id="basicSearchResult">
            <div id="carouselExample" class="carousel slide container-fluid mt-3 animate__animated animate__fadeIn">
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <div class="carousel-caption">
                            <h5 class="animate__animated animate__fadeIn">Innovation at its Best</h5>
                            <p class="animate__animated animate__fadeIn">Discover our range of products.</p>
                        </div>
                        <img src="default_img/66589827ea566_AUTOMATED FUTURE.png" class="d-block w-100 animate__animated animate__fadeIn" alt="...">
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
            </div>

            <?php
            $category_rs2 = Database::search("SELECT * FROM `category`");
            $category_num2 = $category_rs2->num_rows;

            for ($y = 0; $y < $category_num2; $y++) {
                $category_data2 = $category_rs2->fetch_assoc();
            ?>
            <div class="col-12 mt-3 mb-3 animate__animated animate__fadeIn">
                <a href="#" class="text-decoration-none text-dark fs-3 fw-bold">
                    <button class="btn btn-primary ms-5 animate__animated animate__fadeIn">
                        <div> <?php echo $category_data2["category_name"]; ?></div>
                    </button>
                </a> 
            </div>

            <div class="col-12 mb-3">
                <div class="row border border-primary">
                    <div class="col-12">
                        <div class="row justify-content-center gap-2">
                            <?php
                            $product_rs = Database::search("SELECT p.*, pi.path FROM `products` p LEFT JOIN `product_images` pi ON p.id = pi.product_id WHERE p.category_id='" . $category_data2["category_id"] . "' AND p.status='1'");
                            $product_num = $product_rs->num_rows;

                            for ($z = 0; $z < $product_num; $z++) {
                                $product_data = $product_rs->fetch_assoc();
                            ?>
                            <div class="card col-6 col-lg-2 mt-2 mb-2 text-center animate__animated animate__fadeIn" style="width: 18rem;">
                                <div class="card-body">
                                    <img src="<?php echo $product_data["path"]; ?>" class="card-img-top img-thumbnail mt-2 animate__animated animate__fadeIn" style="height: 180px;" alt="<?php echo $product_data["title"]; ?>">
                                    Rs. <?php echo $product_data["price"]; ?>.00
                                    <?php if ($product_data["qty"] > 0) { ?>
                                        <span class="badge rounded-pill text-bg-warning bi bi-newspaper">In Stock</span>
                                    <?php } else { ?>
                                        <span class="badge rounded-pill text-bg-danger bi bi-layout-text-sidebar">Out Of Stock</span>
                                    <?php } ?>
                                    <h5 class="card-title fw-bold fs-6 animate__animated animate__fadeIn"><?php echo $product_data["title"]; ?></h5>
                                    <?php
                                    if ($product_data["qty"] > 0) {
                                    ?>
                                        <span class="card-text text-success fw-bold animate__animated animate__fadeIn"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                        <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="btn btn-success animate__animated animate__fadeIn">Buy Now</a>
                                        <button class="btn btn-primary animate__animated animate__fadeIn" onclick='addToCart(<?php echo $product_data["id"]; ?>);'>Add To Cart</button>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="card-text text-danger fw-bold animate__animated animate__fadeIn">0 Items Available</span><br /><br />
                                        <a href="index.php" class="btn btn-danger disabled animate__animated animate__fadeIn">Buy Now</a>
                                        <button class="btn btn-primary disabled animate__animated animate__fadeIn">Add To Cart</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } else { ?>
        <script>
            window.location = "index.php";
        </script>
    <?php } ?>
    <script src="script.js"></script>
    <script src="swalw2.js"></script>
            <script src="swalw.js"></script>
            <?php require "main footer.php"; ?>
</body>

</html>
