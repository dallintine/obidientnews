<?php
require_once 'helper/autoload.php';
require_once 'helper/user.php';
require_once 'helper/sessiontimeout.php';

if (isset($_SESSION['email'])){
	
	$email = $_SESSION['email'];
}
else{
	header("location: logout");
}

$output1="";
$error = false;

$last_loginDate = getSingle('Last_Login','All_user',"email='$email'");

$phone = getSingle('phonenumber', 'All_user',"email='$email'");
$n_name = getSingle('firstname','All_user',"email='$email'");
$o_name = getSingle('lastname','All_user',"email='$email'");
$f_name ="$n_name $o_name";
$name ="$n_name";
$date = "$last_loginDate";

// echo "$date <br/>";
// echo "$phone <br/>";
// echo "$name <br/>";
// echo "$account_id <br/>";
// echo "$f_name <br/>";
// // die();

if (isset($_POST['submit'])) {
	
	//$fileimage=sanitize($_POST['fileimage']);
	$date = sanitize($_POST['date']);
	// $method = sanitize($_POST['method']);
	$topic = sanitize($_POST['topic'] );
	$News_area = sanitize($_POST['News_area']);

	$fileimage = $_FILES['fileimage']['name'];
	$target_dir  = "fileContent/";
	$target_file  = $target_dir . basename($_FILES["fileimage"]["name"]);
	$imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$fileimagesize = getimagesize($_FILES["fileimage"]["tmp_name"]);

// echo $method.'<br>';
// echo $topic.'<br>';
// echo $News_area. '<br>';
// echo $fileimage .'<br>';



	// if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "mpeg")
	if (!in_array(exif_imagetype($_FILES["fileimage"]["tmp_name"]), array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF))) {
		$error = true;
		$image_error = "The image format is incorrect. Please ensure your image is in JPG, JPEG, PNG or GIF format.";
	
	}
	elseif ($_FILES["fileimage"]["size"] > 90000000) 
	{
		$error = true;
		$image_error= " sorry you can not upload this file the size is too much reduce the size to 3mb";
	}
	elseif (file_exists($target_file)) 
	{
		$error = true;
		$image_error="this image already exit upload another image";
	}
	elseif ($date=='')
	{
		$error= true;
		$date_error="please refresh the page";
		# code...
	}
	elseif($fileimage==''){
		$error = true;
		$image_error="please input your image it cannot be empty";

	}
	elseif (!preg_match("/^[a-zA-Z ]+$/",$topic) ) {
		$error = true;
		$topic_error = "please input the right topic";

	}
	else{
		$successmsg;
		
	}
	// debug($fileimage);
	
	if (!$error) {

		$user_id = getSingle('id', 'All_user', "email='$email'");

		$save = insert('Arcticle_news', "`fileimage`, `user_id`,`topic`, `date_publish`,`News_area`", "'$fileimage' , '$user_id','$topic', now(), '$News_area'");

		move_uploaded_file($_FILES["fileimage"]["tmp_name"], $target_file);
		// debug($target_file);
		$successmsg= "News successfully reported ";

		
	}
	else{
		$error =true;
		$error_msg = "<p>your report did not go please try again</p>";
	}
}

// // video section and control

// if (isset($_POST['videofile'])) {

// 	$video_name2 = sanitize($_POST['video_name']);
// 	$video_name = strtoupper($video_name2);
// 	$target_dir  = "filevideo/";
// 	$videoimage = $_FILES['video_file']['name'];
// 	$videofilNewName =$_FILES['video_file']['name'];
// 	// $target_file  = $target_dir . basename($_FILES["video_file"]["name"]);
// 	$videoFileType  = strtolower(pathinfo($videofilNewName, PATHINFO_EXTENSION));
// 	$videosize = getimagesize($_FILES["video_file"]["tmp_name"]);
// 	$videofilNewName = uniqid('', true)."." .$videoFileType;
// 	$target_file  = $target_dir . $videofilNewName;

// // echo $videoimage.'<br>';
// // echo $target_file.'<br>';
// // echo $videoFileType. '<br>';
// // echo $videosize .'<br>';
// // echo $videofilNewName .'<br>';
// // die();


