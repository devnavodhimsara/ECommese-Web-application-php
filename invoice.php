<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Nimsara Computers</title>
    <link rel="stylesheet" href="style.css">
    <link href="css\bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="icon" href="resource/logo.svg">

    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .full-width-header, .full-width-footer {
            width: 100%;
            background-color: #222;
            padding: 10px 0;
        }

        .full-width-header img, .full-width-footer p {
            margin-left: 20px;
        }

        .container-fluid {
            max-width: 900px;
            margin: 20px auto;
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .invoice-header,
        .invoice-details,
        .invoice-table,
        .thank-you,
        .notice,
        .invoice-footer {
            color: #fff;
        }

        .invoice-header h2,
        .invoice-footer p {
            font-size: 1.2rem;
        }

        .invoice-table th,
        .invoice-table td {
            font-size: 0.9rem;
            border: 1px solid #444;
        }

        .invoice-table th {
            background-color: #333;
            text-align: center;
        }

        .invoice-table td {
            text-align: center;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .notice {
            margin-top: 20px;
            font-size: 0.9rem;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .invoice-footer {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #bbb;
        }

        .btn-dark {
            background-color: #333;
            border: none;
        }

        @media print {
            body {
                background-color: black;
                color: black;
            }

            .container-fluid {
                background-color: black;
                color: black;
            }

            .invoice-header, .invoice-details, .invoice-table, .thank-you, .notice, .invoice-footer {
                color: black;
            }

            .invoice-table th, .invoice-table td {
                border: 1px solid black;
            }

            body * {
                visibility: hidden;
            }

            #printarea, #printarea * {
                visibility: visible;
            }

            #printarea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }

            .btn, .navbars, .main-footer {
                display: none !important;
            }
        }
    </style>
</head>

<body class="main-body">

    <!-- Full-Width Header -->
    <div class="full-width-header">
        <div class="d-flex justify-content-between align-items-center">
            <img src="images/Capture-removebg-preview (1).png" alt="Nimsara Computers" class="img-fluid" style="max-height: 80px;">
            <div class="text-end text-white me-3">
                <h2>Nimsara Computers</h2>
                <p>Maradana, Colombo 10, Sri Lanka.<br>+94112 555448<br>nimsara@gmail.com</p>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid mt-3">
        <div class="row">
            <?php
            session_start();
           
            include "db/connections.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"] ?? null;

                if ($oid) {
            ?>

            <div class="col-12 mb-3 invoice-header">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-dark" onclick="printReport();"><i class="bi bi-printer-fill"></i> Print</button>
                </div>
            </div>
            <div id="printarea">
                <div class="col-12 invoice-header">
                    <div class="row">
                        <div class="col-6">
                            <img src="images/Capture-removebg-preview (1).png" alt="Nimsara Computers" class="img-fluid text-black" style="max-height: 80px;">
                        </div>
                        <div class="col-6 text-end text-black">
                            <h2>Nimsara Computers</h2>
                            <p>Maradana, Colombo 10, Sri Lanka.<br>+94112 555448<br>nimsara@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table invoice-details">
                                <tr>
                                    <th>From:</th>
                                    <td>
                                        <strong>Nimsara Computers</strong><br>Maradana, Colombo 10, Sri Lanka.<br>+94112 555448<br>nimsara@gmail.com
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bill To:</th>
                                    <td>
                                        <?php echo htmlspecialchars($_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"]); ?><br>
                                        <?php echo htmlspecialchars($_SESSION["u"]["address_line1"] . " " . $_SESSION["u"]["address_line2"]); ?><br>
                                        <?php echo htmlspecialchars($umail); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-end">
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                            if ($invoice_rs->num_rows > 0) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>
                            <table class="table invoice-details">
                                <tr>
                                    <th>Date:</th>
                                    <td><?php echo htmlspecialchars($invoice_data["date"]); ?></td>
                                </tr>
                                <tr>
                                    <th>Invoice #:</th>
                                    <td><?php echo htmlspecialchars($invoice_data["invoice_id"]); ?></td>
                                </tr>
                            </table>
                            <?php
                            } else {
                                echo "<p>No invoice data available</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <table class="table table-bordered invoice-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($invoice_data)) {
                                $products_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $invoice_data["order_id"] . "'");
                                $counter = 1;
                                $subtotal = 0;
                                while ($product_item = $products_rs->fetch_assoc()) {
                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $product_item["products_id"] . "'");
                                    if ($product_rs->num_rows > 0) {
                                        $product_data = $product_rs->fetch_assoc();
                                        $total = $product_data["price"] * $product_item["qty"];
                                        $subtotal += $total;
                            ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo htmlspecialchars($product_data["title"]); ?></td>
                                <td><?php echo htmlspecialchars($product_item["qty"]); ?></td>
                                <td>Rs. <?php echo number_format($product_data["price"], 2); ?></td>
                                <td>Rs. <?php echo number_format($total, 2); ?></td>
                            </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot class="invoice-summary">
                            <?php
                            $delivery = 200;
                            $grand_total = isset($subtotal) ? $subtotal + $delivery : $delivery;
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>SUBTOTAL</td>
                                <td>Rs. <?php echo isset($subtotal) ? number_format($subtotal, 2) : '0.00'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Delivery Fee</td>
                                <td>Rs. <?php echo number_format($delivery, 2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-primary">GRAND TOTAL</td>
                                <td class="text-primary">Rs. <?php echo number_format($grand_total, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-12 thank-you">
                    <span>Thank You!</span>
                </div>

                <div class="col-12 notice">
                    <h5>NOTICE:</h5>
                    <p>Purchased items can be returned before 7 days of delivery.</p>
                </div>

                <div class="col-12 invoice-footer text-center">
                    <p>Invoice was created on a computer and is valid without the Signature and Seal.</p>
                </div>
            </div>
            <?php
                } else {
                    echo "<p>No order ID provided.</p>";
                }
            } else {
                echo "<p>User session not set. Please log in.</p>";
            }
            ?>
       
        </div>
    </div>

    <!-- Full-Width Footer -->
    <div class="full-width-footer text-center">
        <p>© 2024 Nimsara Computers. All rights reserved.</p>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="swalw2.js"></script>
    <script src="swalw.js"></script>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</body>

</html>
