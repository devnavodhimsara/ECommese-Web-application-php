<?php
include "db\connections.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product Report - online Store</title>
    <link rel="stylesheet" href="css\bootstrap.css" />
</head>

<body>
    <div class="container">
        <div class="row mb-5">

            <div class="col-12 mt-5 d-flex justify-content-center">
                <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i>Back</button>
                <nutton class="btn btn-danger" onclick="printreport();"><i class="bi bi-printer-fill"></i>PRINT</nutton>
            </div>
        </div>
    </div>
    <div class="container" id="printaria">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Product Report</h1>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Descriptions</th>
                            <th>category</th>
                            <th>Brand</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Image</th>
                            <td>image</td>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php
                        $rs = Database::search("SELECT * FROM `product_details`");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row =  $rs->fetch_assoc();

                        ?>
                            <tr>
                                <td><?php echo ($row["id"]); ?></td>
                                <td><?php echo ($row["name"]); ?></td>
                                <td><?php echo ($row["description"]); ?></td>
                                <td><?php echo ($row["cat_name"]); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php


                                    ?></td>
                            <tr>
                            <?php
                        }
                            ?>

                    </tbody>
                </table>

            </div>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>