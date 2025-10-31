<?php

include "db\connections.php";
session_start();
if (isset($_SESSION["sup"])) {





?>



<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Manage Users | Admins | Nimsara computers</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css"/>
    <link rel="icon" href="fevicone\favicon.ico">

    <style>
        body {
            background-color: #121212;
            background-image: url("images/blue-glow-hexagon-gradient-white-black-3840x2160-c4-000000-ffffff-00008b-000000-l2-4-128-a-15-f-6.svg");
        }

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }


        @media (max-width: 992px) {
            .table-responsive {
                overflow-x: auto;
            }
        }


        .table {
            color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #212529;
        }

        .table thead th {
            background-color: #0d6efd;
            border-color: #0a58ca;
        }


        .input-group .form-control {
            background-color: #212529;
            color: #f8f9fa;
            border-color: #343a40;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #d39e00;
        }

        /* Style the pagination */
        .pagination .page-link {
            color: #f8f9fa;
            background-color: #212529;
            border-color: #343a40;
        }

        .pagination .page-link:hover,
        .pagination .page-link:focus {
            color: #f8f9fa;
            background-color: #343a40;
            border-color: #343a40;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0a58ca;
        }
    </style>

</head>
<?php
include 'navbaes.php';
?>
<body>
<div class="container">
        <div class="row">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i>Back</button>
            <nutton class="btn btn-danger" onclick="printreport();" ><i class="bi bi-printer-fill"></i>PRINT</nutton>
        </div>
        <div id="printaria">

            <div class="col-12  text-center py-3">
                <label class="form-label text-primary fw-bold fs-1">All sellers Nimsara Computers</label>
            </div>

        
       <div class="col-12 mt-3">
                <form class="row mb-3" method="GET">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search User" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <button class="btn btn-warning" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                   

                            $query = "SELECT * FROM `sellers`";

                            // Search functionality
                            if (isset($_GET['search'])) {
                                $search = $_GET['search'];
                                $query .= " WHERE `username` LIKE '%$search%' OR `email` LIKE '%$search%'";
                            }

                            // Pagination logic (similar to your existing code)
                            $pageno;
                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $user_rs = Database::search($query);
                            $user_num = $user_rs->num_rows;

                            $results_per_page = 5;
                            $number_of_pages = ceil($user_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            if ($selected_num > 0) { // Check if any users were found
                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $page_results + $x + 1; ?></th>
                                        <td><img src="<?php echo $selected_data['profile_image']; ?>" alt="User Profile" class="rounded-circle" width="50" height="50" onerror="this.src='navod/Capture.PNG'"></td>
                                        <td><?php echo $selected_data["username"] . " " . $selected_data["last_name"]; ?></td>
                                        <td><?php echo $selected_data["email"]; ?></td>
                                        <td><?php echo $selected_data["mobile_number"]; ?></td>

                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">No users found.</td>
                                </tr>
                            <?php
                            }
                            ?>
</div>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination  -->
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

    <script src="js\bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php

} else {
    header("Location:sellersingin.php");
}


?>
<?php include 'main footer.php'; ?>