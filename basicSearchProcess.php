<?php
include "db/connections.php";

$txt = isset($_POST["t"]) ? $_POST["t"] : ''; // Safe handling of POST data

$query = "SELECT * FROM `products` ";

if (!empty($txt)) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%'";
}

?>

<div class="container"> <!-- Use a container for better layout -->
    <div class="row">

        <?php

        $pageno = isset($_POST["page"]) && $_POST["page"] != "0" ? $_POST["page"] : 1;

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page =8;
        $number_of_pages = ceil($product_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        // Loop through selected products
        if ($selected_num > 0) {
            while ($selected_data = $selected_rs->fetch_assoc()) {
        ?>
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
        <?php
            }
        } else {
            // Show message if no products found
            echo "<p class='text-center'>No products found.</p>";
        }
        ?>

    </div>

    <div class="row mt-4">
        <div class="col-12 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>

                    <?php
                    for ($x = 1; $x <= $number_of_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                        } ?> aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>