// 	if(!preg_match("/^[a-zA-Z ]+$/",$video_name) || (strlen($video_name) < 3 ))
// 	{
// 		$error = true;
// 		$CFname_error = "Your video Name must contain only alphabets and space and must be more than three alphabets";

// 	}
// 	elseif ($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov" && $videoFileType != "3gp" && $videoFileType != "mpeg")
// 	{
// 		$error = true;
// 		$videofile_error=" the image format is incorrect please ensure your image are in mp4, 3gp, mpeg & mov";

// 	}
// 	elseif ($_FILES["video_file"]["size"] > 100000000) 
// 	{
// 		$error = true;
// 		$videofile_error= " sorry you can not upload this file the size is too much reduce the size to 3mb";
// 	}
// 	elseif (file_exists($target_file)) 
// 	{
// 		$error = true;
// 		$videofile_error="this video already exit ";
// 	}
// 	else{
// 		$successmsg;
// 	}
	
// 	if (!$error) {

// 		$save = insert('video_file', "`video_name`,`Vidpublish_date`,`Video_newfile`", "'$video_name' , now(), '$videofilNewName'");

// 		// INSERT INTO `video_file`(`Seria_NO`, `video_name`, `Vidpublish_date`, `Video_newfile`) VALUES ([value-1],[value-2],[value-3],[value-4])

// 		move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file);

// 		$successmsg2= "<span class='text-success'>file successfully upload </span>'";

		
// 	}
// 	else{
// 		$error =true;
// 		$errormsg2 = "<p>login error try again letter</p>";
// 	}
// 	// exit();
// }


// if (isset($_POST['submit']))
// 	{

// 		$sn = 0;
// 		$result = getAll("*", 'script_news');
// 		foreach ($result as $key => $value)
// 		{

// 			$sn+=1;
// 			$fileimage = sanitize($value['fileimage']);
// 			$topic = sanitize($value['topic']);
// 			$date_publish = sanitize($value['date_publish']);
// 			$News_area = sanitize($value['News_area']);
		

// 			$output1 .= '<div class="media"><div class="media-left">
// 						<img src="contentimage/'.$fileimage.'"class="media-object" style="width:70px">
// 					</div>
// 					<div class="media-body">
// 						<h4 class="media-heading" style="font-weight:bold; color:#800080;">'.$topic.'</h4>
// 						<h4 class="media-heading" style="font-weight:bold; color:#000080;">'.$date_publish.'</h4>
// 						<p>'.$News_area.'</p> <button class="btn btn-default btn-sm"><a href="">Read More &raquo;</a></button>
// 					</div>
// 				</div>';
// 		}
// 	}

?>

<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="the obidient report is the only otentic reprter coming from the right sources and give a right information from obidient movement" />
	<title>Obidient-dashboard</title>
	
	<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
	<link rel="icon" href="images/logo1.jpg" type="image/png"  sizes="16x16">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font/font-awesome.min.css">
	<link rel="stylesheet" href="css/form-elements.css">
	<link rel="stylesheet" href="assets/css/styleprofil.css" media="screen"> 


	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
			
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-min.js"></script>
	<script src="assets/js/jquery.bxslider.js"></script>
	<script src="assets/js/selectnav.min.js"></script> -->
	<!-- <script src="js/chatscript.js"></script> -->

	<link href="assets/css/indexstyle.css" rel="stylesheet" type="text/css" media="all"/>
	

	<link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="all"/>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- <link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />	 -->
	<!-- Custom Theme files -->
	<script type="application/x-javascript">

		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar(){
			window.scrollTo(0,1);
		}
	</script>
	<!--Google Fonts-->
	<link href='//fonts.googleapis.com/css?family=Quicksand:400,300,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!--google fonts-->
	<link href="css/pricing.css" rel="stylesheet" type="text/css" media="all">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- animated-css -->
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" media="all">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<script src="assets/js/wow.min.js"></script>

	<script>
		new WOW().init();
	</script>

	<!-- animated-css -->
	<script src="js/modernizr.js"></script>
	<script>
		$(document).ready(function(){
			if (Modernizr.touch) {
				// show the close overlay button
				$(".close-overlay").removeClass("hidden");
				// handle the adding of hover class when clicked
				$(".branch-gd").click(function(e){
					if (!$(this).hasClass("hover")) {
						$(this).addClass("hover");
					}
				});
				// handle the closing of the overlay
				$(".close-overlay").click(function(e){
					e.preventDefault();
					e.stopPropagation();
					if ($(this).closest(".branch-gd").hasClass("hover")) {
						$(this).closest(".branch-gd").removeClass("hover");
					}
				});
			} else {
				// handle the mouseenter functionality
				$(".branch-gd").mouseenter(function(){
					$(this).addClass("hover");
				})
				// handle the mouseleave functionality
				.mouseleave(function(){
					$(this).removeClass("hover");
				});
			}
		});
	</script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<!--header-top start here-->
