<?php
function generateSalt(){
	$alphaNum = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$salt = "";
	for($i = 0;$i < 8;$i++){
		$salt .= $alphaNum[rand(0, strlen($alphaNum))];
	}
	return $salt;
}
if(isset($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"] , $_POST["phone"])){
	$con = mysqli_connect("localhost", "aoparant_ppadmin", "AlwaysBlue", "aoparant_testdb");
//	mysqli_autocommit($con, false);
	if(!$con)
		die("Error connecting to database");
	$stmt = $con->prepare("SELECT Cust_id FROM Customer WHERE Email=?");
	$stmt->bind_param("s", $_POST["email"]);
	$stmt->execute();
	if($stmt->fetch()){
		die("Duplicate email");
	}
	$stmt->close();
	$stmt = $con->prepare("INSERT INTO Customer (F_Name, L_Name, Email, Password, Phone_num, Salt) VALUES (?, ?, ?, ?, ?, ?)");
	//Generate salt
	$salt = generateSalt();
	//
	$hash = hash("sha512", $salt . $_POST["password"]);
	$stmt->bind_param("ssssss", $_POST["name"], $_POST["surname"], $_POST["email"], $hash, $_POST["phone"], $salt);
	if($stmt->execute())
		header("Location: SignIn.php");
	else
		die("There was an error creating the user.");
	$con->commit();

}
else{
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
<section class="mbr-section mbr-parallax-background" id="form1-3" style="background-image: url(assets/images/mbr-2000x1333.jpg); padding-top: 40px; padding-bottom: 120px;">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2"><span style="font-size: 3rem; line-height: 1.1;">CREATE ACCOUNT</span><br></h3>

                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">
                    <form action="create_account.php" method="post" data-form-title="CREATE ACCOUNT" onsubmit="this.submit()">
                        <div class="row row-sm-offset">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-3-name">Name<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" required data-form-field="name" id="form1-3-name">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-3-surname">Surname<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="surname" required data-form-field="surname" id="form1-3-surname">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-3-email">Email<span class="form-asterisk">*</span></label>
                                    <input type="email" class="form-control" name="email" required data-form-field="email" id="form1-3-email">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-3-password" required>Password<span class="form-asterisk">*</span></label>
                                    <input type="password" class="form-control" name="password" data-form-field="password" id="form1-3-password" required>
                     </div>
                     </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-3-phone">Phone Number<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="phone" data-form-field="phone" pattern="\d{10}" id="form1-3-phone" required>
                                </div>
                            </div>

                        </div>

                        <button class="transparent" type="submit"><div class="mbr-section-btn"> <a class="btn btn-lg btn-primary">Create Account</a></div></button>



                    </form>
										<script>
											function verifyForm(form){

											}
										</script>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="engine"><a rel="external" href=""></a></section><footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-2" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">

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
    <?php
}
