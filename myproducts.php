<?php

session_start();
include "db/connections.php";

if (isset($_SESSION["sup"])) {
    $username = $_SESSION["sup"]["username"];
    $pageno;

?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Products | Nimsara Computers</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="styles.css" />
        <link rel="icon" href="fevicone/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
        <style>
            .background_img {
                background-image: url("images/blue-glow-hexagon-gradient-white-black-3840x2160-c4-000000-ffffff-00008b-000000-l2-4-128-a-15-f-6.svg");
            }
            .card-img-top {
                width: 100%;
                height: auto; /* Maintain aspect ratio */
                max-height: 200px; /* Adjust based on your design */
                object-fit: cover; /* Crop the image to fit the container */
                border-radius: 15px; /* Optional: If you want rounded corners on the image */
            }
            .card {
                transition: transform 0.3s, box-shadow 0.3s;
                font-family: 'Roboto', sans-serif; /* Change the font */
                width: 100%;
                max-width: 350px; /* Adjust based on your design */
                margin: auto; /* Center the card in its container */
            }
            .card:hover {
                transform: scale(1.02); /* Slightly zoom in on hover */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
            }
            .card-title {
                font-weight: 700; /* Change font weight for title */
            }
            .card-text {
                font-weight: 400; /* Change font weight for text */
            }
        </style>
    </head>

    <body class="main-body">
        <?php
        include "navbaes.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <div>
                    <div class="row">
                        <div class="col-12 logo"></div>
                        <div class="col-12">
                            <p class="text-center title01 text-white">Hi, Welcome to Nimsara Computers</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">
                            <a href="addProduct.php" class="text-decoration-none text-dark">Add Product</a>
                        </button>
                    </div>

                    <div class="col-12 py-3 container">
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <?php

                                    if (isset($_GET["page"])) {
                                        $pageno = $_GET["page"];
                                    } else {
                                        $pageno = 1;
                                    }

                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `sellers_username`='" . $username . "'");
                                    $product_num = $product_rs->num_rows;

                                    $results_per_page = 5;
                                    $number_of_pages = ceil($product_num / $results_per_page);

                                    $page_results = ($pageno - 1) * $results_per_page;
                                    $selected_rs = Database::search("SELECT * FROM `products` WHERE `sellers_username`='" . $username . "' 
                                LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                    $selected_num = $selected_rs->num_rows;
                                    for ($x = 0; $x < $selected_num; $x++) {
                                        $selected_data = $selected_rs->fetch_assoc();
                                    ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <?php
                                                $product_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $product_img_data = $product_img_rs->fetch_assoc();
                                                ?>
                                                <div class="text-center"> 
                                                    <img src="<?php echo $product_img_data["path"]; ?>" class="card-img-top" alt="<?php echo $selected_data["title"]; ?>">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $selected_data["title"]; ?></h5>
                                                        <p class="card-text">Rs. <?php echo $selected_data["price"]; ?> .00</p>
                                                        <p class="card-text"><?php echo $selected_data["qty"]; ?> Items left</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="toggle<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status"] == 2) { ?> checked <?php } ?> />
                                                            <label class="form-check-label fw-bold text-info" for="toggle<?php echo $selected_data["id"]; ?>">
                                                                <?php if ($selected_data["status"] == 1) { ?>
                                                                    Make Your Product Deactive
                                                                <?php } else { ?>
                                                                    Make Your Product Active
                                                                <?php } ?>
                                                            </label>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <button class="btn btn-success fw-bold col-12" onclick="sendid(<?php echo $selected_data['id']; ?>);">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 py-3">
                        <div class="row justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);
                                                                    } ?>" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($x == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
                                                                    } ?>" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <script src="script.js"></script>
            <script src="js/bootstrap.bundle.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="swalw2.js"></script>
            <script src="swalw.js"></script>
        </div>
        <footer> <?php include 'main footer.php'; ?></footer>
    </body>

    </html>

<?php

} else {
    header("Location:home.php");
}

?>