<div class="top-header">
	<div class="container">
		<div class="top-header-main">
			<div class="col-md-4 top-social wow bounceInLeft" data-wow-delay="0.3s">
			    <ul class="">
			    	<li><a href="https://www.facebook.com/wazogist -1775811569350999/"><span class="fb"> </span></a></li>
			    	<li><a href="https://twitter.com/wazogist"><span class="tw"> </span></a></li>
			    	<li><a href="https://www.linkedin.com/in/wazogist-639846135?trk=nav_responsive_tab_profile"><span class="in"> </span></a></li>
			    	<li><a href="https://plus.google.com/u/2/100637740920802030201"><span class="gmail"> </span></a></li>
                    <li><a href="https://www.whatsapp.com/" title="+234 803 948 4187"><span class="whatsapp"> </span></a></li>
			    </ul>
			</div>
			<div class="col-md-8 header-address wow bounceInRight" data-wow-delay="0.3s">
				<ul class="nav nav-bar">
					<li><a><span class="glyphicon glyphicon-earphone"> </span> <h6>(+1) 202 787 8909 </h6></a></li>
					<li><span class="email"> </span><h6><a href="mailto:obidientreporters.com">info@obidientreporters.com</a></h6></li>
					<li><img src="images/image11.jpg" class="media-object img-circle " style="width: 20px; height: 20px;"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="" aria-expanded=""><?php echo $name; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><?php echo $email; ?></a></li>
							<li><a href="#">update your profile</a></li>
                            <li><a href="#">Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
						</ul>
                    <!-- <ul class="nav navbar-nav"> ... </ul> -->
					</li>
				</ul>
				
			</div>
		  
		</div>
	</div>
</div>
<div class="clear-both"> </div>
<!--header-top end here-->
<!--header-top end here-->
<!--header start here-->
	<!-- NAVBAR
		================================================== -->

<!--header end here-->
<div  class="container">
	<div class="row">
		<div class="col text-center">
			<h3>
				choose the kind of report you want to Publish
			</h3>
			<form >
				<div class="form-group">

					<label class="control-label" for="News">News Section</label>

					<select id="method" name="method" class="form-control" required="required" tabindex="2" onchange="showFun(this)">
						<option value="Education News">Breaking News</option>
						<option value="Admission Status">Obidients Latest News</option>
						<option value="Mini Library">Obidients Gallary</option>
						<option value="Job Vacancy">Obidients Video</option>
						<option value="News update">Obidients Endorsed Candidate</option>
						<option value="Audio update">Obidients Audio</option>
						<option value="select" selected="selected">Select</option>
					</select>
					
				</div>

			</form>
		</div>
		

	</div>

