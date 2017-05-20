<?php
require("sessionmgmt.php");
if(SessionManager::Status() == SessionManager::$LOGGED_IN)
  header("Location: Landing.php");
if(isset($_POST["email"], $_POST["password"])){
  //the user is trying to login
  $con = mysqli_connect("localhost", "aoparant_ppadmin", "AlwaysBlue", "aoparant_testdb");
  if(!$con)
    die("There was an error connecting to the database");
  //fetch salt
  $stmt = $con->prepare("SELECT Cust_id, Salt, Password FROM customer WHERE Email=?");
  $stmt->bind_param("s", $_POST["email"]);
  $stmt->bind_result($cust_id, $salt, $password);
  $stmt->execute();
  if($stmt->fetch()){
    $hashed = hash("sha512", $salt . $_POST["password"]);
    if($hashed == $password){
      //all went better than expected
      SessionManager::Login($cust_id);
      header("Location: Landing.php");

      //
    }
    else{
      //the password is wrong, but don't tell them that
      die("Username/Password is incorrect");
    }
  }
  else{
    //Neither was correct but don't tell him he is a dumbass
    die("Username/Password is incorrect");
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v3.12.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <meta name="description" content="">
  <link rel="stylesheet" type="text/css" href="master.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">



</head>
<body>
<section class="mbr-section mbr-parallax-background" id="form1-5" style="background-image: url(assets/images/mbr-2000x1333.jpg); padding-top: 40px; padding-bottom: 120px;">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2">SIGN&nbsp;IN</h3>

                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">

                    <form action="" method="post" data-form-title="SIGN&amp;nbsp;IN" onsubmit="this.submit()">


                        <div class="row row-sm-offset">



                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-5-email"><strong>Email</strong><span class="form-asterisk">*</span></label>
                                    <input type="email" class="form-control" name="email" required data-form-field="Email" id="form1-5-email">
                                </div>
                            </div>
                            </br>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-5-password"><strong>Password</strong><span class="form-asterisk">*</span></label>
                                    <input type="password" class="form-control" name="password" data-form-field="Phone" id="form1-5-password">
                                </div>
                            </div>

                        </div>
                        </br>


                         <button class="transparent" type="submit"><div class="mbr-section-btn"><a class="btn btn-lg btn-primary">Sign In</a></div></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
  </br>
  </br>



</section>

<section class="engine"><a rel="external" href=""></a></section><footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-6" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div class="container">
        <p class="text-xs-center">Copyright (c) 2017 | Piedpiper</p>
    </div>
</footer>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>


  <input name="animation" type="hidden">
  </body>
</html>
