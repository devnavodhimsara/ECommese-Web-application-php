<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<?php
session_start();
if (isset($_SESSION["u"])) {
   // Include navigation bar
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search | Nimsara Computers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="fevicone\favicon.ico">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .btn-outline-light {
            color: #ffffff;
            border-color: #ffffff;
        }

        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #000000;
        }

        .form-select, .form-control {
            background-color: #2c2c2c;
            color: #e0e0e0;
        }

        .form-select:focus, .form-control:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .25);
        }

        .text-light {
            color: #e0e0e0;
        }

        .bg-secondary {
            background-color: #1f1f1f;
        }

        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .title01 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .main-body {
            padding: 2rem;
        }
    </style>
</head>
<?php
  include "navbars.php";
?>
<body class="bg-dark text-light main-body">
    <header class="py-3 text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 logo"></div>
                <div class="col-12">
                    <p class="text-center title01">Hi, Welcome to Nimsara Computers</p>
                </div>
            </div>
        </div>
    </header>

    <main class="container mt-4">
        <div class="row mb-3">
            <div class="col-12 rounded shadow p-4 bg-secondary text-light">
                <h2 class="mb-3">Advanced Search</h2>
                <div class="row text-center">
                    <div class="col-md-8 mb-3">
                        <input type="text" class="form-control" placeholder="Type keyword to search..." id="t">
                    </div>
                    <div class="col-md-2 mb-3 text-center">
                        <button class="btn btn-outline-light w-100" onclick="advancedSearch(0);">Search</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="c1" class="form-label">Category</label>
                        <select class="form-select" id="c1">
                            <option value="0">Select Category</option>
                            <?php
                            include "db/connections.php"; // Include database connection file
                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;
                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["category_id"]; ?>">
                                    <?php echo $category_data["category_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="b1" class="form-label">Brand</label>
                        <select class="form-select" id="b1">
                            <option value="0">Select Brand</option>
                            <?php
                            $brand_rs = Database::search("SELECT * FROM `brand`");
                            $brand_num = $brand_rs->num_rows;
                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $brand_data["brand_id"]; ?>">
                                    <?php echo $brand_data["brand_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="m" class="form-label">Model</label>
                        <select class="form-select" id="m">
                            <option value="0">Select Model</option>
                            <?php
                            $model_rs = Database::search("SELECT * FROM `model`");
                            $model_num = $model_rs->num_rows;
                            for ($x = 0; $x < $model_num; $x++) {
                                $model_data = $model_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $model_data["model_id"]; ?>">
                                    <?php echo $model_data["model_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="pf" class="form-label">Price From</label>
                        <input type="text" class="form-control" placeholder="Price From..." id="pf">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pt" class="form-label">Price To</label>
                        <input type="text" class="form-control" placeholder="Price To..." id="pt">
                    </div>
                </div>

                <div class="row">
                    <!-- Additional search filters can go here -->
                </div>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 bg-secondary rounded shadow p-4">
                <label for="s" class="form-label">Sort By</label>
                <select id="s" class="form-select">
                    <option value="0">SORT BY</option>
                    <option value="1">PRICE LOW TO HIGH</option>
                    <option value="2">PRICE HIGH TO LOW</option>
                    <option value="3">QUANTITY LOW TO HIGH</option>
                    <option value="4">QUANTITY HIGH TO LOW</option>
                </select>
            </div>
        </div>

        <div class="row mb-3" id="view_area">
            <div class="col-12 bg-secondary rounded shadow p-4 text-center">
                <i class="bi bi-search h1" style="font-size: 100px; color: #6c757d;"></i>
                <h2 class="mb-3" style="color: #6c757d;">No Items Searched Yet...</h2>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

<?php
} else {
    header("Location: loging.php");
}
?>
<?php include "main footer.php"; ?>
</html>
