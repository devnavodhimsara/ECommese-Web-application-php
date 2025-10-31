<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" ;>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contract messeges -Nimsara computers</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css\bootstrap.css" />
    <link rel="icon" href="fevicone\favicon.ico" />
</head>

<body>

    <style>
        body {
            background-color: #121212;
            background-image: url("images/bg.jpg");
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

    include "db\connections.php";
    session_start();
    if (isset($_SESSION["admin"])) {





    ?>

        <?php
        include 'adminnavbar.php';
        ?>

        <body class="main-body">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5 d-flex justify-content-center">
                        <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i>Back</button>
                        <nutton class="btn btn-danger" onclick="printreport();"><i class="bi bi-printer-fill"></i>PRINT</nutton>
                    </div>

                    <div class="col-12  text-center py-3">
                        <label class="form-label text-primary fw-bold fs-1">All masseges Nimsara computers</label>
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
                    <div class="text-center"><button class="btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                            <i class="bi bi-hand-index-thumb"></i> view message
                        </button></div>
                    <div id="printaria">
                        <div class="col-12 mt-4">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-primary text-white">

                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">name</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Phone number</th>
                                            <th scope="col">message</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php



                                        $query = "SELECT * FROM `contact_messages`";

                                        // Search functionality
                                        if (isset($_GET['search'])) {
                                            $search = $_GET['search'];
                                            $query .= " WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%'";
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

                                        $results_per_page = 2;
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
                                                    <td><?php echo $selected_data["name"]; ?></td>
                                                    <td><?php echo $selected_data["email"]; ?></td>
                                                    <td><?php echo $selected_data["phone"]; ?></td>


                                                    <td>

                                                        </p>
                                                        <center>
                                                            <div class="">
                                                                <div class="collapse collapse-horizontal " id="collapseWidthExample">
                                                                    <div class="">
                                                                        <textarea>
                        <?php echo $selected_data["message"]; ?>
                                        </textarea>

                                                                    </div>
                                                                </div>
                                                        </center>
                            </div>
                            </td>





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

                    </tbody>
                    </table>
                        </div>
                    </div>
                </div>

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


            </div>
            </div>

            <script src="js\bootstrap.bundle.js"></script>
            <script src="script.js"></script>
        </body>


    <?php

    } else {
        header("Location:adminsingin.php");
    }

include "main footer.php";
    ?>

</html>