</div>
<div class="container">
	<!-- <div class="article-set"> -->
		<div class="row">
		<div class="align-self-center">
			<div class="col col-lg-8 col-lg-offset-2   Breaking_news" id="Education News"  >
				<h1 class="text-center">Drop your Report </h1>

				<div class="">
					<div class="text-center">
						<span class="text-success text-center"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
						<span class="text-danger text-center"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
					</div>
					

					<form class="form-horizontal form-group" name="profile" method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


						<div class="form-group">
							<label class="control-label" for="image">Download Image</label>
							<input type="file" name="fileimage" id="fileimage" placeholder="fileimage" readonly value="article image" class="" tabindex="1">	
							<span class="text-danger"><?php if (isset($image_error)) echo $image_error; ?></span>
						</div>

						<div class="form-group">
							<label class="control-label" for="date">Date</label>
							<input type="text" name="date" id="date" placeholder="date" readonly value="<?php echo datetime_to_word('now') ?>" class="form-control">

							<span class="text-danger"><?php if (isset($date_error)) echo $date_error; ?></span>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="topic">Topic</label>
							<input type="text" name="topic" id="topic"placeholder="topic of your article" maxi-length="30" value="<?php if($error) echo $topic; ?>" class="form-control" tabindex="3">
							<span class="text-danger"><?php if (isset($topic_error)) echo $topic_error; ?></span>	
						</div>

						<div class="form-group shadow-textarea">
							<label class="control-label" for="textarea">type your articles here</label>
							<textarea class="form-control rounded-1" id="exampleFormControlTextarea1" name="News_area" rows="10" tabindex="4"></textarea>
						</div>

						<div class="form-group ">
							<input type="submit" name="submit" id="submit" value="Report" tabindex="5" class="btn btn-primary pull-right">
						</div>
						
					</form>
					
				</div>	
			</div>

			<div class="clear-both"></div>

			<div class="col col-lg-8 col-lg-offset-2 Breaking_news" style="display:none;" id="Job Vacancy">
				<h1 class="text-center">Upload your video here </h1>
				<p style="padding: 15px;"></p>

				<div class="">
					
					<span class="text-success"><?php if (isset($successmsg2)) { echo $successmsg2; } ?></span>
					<span class="text-danger"><?php if (isset($errormsg2)) { echo $errormsg2; } ?></span>

					<form class="form-group  form-horizontal " name="profile" method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

						<div class="form-group">
							<input type="text" class="form-control " name="video_name" placeholder="input video name" value="<?php if($error) echo $video_name; ?>" tabindex="1">
							<span class="text-danger"><?php if (isset($videofile_error)) echo $videofile_error; ?></span>
						</div>
						<div class="form-group">
							<input type="file" class="form-control file-control " name="video_file" value="Browse">
							<span class="text-danger"><?php if (isset($videofile_error)) echo $videofile_error; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary form-control" name="videofile" value="Upload">
							<span class="text-danger"><?php if (isset($video_error)) echo $video_error; ?></span>
						</div>
						
					</form>
					
					

				</div>

				
			</div>

			<div class="col col-lg-8 col-lg-offset-2 Breaking_news" style="display:none;" id="Audio update">
				<h1 class="text-center">Upload your Audio here </h1>
				<p style="padding: 15px;"></p>

				<div class="">
					
					<span class="text-success"><?php if (isset($successmsg2)) { echo $successmsg2; } ?></span>
					<span class="text-danger"><?php if (isset($errormsg2)) { echo $errormsg2; } ?></span>

					<form class="form-group  form-horizontal " name="profile" method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

						<div class="form-group">
							<input type="text" class="form-control " name="video_name" placeholder="input Name name" value="<?php if($error) echo $video_name; ?>" tabindex="1">
							<span class="text-danger"><?php if (isset($videofile_error)) echo $videofile_error; ?></span>
						</div>
						<div class="form-group">
							<input type="file" class="form-control file-control " name="Audio_file" value="Browse">
							<span class="text-danger"><?php if (isset($videofile_error)) echo $videofile_error; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary form-control" name="Audiofile" value="Upload">
							<span class="text-danger"><?php if (isset($video_error)) echo $video_error; ?></span>
						</div>
						
					</form>
					
					

				</div>

				
			</div>

			<div class="col col-lg-8 col-lg-offset-2 Breaking_news" style="display:none;" id="Mini Library">
					<h2 class="text-center"> Add picture for Gallary</h2>
					<form  class="form-horizontal form-group" name="profile" method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<div class="form-group col-lg">
									<input type="text" class="form-control " name="imag_name" placeholder="Add Image topic" value="<?php if($error) echo $video_name; ?>" tabindex="1">
									<span class="text-danger"><?php if (isset($videofile_error)) echo $videofile_error; ?></span>
								</div>
								<div class="form-group col-lg">
									<label class="control-label" for="image">Upload your Image</label>
									<input type="file" name="gfileimage" id="gfileimage" placeholder="Add Image to Upload" readonly value="article image" class="form-control" tabindex="1">

									<span class="text-danger"><?php if (isset($image_error)) echo $image_error; ?></span>

								</div>
								<div class=" form-group">
									<input type="submit" name="imgsubmit" class="btn btn-primary form-control" value="Upload">

								</div>
					</form>
					

			</div>

			
		</div>
		
