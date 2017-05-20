<!DOCTYPE html>
<?php
require_once("sessionmgmt.php");
if(SessionManager::Status() == SessionManager::$LOGGED_OFF)
  header("Location: index.html");


if(isset($_POST["MeetingDate"] ,$_POST["MeetingTime"], $_POST["ReturnDate"], $_POST["ReturnTime"], $_POST["VehicleMake"], $_POST["VehicleModel"], $_POST["VehicleType"],$_POST["VehicleReg"],$_POST["Message"], $_POST["VehicleColour"])){
	$con = mysqli_connect("localhost", "aoparant_ppadmin", "AlwaysBlue", "aoparant_testdb");
  mysqli_autocommit($con, false);
	if(!$con)
		die("Error connecting to database");
  $executedCorrectly = true;
  $stmt = $con->prepare("SELECT Veh_reg FROM vehicle WHERE Cust_id=? AND Veh_reg=?");
  $stmt->bind_param("is", $_SESSION["cust_id"], $_POST["VehicleReg"]);
  $stmt->execute();
  if(!$stmt->fetch()){
    //Inserting new vehicle
    $stmt->close();
    $stmt = $con->prepare("INSERT INTO vehicle (Veh_reg, Cust_id, Make, Model, Colour, Type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $_POST["VehicleReg"], $_SESSION["cust_id"], $_POST["VehicleMake"], $_POST["VehicleModel"], $_POST["VehicleColour"], $_POST["VehicleType"]);
    if(!$stmt->execute()){
      $executedCorrectly = false;
      die("Error inserting into database");
    }
  }
  $stmt->close();
	$stmt = $con->prepare("INSERT INTO booking (Cust_id, Veh_reg, Collection_time, Collection_date, Drop_off_time, Drop_off_date, Message) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("issssss", $_SESSION["cust_id"], $_POST["VehicleReg"], $_POST["MeetingTime"], $_POST["MeetingDate"], $_POST["ReturnTime"], $_POST["ReturnDate"], $_POST["Message"]);
  //$_SESSION["cust_id"];
	if(!$stmt->execute()){
		$executedCorrectly = false;
    die("Error inserting into database");
  }
  if(!$executedCorrectly){
    die("EROROR");
  }
  else{
	   $con->commit();
     header("Location: Landing.php?result=bookingcreated"); //Success message yeaaa....
   }

}
else{
?>
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
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">



</head>
<body>
<section id="ext_menu-d">

    <nav class="navbar navbar-dropdown bg-color transparent navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">

                        <a class="navbar-caption text-primary" href="">ALPHA OMEGA PARKING</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                      <li class="nav-item"><a class="nav-link link" href="Landing.php">HOME</a></li>
                      <li class="nav-item"><a class="nav-link link" href="CreateABooking.html">CREATE A BOOKING</a></li>
                      <li class="nav-item"><a class="nav-link link" href="ViewMyBooking.html">VIEW MY BOOKING</a></li>
                      <li class="nav-item"><a class="nav-link link" href="quote.php">GET A QUOTE</a></li>
                      <li class="nav-item"><a class="nav-link link" href="WriteAReview.html">WRITE A REVIEW</a></li>
                      <li class="nav-item"><a class="nav-link link" href="ViewReviews.html">VIEW REVIEWS</a></li>
                      <li class="nav-item"><a class="nav-link link" href="FacebookFeed.html">FACEBOOK FEED</a></li>
                      <li class="nav-item"><a class="nav-link link" href="logout.php">LOGOUT</a></li>
                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="engine"><a rel="external" href=""></a></section><section class="mbr-section mbr-parallax-background mbr-after-navbar" id="form1-q" style="background-image: url(assets/images/mbr-2000x1333.jpg); padding-top: 120px; padding-bottom: 120px;">

    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2">CREATE A BOOKING</h3>

                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">


                    <form action="" method="post" data-form-title="CREATE A BOOKING" onsubmit="this.submit()">



                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form1-q-MeetingDate">Meeting Date at King Shaka Int.<span class="form-asterisk">*</span></label>
                                        <input type="date" class="form-control" name="MeetingDate" required data-form-field="MeetingDate" id="form1-q-MeetingDate">
                                    </div>
                                </div>

                        <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-MeetingTime">Meeting time at King Shaka Int.<span class="form-asterisk">*</span></label>
                                    <input type="time" class="form-control" name="MeetingTime" required data-form-field="MeetingTime" id="form1-q-MeetingTime">
                                </div>
                            </div>


                        <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-ReturnDate">Return Date<span class="form-asterisk">*</span></label>
                                    <input type="date" class="form-control" name="ReturnDate" required data-form-field="ReturnDate" id="form1-q-ReturnDate">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-ReturnTime">Return Time<span class="form-asterisk">*</span></label>
                                    <input type="time" class="form-control" name="ReturnTime" required data-form-field="ReturnTime" id="form1-q-ReturnTime">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-VehicleReg">Vehicle Registration<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="VehicleReg" required data-form-field="VehicleReg" id="form1-q-VehicleReg">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-VehicleMake">Vehicle Make<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="VehicleMake" required data-form-field="VehicleMake" id="form1-q-VehicleMake">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-VehicleModel">Vehicle Model<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="VehicleModel" required data-form-field="VehicleModel" id="form1-q-VehicleType">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-VehicleType">Vehicle Type<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="VehicleType" required data-form-field="VehicleType" id="form1-q-VehicleType">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-q-VehicleColour">Vehicle Colour<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="VehicleColour" required data-form-field="VehicleColour" id="form1-q-VehicleColour">
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="form-control-label" for="form1-10-Message">Message</label>
                            <textarea class="form-control" name="Message" rows="7" data-form-field="Message" id="form1-10-Message"></textarea>
                        </div>
                      </div>
                         <button class="transparent" type="submit"><div class="mbr-section-btn"><a class="btn btn-lg btn-primary">Submit</a></div></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-c" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div class="container">
        <p class="text-xs-center">Copyright (c) 2017 | Piedpiper</p>
    </div>
</footer>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/viewport-checker/jquery.viewportchecker.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>


  <input name="animation" type="hidden">
  </body>
</html>
<?php
}
