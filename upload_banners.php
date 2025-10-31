<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
    <style>
        body {
            background-color: #212529;
            color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-image: url('images/1024px-Symbol_OK.svg.png') ;
        }

        .container {
            background-color: #343a40;
            border-radius: 10px;
            padding: 30px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .alert-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .alert-danger {
            background-color: #f44336;
            border-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
       
        <form method="post" enctype="multipart/form-data">
        
            
           <center> <a href="admindashboard.php" class="btn btn-secondary">Go to Home</a></center>
        </form>
    </div>

    <?php
    // 1. Include database connection
    require_once 'database.php';

    // 2. Define directory to store uploaded images
    $upload_dir = 'navod/'; 

    // 3. Handle file uploads
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 3.1. Sanitize filenames and check file types
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        foreach ($_FILES as $key => $file) {
            $file_name = basename($file['name']);
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];

            // Validation
            if (in_array($file_type, $allowed_types)) {
                // 3.2. Create a unique filename (prevent overwrites)
                $new_filename = uniqid() . '_' . $file_name;

                // 3.3. Upload the image (with error handling)
                if (move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
                    // 3.4. Prepare SQL statement to update the database
                    $sql = "UPDATE banners SET `$key` = ? WHERE id = 1";
                    $stmt = $conn->prepare($sql);
                    
                    // Create a variable to hold the image path
                    $image_path = $upload_dir . $new_filename; 
                    
                    // Bind the image path variable to the prepared statement
                    $stmt->bind_param("s", $image_path); 

                    if ($stmt->execute()) {
                        // Success message
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> The banner image has been updated.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> There was a problem updating the banner.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> There was a problem uploading the banner: ' . $file_name . ' - ' . error_get_last()['message'] . '.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>'; 
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Invalid file type: ' . $file_name . '. Please upload an image in JPEG, PNG, or GIF format.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }
    }
    ?>
    <footer class="bg-dark text-light py-3 mt-5">
        <div class="container">
            <div class="text-center">
                <p>© 2023 Nimsara_computers. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>