</div>
<div class="container-fluid">
	<div class="row">
		<div class="clearfix" style="padding: 15px; height: 10px;"></div>
			<div class="clear-both"></div>

			<div class="display_content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<p style="padding: 15px;"></p>
								<div class="textoutput">
									<?php echo $output1; ?>
								</div>	
						</div>
				

						<div class="col-sm-12 col-md-6">
							<p style="padding: 15px;"></p>
								<div class="videoOutput">
									<?php echo $output1; ?>
								</div>		
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

</div>

<!-- <select onchange="toggleDiv(this)">
  <option value="div1">Option 1</option>
  <option value="div2">Option 2</option>
  <option value="div3">Option 3</option>
</select>

<div class="toggleable" id="div1">This is div 1</div>
<div class="toggleable" id="div2" style="display: none;">This is div 2</div>
<div class="toggleable" id="div3" style="display: none;">This is div 3</div> -->

<!-- chat section  -->

<!-- <div class="chat_box">
	<div class="chat_head">
		Friends Online
	</div>
	<div class="chat_body">
		<div class="user">samuel dallintine</div>
	</div>
</div> -->

<!-- <div class="msg_box" style="right:290px">
	<div class="msg_head"> samuel dallintine
		<div class="close">x</div>
	</div>
	<div class="msg_wrap">
			<div class="msg_body">
				<div class="msg_aphoto"></div>
				<div class="msg_a">This is from A</div>

				<div class="msg_bphoto"></div>
				<div class="msg_b">This is from B, and its amazingly kool nah... i know it even i liked it</div>
				<div class="msg_a">Wow, Thats great to hear from you man </div>	
				<div class="msg_push"></div>
			</div>
		<div class="msg_footer"><textarea class="msg_input" rows="4" style="text-align: middle;"></textarea></div>
	</div>
</div> -->

<!--copy rights start here-->
<div class="container_fluid">
	<div class="row">
		<nav class="navbar navbar-inverse navbar-fixed-bottom">
			<p style="padding: 10px; height: 1px;"></p>
			<div class="copy-right">
				<div class="container">
					<div class="copy-rights-main wow zoomIn" data-wow-delay="0.3s">
						<p class="mb-md-0 text-center">&copy; <script>document.write(new Date().getFullYear());</script>  <a class="text-primary" href="#">The Obidient News Reporter</a>. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</nav> 
	</div>
</div>

	


	<script type="text/javascript">

		function showFun(selectElement) {

			var selectedValue = selectElement.value;
			var divs = document.querySelectorAll('.Breaking_news');
			
			for (var i = 0; i < divs.length; i++) {
				if (divs[i].id === selectedValue) {
					divs[i].style.display = 'block';
				} 
				else {
					divs[i].style.display = 'none';
				}
			}
		}


		// function toggleDiv(selectElement) {
		// 		var selectedValue = selectElement.value;
		// 		var divs = document.querySelectorAll('.toggleable');
				
		// 		for (var i = 0; i < divs.length; i++) {
		// 			if (divs[i].id === selectedValue) {
		// 			divs[i].style.display = 'block';
		// 			} else {
		// 			divs[i].style.display = 'none';
		// 			}
		// 		}
		// }
	</script>

	
</body>
</html>
