<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchasing History | Nimsara_computers</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="fevicone\favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqk1wZxL+h2vGYpbZJYqrxDq/0X+Q8cGoavllEALiI3MxCij/2R/ImY1DXw7RkzcZBHWaCxHSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php
session_start();
include "navbars.php";
?>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background */
            color: #e0e0e0; /* Light text color for contrast */
        }
       
        .order-details {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .order-details img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        .order-details .info {
            flex-grow: 1;
        }
        .order-details h6 {
            margin-bottom: 5px;
            color: #e0e0e0; /* Light text color */
        }
        .order-details .price {
            font-weight: bold;
            color: #f5a623; /* Highlighted price color */
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons a {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: block;
        }
        .preview-btn {
            background-color: #2196F3;
            color: white;
            text-decoration: none;
        }
        .preview-btn:hover {
            background-color: #0b79d0;
        }
        .empty-view, .not-logged-in {
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b0b0b0; /* Light gray color for empty view */
        }
        .modal-content {
            border-radius: .3rem;
            background: #1e1e1e; /* Darker modal background */
            border: 1px solid rgba(255, 255, 255, .1);
            outline: 0;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .2);
            color: #e0e0e0; /* Light text color in modal */
        }
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }
        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, .1);
        }
        .table {
            color: #e0e0e0; /* Light text color for table */
        }
        .table thead th {
            background-color: #333; /* Darker background for header */
            color: #e0e0e0; /* Light text color */
        }
        .table tbody tr {
            background-color: #1e1e1e; /* Darker background for rows */
        }
        .table tbody tr:nth-child(even) {
            background-color: #2a2a2a; /* Alternating row color */
        }
        .table-bordered td, .table-bordered th {
            border-color: #333; /* Darker border color */
        }
        .btn-danger {
            background-color: #f44336;
            border-color: #f44336;
        }
        .btn-danger:hover {
            background-color: #c62828;
            border-color: #c62828;
        }
    </style>
</head>

<body class="main-body">
    <div class="container">

        <?php
        include "db/connections.php";
        
        if (isset($_SESSION["u"])) {
            $userId = $_SESSION["u"]["id"];
            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_id`='" . $userId . "'");
            $invoice_num = $invoice_rs->num_rows;

            if ($invoice_num == 0) {
                echo '<div class="empty-view">
                        <span class="fs-1 fw-bold text-light">
                            You have not purchased any item yet...
                        </span>
                      </div>';
            } else {
                echo '<h2 class="text-center mb-4 text-light">Purchasing History</h2>
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Details</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Purchased Date & Time</th>
                              
                            </tr>
                        </thead>
                        <tbody>';

                for ($x = 0; $x < $invoice_num; $x++) {
                    $invoice_data = $invoice_rs->fetch_assoc();
                    $details_rs = Database::search("SELECT * FROM `products` INNER JOIN `product_images` ON 
                                                    products.id=product_images.product_id INNER JOIN `users` 
                                                    WHERE `products`.`id`='" . $invoice_data["products_id"] . "'");
                    $product_data = $details_rs->fetch_assoc();

                    echo '<tr>
                            <td>' . $invoice_data["invoice_id"] . '</td>
                            <td class="order-details">
                                <img src="' . $product_data["path"] . '" alt="Product Image">
                                <div class="info">
                                    <h6>' . $product_data["title"] . '</h6>
                                    <p>Seller: ' . $product_data["first_name"] . ' ' . $product_data["last_name"] . '</p>
                                    <p class="price">Price: Rs. ' . $product_data["price"] . ' .00</p>
                                   
                                </div>
                            </td>
                            <td>' . $invoice_data["qty"] . '</td>
                            <td>Rs. ' . $invoice_data["total"] . ' .00</td>
                            <td>' . $invoice_data["date"] . '</td>
                        
                            </td>
                        </tr>';
                }

                echo '</tbody></table>
                      <div class="text-center mt-4">
                     
                      </div>';
            }
        } else {
            echo '<div class="not-logged-in">
                    <span class="fs-1 fw-bold text-light">
                        You are not logged in...
                    </span>
                  </div>';
        }
        ?>

    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="swalw2.js"></script>
    <script src="swalw.js"></script>
</body>
</html>
<?php
include "main footer.php";
?>
