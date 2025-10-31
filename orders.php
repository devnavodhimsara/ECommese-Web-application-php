<?php

include "db/connections.php";
session_start();
if (isset($_SESSION["sup"])) {

    $username = $_SESSION["sup"]["username"];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <title>Manage Users | Admins | Nimsara Computers</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="fevicone/favicon.ico">
    <style>
        body {
            background-color: #121212;
            background-image: url("images/blue-glow-hexagon-gradient-white-black-3840x2160-c4-000000-ffffff-00008b-000000-l2-4-128-a-15-f-6.svg");
            font-family: 'Roboto', sans-serif; /* Modern font */
        }

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .table {
            color: #f8f9fa;
            border-radius: 8px; /* Rounded corners */
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
        }

        .table-hover tbody tr {
            transition: background-color 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: #212529;
        }

        .table thead th {
            background-color: #0d6efd;
            border-color: #0a58ca;
            text-transform: uppercase; /* Consistent text style */
        }

        .input-group .form-control {
            background-color: #212529;
            color: #f8f9fa;
            border-color: #343a40;
        }

        .btn-warning,
        .btn-dark,
        .btn-danger,
        .btn-success {
            border-radius: 4px;
            transition: all 0.2s ease-in-out; /* Smooth transition */
        }

        .btn-warning:hover,
        .btn-dark:hover,
        .btn-danger:hover,
        .btn-success:hover {
            transform: scale(1.05); /* Slight zoom on hover */
        }

        .pagination .page-link {
            color: #f8f9fa;
            background-color: #212529;
            border-color: #343a40;
            border-radius: 50%; /* Rounded pagination buttons */
            margin: 0 5px; /* Increase spacing */
            transition: background-color 0.3s ease;
        }

        .pagination .page-link:hover,
        .pagination .page-link:focus {
            background-color: #343a40;
            border-color: #343a40;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0a58ca;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow for active item */
        }

        @media (max-width: 992px) {
            .pagination {
                flex-direction: column; /* Stack pagination vertically on smaller screens */
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<?php include 'navbaes.php'; ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 d-flex justify-content-center">
                <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i> Back</button>
                <button class="btn btn-danger" onclick="printreport();"><i class="bi bi-printer-fill"></i> PRINT</button>
            </div>
            <div id="printaria">
                <div class="col-12 text-center py-3">
                    <label class="form-label text-primary fw-bold fs-1">All Orders - Nimsara Computers</label>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">1 Qty Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Total Paid</th>
                                    <th scope="col">Buyer Name</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $results_per_page = 5;
                                $product_rs = Database::search("SELECT * FROM `invoice` WHERE `sellers_name`='" . $username . "'");
                                $product_num = $product_rs->num_rows;
                                $number_of_pages = ceil($product_num / $results_per_page);
                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs = Database::search("SELECT * FROM `invoice` WHERE `sellers_name`='" . $username . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
                                $selected_num = $selected_rs->num_rows;

                                if ($selected_num > 0) {
                                    for ($x = 0; $x < $selected_num; $x++) {
                                        $selected_data = $selected_rs->fetch_assoc();
                                ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($selected_data["title"]); ?></td>
                                            <td><?php echo htmlspecialchars($selected_data["price"]); ?></td>
                                            <td><?php echo htmlspecialchars($selected_data["qty"]); ?></td>
                                            <td><?php echo htmlspecialchars($selected_data["useraddress"]); ?></td>
                                            <td>Rs. <?php echo htmlspecialchars($selected_data["total"]); ?></td>
                                            <td><?php echo htmlspecialchars($selected_data["username"]); ?></td>
                                            <td>
                                                <a href='<?php echo "singleProductView.php?id=" . htmlspecialchars($selected_data["products_id"]); ?>' class="btn btn-success">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="col-12 mt-3 mb-3 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($pageno <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);
                                                            } ?>" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $number_of_pages; $x++) {
                            ?>
                                <li class="page-item <?php if ($x == $pageno) {
                                                        echo 'active';
                                                    } ?>">
                                    <a class="page-link" href="<?php echo "?page=$x"; ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="page-item <?php if ($pageno >= $number_of_pages) {
                                                    echo 'disabled';
                                                } ?>">
                                <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page=" . ($pageno + 1);
                                                            } ?>" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination End -->
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php include 'main footer.php'; ?>

<?php
}
?>
