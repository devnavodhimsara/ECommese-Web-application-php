<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NIMSARA COMPUTERS - seller loging</title>
  <link rel="icon" href="fevicone/favicon.ico">
  <link rel="stylesheet" href="css\bootstrap.css" />
  <link rel="stylesheet" href="style.css"/>
  <style>
    body {
  
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .card {
     
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
     
      color: #fff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      text-align: center;
    }

    .card-body {
      padding: 30px;
    }

    .title01 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .logo1 {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .create-account {
    
      text-decoration: none;
    }

    .create-account:hover {
      text-decoration: underline;
    }
    .bodyblure1{
      background-image: url("images/login page blure img.jpg");
      background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
    }
  </style>
</head>

<body class="container login-container-inner new-login-container-inner main-body">
  <div class="row justify-content-center">
  <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to Nimsara Computers</p>
                    </div>
                </div>
            </div>
            <div class="col-6 d-none d-lg-block background"></div>
  <div class="row justify-content-center">
    
      <div class="card">
        <div class="card-header">
          <h1 class="title01">seller loging   <a href="sellersingup.php">  <button class="btn btn-danger"  type="button">Dont have an account register now</button></a></h1>
        </div>
        <div class="card-body">
          <div class="logo1 text-center">Welcome to our computer shop</div>

          <div class="col-12  d-none " id="msgdiv1">
            <div class="alert alert-danger " role="alert" id="msg1">
            </div>
          </div>

          <form>
            <div class="mb-3">
              <label for="email" class="form-label">Enter Your email address</label>
              <input type="email" class="form-control" placeholder="Enter your email address" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Enter Your password</label>
              <input type="password" class="form-control"  placeholder="Enter your password" id="password">
            </div>
            <center><a href="#" class="mt-2 "  onclick="forgotPassword1();">Forgot Password ?</a></center>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="button"  onclick="selloging();">Log now</button>
            </div>
          </form>

        
          <hr class="my-3">


          <center><div class=" col-12  text-center">
             <a href="loging.php">  <button class="btn btn-danger"  type="button">user loging</button></a>
            <a href="sellersingin.php"><button class="btn btn-danger" type="button">seller Login</button></a>  
            <a href="adminsingin.php"><button class="btn btn-danger" type="button">singin admin</button></a>  
            </div><center>
        </div>
      </div>
   
  </div>

  <script src="script.js"></script>
</body>




 <!-- modal -->
 <div class="modal bodyblure1" tabindex="-1" id="fpmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password Sellers Nimsara Computers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">

                            <div class="row">
                    <div class="col-12 logo text-center"></div>
                 
                </div>
                            

                                <div class="col-12">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np"/>
                                        <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                                    </div>
                                </div> 

                                <div class="col-12">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vcode"/>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword1();">Reset</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- modal -->
            <script src="js\bootstrap.bundle.js"></script>

</html>