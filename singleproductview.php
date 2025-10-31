<?php
if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    include "db/connections.php";
    $product_rs = Database::search("SELECT * FROM `products` WHERE id ='$pid'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    // Fetch related products based on the same category
    $category_id = $product_data['category_id']; // Assuming you have a category_id field
    $related_products_rs = Database::search("SELECT p.*, pi.path FROM `products` p LEFT JOIN `product_images` pi ON p.id = pi.product_id WHERE p.category_id='$category_id' AND p.status='1' AND p.id != '$pid' LIMIT 4");
    $related_product_num = $related_products_rs->num_rows;
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_data["title"]; ?> | Nimsara Computers</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css"/>

    <!-- Additional Custom Styles -->
    <style>
        .transparent-bg {
            background-color: rgba(0, 0, 0, 0.5); /* 50% transparent dark background */
            padding: 20px;
            border-radius: 5px;
        }

        .related-items {
            background-color: rgba(0, 0, 0, 0.5); /* Apply the transparent background to the entire related items section */
            padding: 20px;
            border-radius: 5px;
        }
    </style>

    <!-- Bootstrap JavaScript (Bundle) -->
    <link rel="icon" href="fevicone/favicon.ico">
</head>
<body class="main-body bg-dark text-light">
    <?php
    session_start();
    if (isset($_SESSION["u"])) { /* Add your session check logic here */ }
    
    if ($product_num == 1) {
        $price = $product_data["price"];
        $adding_price = ($price / 100) * 10;
        $new_price = $price + $adding_price;
        $difference = $new_price - $price;
        $shipping_cost = 200; // Fixed shipping cost

        $image_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $pid . "'");
        $image_data = $image_rs->fetch_assoc();
    ?>
    <?php include "navbars.php"; ?>
    
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Main Content -->
            <main class="col-12 mt-0 singleProduct">
                <div class="row justify-content-center align-items-start">
                    <!-- Image Section -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="product-image-container border border-secondary rounded p-3">
                            <img src="<?php echo $image_data["path"]; ?>" class="img-fluid" alt="<?php echo $product_data["title"]; ?>" data-bs-toggle="modal" data-bs-target="#imageModal" style="max-width: 100%; height: 400px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Product Details Section -->
                    <div class="col-12 col-lg-6">
                        <div class="transparent-bg">
                            <h1 class="product-title mb-3" id="title"><?php echo $product_data["title"]; ?></h1>
                            <div class="product-price mb-3">
                                <span class="fs-4 fw-bold text-success" id="price">Rs.<?php echo $product_data["price"]; ?></span>
                                <span class="fs-5 text-decoration-line-through text-muted">Rs.<?php echo $new_price; ?></span>
                                <span class="fs-5 text-success">Save Rs.<?php echo $difference; ?>.00 (10%)</span>
                            </div>

                            <div class="shipping-cost mb-3">
                                <span class="fs-5 fw-bold">Shipping Cost:</span>
                                <span class="fs-5 text-warning">Rs.<?php echo $shipping_cost; ?></span>
                            </div>

                            <div class="total-value mb-3">
                                <span class="fs-5 fw-bold">Total Value:</span>
                                <span class="fs-5 text-success" id="total_value">Rs.<?php echo $price + $shipping_cost; ?></span>
                            </div>

                            <div class="mb-4">
                                <textarea class="product-description form-control bg-dark text-light" readonly><?php echo $product_data["description"]; ?></textarea>
                            </div>
                            <div class="product-quantity mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-light">Quantity:</span>
                                    <input onkeyup='calculateTotal(<?php echo $price; ?>, <?php echo $shipping_cost; ?>);' type="number" min="1" class="form-control" value="1" id="qty_input">
                                    <button class="btn btn-outline-secondary" type="button" onclick='qty_incs(<?php echo $product_data["qty"]; ?>);'>
                                        <i class="bi bi-caret-up-fill"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button" onclick="qty_decs();">
                                        <i class="bi bi-caret-down-fill"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-action mt-4">
                                <button class="btn btn-success me-2" type="button" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy Now</button>
                                <button class="btn btn-primary" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <section class="col-12 mt-5 related-items">
                <h2 class="mb-4">Related Items</h2>
                <div class="row justify-content-center gap-2 transparent-bg">
                    <?php
                    for ($z = 0; $z < $related_product_num; $z++) {
                        $related_product = $related_products_rs->fetch_assoc();
                    ?>
                    <div class="card col-6 col-lg-2 mt-2 mb-2 text-center animate__animated animate__fadeIn transparent-bg" style="width: 18rem;">
                        <div class="card-body">
                            <img src="<?php echo $related_product["path"]; ?>" class="card-img-top img-thumbnail mt-2 animate__animated animate__fadeIn" style="height: 180px; object-fit: cover;" alt="<?php echo $related_product["title"]; ?>">
                            Rs. <?php echo $related_product["price"]; ?>.00
                            <?php if ($related_product["qty"] > 0) { ?>
                                <span class="badge rounded-pill text-bg-warning bi bi-newspaper">In Stock</span>
                            <?php } else { ?>
                                <span class="badge rounded-pill text-bg-danger bi bi-layout-text-sidebar">Out Of Stock</span>
                            <?php } ?>
                            <h5 class="card-title fw-bold fs-6 animate__animated animate__fadeIn"><?php echo $related_product["title"]; ?></h5>
                            <?php
                            if ($related_product["qty"] > 0) {
                            ?>
                                <span class="card-text text-success fw-bold animate__animated animate__fadeIn"><?php echo $related_product["qty"]; ?> Items Available</span><br /><br />
                                <a href='<?php echo "singleProductView.php?id=" . ($related_product["id"]); ?>' class="col-12 btn btn-success animate__animated animate__fadeIn">
                                    Buy Now
                                </a>
                            <?php
                            } else {
                            ?>
                                <span class="card-text text-danger fw-bold animate__animated animate__fadeIn">Out Of Stock</span><br />
                                <span class="card-text text-danger fw-bold animate__animated animate__fadeIn">00 Items Available</span><br /><br />
                                <a href='#' class="col-12 btn btn-success disabled animate__animated animate__fadeIn">
                                    Buy Now
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </section>

            <!-- Footer -->
            <?php include "main footer.php"; ?>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo $image_data["path"]; ?>" class="img-fluid" alt="<?php echo $product_data["title"]; ?>">
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal(price, shippingCost) {
            var qty = parseInt(document.getElementById('qty_input').value);
            var total = (price * qty) + shippingCost;
            document.getElementById('total_value').innerText = "Rs." + total.toFixed(2); // Use toFixed(2) for precision
        }

        function qty_incs(maxQty) {
            var qtyInput = document.getElementById('qty_input');
            var qty = parseInt(qtyInput.value);
            if (qty < maxQty) {
                qtyInput.value = qty + 1;
                calculateTotal(<?php echo $price; ?>, <?php echo $shipping_cost; ?>);
            }
        }

        function qty_decs() {
            var qtyInput = document.getElementById('qty_input');
            var qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
                calculateTotal(<?php echo $price; ?>, <?php echo $shipping_cost; ?>);
            }
        }

        document.getElementById('qty_input').addEventListener('input', function () {
            calculateTotal(<?php echo $price; ?>, <?php echo $shipping_cost; ?>);
        });
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="swalw2.js"></script>
    <script src="swalw.js"></script>
</body>
</html>
<?php
    }
}
?>
