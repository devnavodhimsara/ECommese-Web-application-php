<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar nimsara computers</title>
  <link href="css\bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
</head>

<body>
  <?php
  

  if (isset($_SESSION["u"])) {
    $datas = $_SESSION["u"];
  ?>
  <?php

  }
  ?>
<nav class="navbar navbar-expand-lg bg-black container">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">
        <img src="images/partY__1_-removebg-preview.png" alt="Nimsara Computers Logo" height="40" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white d-grid" aria-current="page" href="indexlk.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="aboutus.php">AboutUs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="contactus.php">Contact</a>
          </li>
        </ul>
        <i class="bi bi-cart"></i>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
        <button type="button" class="btn btn-info"> <a class="link-secondary text-decoration-none" type="button"  onclick="submits();">seller</a> </button>
        <button class="btn btn-dark ms-3 text-decorations-none">  <a href="cart.php"><i class="bi bi-cart"></i></a></button>
      
          <?php if( isset($_SESSION["u"])){
            $datas = $_SESSION["u"];{?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $datas['first_name']; ?>
                <img src="<?php echo $datas['profile_image']; ?>"  class="rounded-circle" width="30" height="30" onerror="this.src='default_img/256-2569650_men-profile-icon-png-image-free-download-searchpng.png'"> <!-- Default image on error -->
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="userprofile.php">my profile</a></li>
                <li><a class="dropdown-item" href="perches.php">perchusing history</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" onclick="signoutuser();">Logout</a></li>
              </ul>
            </li>
            <?php } ?> 
              <?php } else { ?>
            <li class="nav-item d-grid">
              <a class="nav-link text-white" href="loging.php">Login</a>
            </li>
       
            <img src="default_img/256-2569650_men-profile-icon-png-image-free-download-searchpng.png" class="rounded-circle" width="30" height="30">
          <?php } ?>
        </ul>


      </div>
    </div>
  </nav>



</body>


</html>