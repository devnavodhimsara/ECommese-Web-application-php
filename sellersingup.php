



<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimsara Computers - Signup</title>
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
                    <h2 class="title01 text-center">seller Sign Up </h2>
                </div>
                <div class="card-body">
                    <div class="flex-div">
                        <div class="name-content text-center">
                            <img src="images\partY__1_-removebg-preview.png" />

                            <p class="logo1 color">Welcome to our computer shop</p>
                        </div>


                            <div class="col-12  d-none " id="msgdiv1">
                                <div class="alert alert-danger " role="alert" id="msg1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="form-label">username</label>
                                <input type="text" class="form-control" placeholder="Enter your username" id="uname">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="form-label">Email</label>
                                <input type="text" class="form-control"placeholder="Enter your email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">password</label>
                                <input type="email" class="form-control"   placeholder="Enter your password" id="password">
                            </div>
                           
                            <center> <button class="btn btn-primary mt-3" onclick="selsingup();">Sign Up</button></center>
                            <a href="#" class="mt-2 d-block  text-center">Forgot Password?</a>
                            <hr class="mt-4">
                            <a href="sellersingin.php" class="mt-2 d-block  text-center">Already have an account? Sign in</a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js\bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>