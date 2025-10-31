<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-us-Nimsara computers</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css\bootstrap.css" />
    <link rel="icon" href="fevicone\favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


</head>

<body class="main-body">
    <div class="container">
        <div class="text-center" style="font-size:50px;">
            <div class="text-primary">
                Contact-us
            </div>
        </div>
        <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i>Back</button>
        <div class="text-center">
            <div class="text-white">At Nimsara Computers, we value our customers and are always here to help with any questions, concerns, or feedback you may have. Whether you're looking for product information, need technical support, or want to inquire about our services, our team is ready to assist you.</div>
        </div>



        <div class="text-center mt-3"><button class="btn btn-primary text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                <i class="bi bi-hand-index-thumb"></i> Get In Tuch Businass Details
            </button></div>
        </p>
        <center>
            <div class="text-center">
                <div class="collapse collapse-horizontal text-center" id="collapseWidthExample">
                    <div class="text-center">
                        <div class="card card-body text-center">
                            <p> Phone:+94 (76) 3423663</p>
                            <p>Email: support@nimsaracomputers.com</p>
                            <p>Address: galgamuwa north Maharachchimulla</p>

                        </div>
                    </div>
                </div>
         </center>
          </div>


           <div class="text-center mt-3"><button class="btn btn-primary text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample1" aria-expanded="false" aria-controls="collapseWidthExample">
            <i class="bi bi-hand-index-thumb"></i> Get In Tuch Store Hours:
        </button></div>
    </p>
    <center>
        <div class="text-center">
            <div class="collapse collapse-horizontal text-center" id="collapseWidthExample1">
                <div class="text-center">
                    <div class="card card-body text-center">
                        <p>
                            Monday - Friday: 9:00 AM - 6:00 PM</p>
                        <p>Saturday: 10:00 AM - 4:00 PM</p>
                        <p>Sunday: Closed</p>

                    </div>
                </div>
            </div>
    </center>
    </div>
    <div class="col-12  d-none " id="msgdiv1">
        <div class="alert alert-danger " role="alert" id="msg1">
        </div>
    </div>
    <div class="text-center fst-italic text-primary" style="font-size:40px;">
        <div>online contact form</div>
    </div>

    <div style="margin-left:20%; font-size:20px;">
        <lable>Name:</lable>
    </div>
    <div style="margin-left:20%;"><input type="text" placeholder="please enter your name" class="form-control" id="name"></input></div>



    <div style="margin-left:20%; font-size:20px;">
        <lable>Email:</lable>
    </div>
    <div style="margin-left:20%;"><input type="text" placeholder="please enter your Email" class="form-control" id="email"></input></div>

    <div style="margin-left:20%; font-size:20px;">
        <lable>phone number:</lable>
    </div>
    <div style="margin-left:20%;"><input type="text" placeholder="please enter your phone number" class="form-control" id="phonenumber"></input></div>

    <div style="margin-left:20%; font-size:20px;">
        <lable>Message:</lable>
    </div>
    <div style="margin-left:20%"> <textarea placeholder="please type your message" class="form-control" id="message"></textarea></div>




    <center> <button class="btn btn-primary mt-3" onclick="massegesent();">submit</button></center>



    </div>

    <div class="mt-3"></div>
    <?php
    include "main footer.php"
    ?>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


</html>