<?php
include_once 'helper/autoload.php';
require_once 'helper/functions.php';


$error = true;

if(isset($_POST['login'])){

	$email = sanitize($_POST['email']);
	$password = sanitize($_POST['password']);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$password = hash('sha256',$password);
	$password = strip_tags(addslashes($password));

	// debug($email);
	// debug($password);
	// echo "$email <br/>";
	// echo "$password <br/>";
	

	$count = getCount('All_user', "email ='$email' AND password ='$password'");
	
    //  debug($count );

	if($count==0){
		$error=true;
		$errormsg= '<div id="success" class="alert red">Invalid email or password!</div>';
		// debug($count);
	}
	elseif ($count==1)
	{
		
		$_SESSION['email'] = $email;
		$update = update('All_user', "Last_Login=now(), status='active'","email='$email'");
		// debug($update);
		header('location: profile');
		
	}
	else
	{
		$error=true;
		$errormsg= '<div id="success" class="alert red">\n Login was not successfull try again later!"</div>';
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="the obidient report is the only otentic reprter coming from the right sources and give a right information from obidient movement " />
	<title>login</title>
	<link rel="icon" href="images/logo1.jpg" type="image/png"  sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/font/font.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />

	 <!-- Google Web Fonts -->
	 <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/scripts.js"></script>
<link rel="stylesheet" href="jmobile/jquery.mobile-1.4.5.css" media="all">
<script src="jmobile/jquery.js" media="all"></script>
<script src="jmobile/jquery.mobile-1.4.5.js" media="all"></script>
<!-- Custom Theme files -->
<link href="css/mystyles.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/indexstyle.css" rel="stylesheet" type="text/css" media="all"/>

<!-- <link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />	 -->
<!-- Custom Theme files -->

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!--google fonts-->
<link href="css/pricing.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- animated-css -->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
        <link rel="shortcut icon"  href="images/favicon.png" />
		<script src="js/wow.min.js" text=""> 
		</script>
		<script>
		 new WOW().init();
		</script>
<!-- animated-css -->
<script src="js/modernizr.js"></script>

</head>
	<body class="log-form">
		<div class="top-content">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h1 class="text-center">Sign in</h1>
								<h3 class="text-center">login with your email and password to start Reporting News </h3>
							</div>
							<!-- <div class="form-top-right">
								<i class="fa fa-key"></i>
							</div> -->
						</div>
						<div class="form-bottom">

							<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
							<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
							

							<form role="form" class="form-group " method="POST" action="login">

								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="email"  name="email" id="phone" placeholder="email" class="form-username form-control input-lg" id="form-username" autocomplete="off" required="required">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="password" id="password" placeholder="Password..." class="form-password form-control input-lg" id="form-password" autocomplete="off" required="required">
								</div>

								<div class="form-group">
										<a class="pull-right" href="index" style="color:#0000FF;">Sign up</a>
										<a class="pull-left" href="Re-password" style="color:#0000FF;">Reset Password</a>
								</div>
								<!-- <div class="form-group">
									<input class=" form-control btn btn-primary pull-right" type="submit" name="login" id="Login" value="sign in">
								</div> -->
								<div class="form-group">
									<button type="submit" name="login" id="Login" class="form-control btn-success btn-lg">Sign in</button>
									
								</div>
							</form>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-sm-6 col-md-6   social-login">
							<!-- <h3 style="text-align: center;">you can login with:</h3> -->

							<!-- <div class="social-login-buttons">
								<a class="btn btn-link-1 btn-link-1-facebook" href="#">
									<i class="fa fa-facebook"></i> Facebook
								</a>
								<a class="btn btn-link-1 btn-link-1-twitter" href="#">
									<i class="fa fa-twitter"></i> Twitter
								</a>
								<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
									<i class="fa fa-google-plus"></i> Google Plus
								</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix" style="height: 3cm;"></div>

		<div class="navbar  navbar-fixed-bottom">

			<div class="copy-right">
				<div class="container">
					<div class="copy-rights-main wow zoomIn" data-wow-delay="0.3s">
					<p class="mb-md-0 text-center">&copy; <script>document.write(new Date().getFullYear());</script>  <a class="text-primary" href="#">The Obidient News Reporter</a>. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>