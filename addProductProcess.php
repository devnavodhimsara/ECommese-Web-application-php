<?php

session_start();
include "db/connections.php";

$email = $_SESSION["sup"]["username"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$cost = $_POST["co"];
$desc = $_POST["de"];
$qty = $_POST["qty"];

// Input Validation
if (empty($title)) {
    echo "Please Enter Your product title.";
    exit; 
} else if (empty($desc)) {
    echo "Please Enter Your product details.";
    exit; 
} else if (empty($qty)) {
    echo "Please enter your product qty.";
    exit;
} else if ($qty <= 1) { 
    echo "Product qty must be greater than 1.";
    exit;
} else if (empty($category)) {
    echo "Please select your product category.";
    exit;
} else if (empty($model)) {
    echo "Please select your product model.";
    exit;
} else if (empty($brand)) {
    echo "Please select your brand.";
    exit;
} else if (empty($cost)) {
    echo "Please enter your product price.";
    exit; 
} else if ($cost <= 1) { 
    echo "Product price must be greater than 1.";
    exit;
}

// Check if model and brand combination exists in the database
$mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "' AND 
`brand_brand_id`='" . $brand . "'");

$model_has_brand_id;

if ($mhb_rs->num_rows > 0) {
    $mhb_data = $mhb_rs->fetch_assoc();
    $model_has_brand_id = $mhb_data["id"];
} else {
    // If not, insert a new entry into model_has_brand
    Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES 
    ('" . $model . "','" . $brand . "')");
    $model_has_brand_id = Database::$connection->insert_id;
}

// Set product status to 1 (active)
$status = 1;

// Insert new product into the database
Database::iud("INSERT INTO `products`(`price`,`description`,`title`,`category_id`,`category_category_id`,`model_has_brand_id`,`qty`,`status`,
`sellers_username`) VALUES ('" . $cost . "','" . $desc . "','" . $title . "',
'" . $category . "','" . $model . "','" . $model_has_brand_id . "','" . $qty . "','" . $status . "','" . $email . "')");

$product_id = Database::$connection->insert_id;

// Image Upload Section
// Check if images were uploaded
if (isset($_FILES) && !empty($_FILES)) {

    $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

    $length = sizeof($_FILES);
    if ($length > 3) {
        echo "Invalid Image Count. Maximum allowed: 3";
        exit;
    }

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["image" . $x])) {
            $image_file = $_FILES["image" . $x];
            $file_extension = $image_file["type"];

            if (in_array($file_extension, $allowed_image_extensions)) {
                // Determine new image extension based on type
                $new_img_extension = "";
                if ($file_extension == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $new_img_extension = ".png";
                } else if ($file_extension == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                // Generate unique filename and move uploaded file
                $file_name = "navod//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                if (!move_uploaded_file($image_file["tmp_name"], $file_name)) {
                    echo "Error uploading image.";
                    exit;
                }

                // Insert image information into product_images table
                Database::iud("INSERT INTO `product_images`(`path`,`product_id`) VALUES 
            ('" . $file_name . "','" . $product_id . "')");
            } else {
                echo "Invalid image type.";
                exit; 
            }
        }
    }

    echo "success"; // Success message if image upload is successful
} else {
    echo "No images uploaded.";
}

?>