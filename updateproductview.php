<?php session_start();

if (isset($_SESSION["sup"])) {
    if (isset($_SESSION["product"])) {

        include "db\connections.php";
        $product = $_SESSION["product"];

?>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>update product-NimsaraComputers</title>
            <link rel="stylesheet" href="css\bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="styles.css" />
            <link rel="icon" href="fevicone\favicon.ico">
            <link rel="icon" href="resource/logo.svg" />
        </head>
        <?php
        include "navbaes.php";
        ?>



        <body class="background_img ">
            <style>
                .background_img {
                    background-image: url("images/bg.jpg");
                }
            </style>
            <div class="row">
                <div class="col-12 logo"></div>
                <div class="col-12">
                    <p class="text-center title01 text-white">Update Your Product</p>
                </div>
            </div>
            <?php
            $category_rs = Database::search("SELECT * FROM `category` WHERE `category_id`='" . $product["category_id"] . "'");
            $category_data = $category_rs->fetch_assoc();
            ?>
            <div class="col-12 text-center fst-italic">
                <label class="form-label fw-bold" style="font-size: 20px;">Product Category</label>
            </div>
            <div class="col-12 container">
                <select class="form-select text-center" disabled>

                    <option><?php echo $category_data["category_name"]; ?></option>
                </select>
            </div>
            <div class="col-12 text-center fst-italic">
                <?php
                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` IN 
                                                    (SELECT `brand_brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                $brand_data = $brand_rs->fetch_assoc();
                ?>
                <label class="form-label fw-bold" style="font-size: 20px;">Brand</label>
            </div>
            <div class="col-12 container">
                <select class="form-select text-center" disabled>

                    <option><?php echo $brand_data["brand_name"]; ?></option>
                </select>
            </div>
            <div class="col-12 text-center fst-italic">
                <?php
                $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` IN 
                                                    (SELECT `model_model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                $model_data = $model_rs->fetch_assoc();
                ?>
                <label class="form-label fw-bold" style="font-size: 20px;">Model</label>
            </div>
            <div class="col-12 container">
                <select class="form-select text-center" disabled>

                    <option><?php echo $model_data["model_name"]; ?></option>
                </select>
            </div>
            <div class="col-12 text-center fst-italic">
                <label class="form-label fw-bold" style="font-size: 20px;"> Product Title</label>
            </div>
            <div class="col-12 container">
                <div>
                    <input type="text" class="form-control" value="<?php echo $product["title"]; ?>"   id="t"/>
                </div>
            </div>

            <div class="col-12 text-center fst-italic">
                <div class="row">
                    <div class="col-12 container">
                        <label class="form-label fw-bold" style="font-size: 20px;">Product Quantity</label>
                    </div>
                    <div class="col-12 container">
                        <input type="number" class="form-control col-12 container" min="0" value="<?php echo $product["qty"]; ?>" id="q" />
                    </div>
                </div>
            </div>

            <div class="col-12 text-center fst-italic">
                <label class="form-label fw-bold" style="font-size: 20px;"> Cost Per Item</label>
            </div>
            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                <div class="input-group mb-2 mt-2">
                    <span class="input-group-text">Rs.</span>
                    <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>" />
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            <div class="col-12 text-center fst-italic">
                <label class="form-label fw-bold" style="font-size: 20px;"> Product Descriptions</label>
            </div>
            <div class="col-12 container">
                <textarea cols="30" rows="15" class="form-control"  id="d"><?php echo $product["description"]; ?></textarea>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center fst-italic">
                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6">


                        <?php

                        $img = array();

                        $img[0] = "default_img\default-product.png";


                        $product_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $product["id"] . "'");
                        $product_img_num = $product_img_rs->num_rows;

                        for ($x = 0; $x < $product_img_num; $x++) {
                            $product_img_data = $product_img_rs->fetch_assoc();

                            $img[$x] = $product_img_data["path"];
                        }

                        ?>

                        <div class="text-center">
                            <div class="row text-center">
                                <div class="col-12 border border-primary rounded text-center">
                                    <img id="i0" src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center fst-italic mt-3">
                        <input type="file" class="d-none" id="imageuploader" multiple />
                        <label for="imageuploader" class="col-3 btn btn-primary" onclick="changeProductImage()">Upload Images</label>
                    </div>


                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                        <button class="btn btn-dark" onclick="updateProduct();">Update Product</button>
                    </div>
                </div>
            </div>

            <script src="script.js"></script>
            <script src="js\bootstrap.bundle.js"></script>
            <script src="swalw2.js"></script>
            <script src="swalw.js"></script>
        </body>
        <?php
        include "main footer.php";
        ?>
    <?php
    }
} else {
    ?>
    <script>
        alert("You have to signin to the system for access this function.");
        window.location = "home.php";
    </script>
 
<?php
}

?>

        </html>