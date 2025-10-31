<?php

include "db/connections.php";

// Retrieve data from POST request
$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

// Initialize query and status
$query = "SELECT * FROM `products`";
$status = 0;

// Build the WHERE clause based on search criteria
if (!empty($search_txt)) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
}

if ($category != 0 && $status == 0) {
    $query .= " WHERE `category_category_id`='" . $category . "'";
    $status = 1;
} elseif ($category != 0 && $status != 0) {
    $query .= " AND `category_category_id`='" . $category . "'";
}

// Handle brand and model filtering
$pid = 0;
if ($brand != 0 && $model == 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");

    // Error Handling: Check if query executed successfully
    if ($model_has_brand_rs === false) {
        echo "Error: Query failed to execute (brand filter)";
        // Handle the error, e.g., log it, display a message, etc.
        exit; // Stop further execution
    }

    $model_has_brand_num = $model_has_brand_rs->num_rows;
    for ($x = 0; $x < $model_has_brand_num; $x++) {
        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
        $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand == 0 && $model != 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'");

    // Error Handling: Check if query executed successfully
    if ($model_has_brand_rs === false) {
        echo "Error: Query failed to execute (model filter)";
        // Handle the error, e.g., log it, display a message, etc.
        exit; // Stop further execution
    }

    $model_has_brand_num = $model_has_brand_rs->num_rows;
    for ($x = 0; $x < $model_has_brand_num; $x++) {
        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
        $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand != 0 && $model != 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' AND `model_model_id`='" . $model . "'");

    // Error Handling: Check if query executed successfully
    if ($model_has_brand_rs === false) {
        echo "Error: Query failed to execute (brand and model filter)";
        // Handle the error, e.g., log it, display a message, etc.
        exit; // Stop further execution
    }

    $model_has_brand_num = $model_has_brand_rs->num_rows;
    for ($x = 0; $x < $model_has_brand_num; $x++) {
        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
        $pid = $model_has_brand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

// Apply price filtering
if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` >= '" . $price_from . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `price` >= '" . $price_from . "'";
    }
}

if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` <= '" . $price_to . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `price` <= '" . $price_to . "'";
    }
}

if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    } elseif ($status != 0) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }
}

// Apply sorting
if ($sort == 1) {
    $query .= " ORDER BY `price` ASC";
}

// Handle pagination
$pageno = isset($_POST["page"]) && $_POST["page"] != "0" ? $_POST["page"] : 1;
$results_per_page = 6;

// Execute main query (after filtering and sorting)
$product_rs = Database::search($query);

// Error Handling: Check if main query executed successfully
if ($product_rs === false) {
    echo "Error: Query failed to execute (main query)";
    // Handle the error, e.g., log it, display a message, etc.
    exit; // Stop further execution
}

$product_num = $product_rs->num_rows;
$number_of_pages = ceil($product_num / $results_per_page);
$page_results = ($pageno - 1) * $results_per_page;

// Execute query with pagination
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

// Error Handling: Check if paginated query executed successfully
if ($selected_rs === false) {
    echo "Error: Query failed to execute (paginated query)";
    // Handle the error, e.g., log it, display a message, etc.
    exit; // Stop further execution
}

$selected_num = $selected_rs->num_rows;

// Display products
for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();

    $img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $selected_data["id"] . "'");

    // Error Handling: Check if image query executed successfully
    if ($img_rs === false) {
        echo "Error: Query failed to execute (image query)";
        // Handle the error, e.g., log it, display a message, etc.
        continue; // Skip to the next product
    }

    $img_data = $img_rs->fetch_assoc();

    // Display product details
?>
    <div class="offset-lg-1 col-12 col-lg-3">
        <div class="row">

            <div class="card col-6 col-lg-2 mt-2 mb-2 bi bi bi-bag text-center" style="width: 18rem;"> Rs. <?php echo $selected_data["price"]; ?> .00
                <?php if ($selected_data["qty"] > 0) { ?>
                    <span class="badge rounded-pill text-bg-warning bi bi-newspaper">In Stock</span>
                <?php } else { ?>
                    <span class="badge rounded-pill text-bg-danger bi bi-layout-text-sidebar">Out Of Stock</span>
                <?php } ?>
                <?php
                $img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $selected_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();
                ?>
                <img src="<?php echo $img_data["path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" alt="<?php echo $selected_data["title"]; ?>">
                <div class="card-body ms-0 m-0 text-center">
                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                    <div class="d-flex justify-content-center">


                    </div>
                    <?php
if ($selected_data["qty"] > 0) {
    // Check for status
    if ($selected_data["status"] != 1) {
        // Status is not 1, show "Add Now"
        ?>

<span class="card-text text-danger fw-bold">product pushed</span><br />
    <span class="card-text text-danger fw-bold">not selling this item </span><br /><br />
    <a href='#' class="col-12 btn btn-success disabled">
        Buy Now
    </a>

        <?php
    } else {
        // Status is 1, show "Buy Now"
        ?>

        <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
        <a href='<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>' class="col-12 btn btn-success">
            Buy Now
        </a>

        <?php
    }
} else {
    // Out of stock
    ?>

    <span class="card-text text-danger fw-bold">Out Of Stock</span><br />
    <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
    <a href='#' class="col-12 btn btn-success disabled">
        Buy Now
    </a>

    <?php
}
?>


                    <!-- Modal -->

                </div>
            </div>
        </div>

    </div>
    </div>

<?php
}

// Display pagination
?>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- </div>
    </div>
</div> -->