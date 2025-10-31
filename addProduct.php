<?php

include "db/connections.php";
session_start();
if (isset($_SESSION["sup"])) {
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | eShop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resource/logo.svg">
    <style>
        body {
            background-image: url("images/blue-glow-hexagon-gradient-white-black-3840x2160-c4-000000-ffffff-00008b-000000-l2-4-128-a-15-f-6.svg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .form-title {
            font-size: 30px;
            color: #ffcc00;
            margin-bottom: 15px;
        }

        .form-control, .form-select {
            background-color: #222;
            color: white;
            border: 1px solid #555;
            border-radius: 10px;
            padding: 10px;
        }

        .btn-custom {
            background-color: #1a1a1a;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 18px;
        }

        .btn-custom:hover {
            background-color: #333;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "navbaes.php"; ?>

            <div class="container mt-5 form-container">
                <h1 class="text-center text-primary mb-4">Insert Product</h1>

                <div class="row justify-content-center mb-4">
                    <img src="default_img/default-product.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px;" id="i0">
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="upload-btn-wrapper">
                        <button class="btn btn-custom bi bi-exposure">Upload Images</button>
                        <input type="file" multiple id="imageuploader" onchange="changeProductImage();" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-title">Product Title</label>
                    <input type="text" class="form-control" id="title">
                </div>

                <div class="form-group">
                    <label class="form-title">Product Description</label>
                    <textarea class="form-control" id="desc" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-title">Quantity</label>
                    <input type="number" class="form-control" id="qty" min="0" step="1">
                </div>

                <div class="form-group">
                    <label class="form-title">Select Product Category</label>
                    <select class="form-select" id="category">
                        <option value="0">Select Category</option>
                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <option value="<?php echo $category_data["category_id"]; ?>">
                                <?php echo $category_data["category_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-title">Select Product Model</label>
                    <select class="form-select" id="model">
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
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-title">Select Product Brand</label>
                    <select class="form-select" id="brand">
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
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-title">Product Price</label>
                    <input type="number" class="form-control" id="cost" min="0" step="1">
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-custom" onclick="addProduct();">Sell Product</button>
                </div>
            </div>

            <?php include "main footer.php"; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="swalw2.js"></script>
    <script src="swalw.js"></script>
</body>

</html>

<?php
} else {
    header("Location: adminsingin.php");
}
?>
