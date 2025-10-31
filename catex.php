<?php
session_start();
include "db/connections.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["id"];
    $total = 0;
    $shipping = 0;
?>

<!DOCTYPE html >
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimsara Computers - Product Cart</title>
    <link rel="icon" href="fevicone/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
body {
    background: linear-gradient(to right, #0056b3, #007bff);
    color: #fff;
    font-family: 'Arial', sans-serif;
}

.container {
    margin: 20px auto;
    max-width: 1200px; 
    padding: 20px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; 
}

.card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #1e1e1e;
    color: #fff;
    margin-bottom: 20px;
    text-align: center; /* Center text inside the card */
    width: 100%; /* Ensure the card takes up full width within its column */
    max-width: 500px; /* Limit the maximum width of the card */
}

.card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 200px;
    object-fit: cover;
}

.card-body {
    padding: 20px;
}

.summary-card {
    background-color: #343a40;
    padding: 20px;
    border-radius: 10px;
    text-align: center; /* Center text in the summary card */
    margin-top: 20px;
}

.summary-card h5 {
    margin-bottom: 20px;
}

.btn {
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
}

.btn-outline-info {
    color: #17a2b8;
    border-color: #17a2b8;
}

.btn-outline-info:hover {
    background-color: #17a2b8;
    color: #fff;
}

.btn-info {
    background-color: #17a2b8;
    color: #fff;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.text-primary {
    color: #007bff;
}

.text-danger {
    color: #dc3545;
}

.text-success {
    color: #28a745;
}

.text-center {
    text-align: center;
}

    </style>
</head>

<body class="main-body">
    <?php include "navbars.php"; ?>

    <div class="container">
        <?php
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='" . $user . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 0) {
        ?>
            <!-- Empty View -->
            <div class="text-center">
                <div class="alert alert-info fs-3 fw-bold">
                    You have no items in your Cart yet.
                </div>
                <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">Start Shopping</a>
            </div>
        <?php
        } else {
            for ($x = 0; $x < $cart_num; $x++) {
                $cart_data = $cart_rs->fetch_assoc();
                $product_rs = Database::search("SELECT * FROM `products` INNER JOIN `product_images` ON products.id = product_images.product_id WHERE products.id = '" . $cart_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $total += $product_data["price"] * $cart_data["qty"];
                $shipping += 250; 
        ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="<?php echo $product_data["path"]; ?>" class="card-img-top" alt="<?php echo $product_data["title"]; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                <p class="card-text"><?php echo $product_data["description"]; ?></p>

                            <p class="card-text">
                                <p class="card-text">Price: <span class="text-primary">Rs.<?php echo $product_data["price"]; ?>.00</span></p>
                                <p class="card-text">Quantity: 
                                    <input type="number" class="border border-2 border-secondary fs-4 fw-bold px-3" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['id']; ?>);" id="qty_num-<?php echo $cart_data['id']; ?>">
                                </p>
                                <p class="card-text">Delivery Fee: <span class="text-danger"><?php echo $shipping; ?></span></p>
                                <a href="#" class="btn btn-info">Buy Now</a>
                                <a href="#" class="btn btn-danger ms-2" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                <p class="card-text mt-3">Requested Total: <span class="text-success"><?php echo ($product_data["price"] * $cart_data["qty"]) + 250; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <div class="summary-card mt-4">
            <h5 class="text-center">Summary</h5>
            <p class="card-text">Items (<?php echo $cart_num; ?>): <span class="text-primary" id="name">Rs. <?php echo $total; ?>.00</span></p>
            <p class="card-text">Shipping: <span class="text-success">Rs. <?php echo $shipping; ?>.00</span></p>
            <span class="fw-bold fs-2 text-white">Total <i class="bi bi-info-circle" id="price"> <?php echo $total + $shipping; ?></i></span>
            <button class="btn btn-primary fs-5" onclick="checkuout();"><span class="fw-bold fs-3 text-white "><i class="bi bi-hand-index-thumb"></i>Check Out</span><button>
        </div>
    </div>

    <?php include 'main footer.php'; ?>

    <script src="script.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="swalw2.js"></script>
    <script src="swalw.js"></script>
</body>

</html>

<?php
} else {
    header("Location: indexlk.php");
}
?>
