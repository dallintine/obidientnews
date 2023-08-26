<?php
require_once 'helper/autoload.php';
require_once 'helper/functions.php';

$error = false;

if (isset($_POST['submit'])) {
  $firstname = sanitize($_POST['firstname']);
	$MiddleName = sanitize($_POST['MiddleName']);
  $lastname = sanitize($_POST['lastname']);
	$phonenumber = sanitize($_POST['phonenumber']);
	$email = sanitize($_POST['email']);
	$password = sanitize($_POST['password']);
  $confirmpassword = sanitize($_POST['confirmpassword']);
	
	// $agree = sanitize($_POST['agree']);
	$code=substr(md5(mt_rand()),0,30);

	$email_count = getCount('All_user', "email='$email'");
	$phone_count = getCount('All_user', "phonenumber='$phonenumber'");
					

  // echo "$firstname <br/>";
	// echo "$MiddleName <br/>";
	// echo "$lastname<br/>";
	// echo "$phonenumber<br/>";
	// echo "$email<br/>";
	// echo "$password<br/>";

		//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$firstname) || (strlen($firstname) < 3 )) {

    $error = true;
    $firstname_error = "your first Name must contain only alphabets and space";

	}
  elseif (!preg_match("/^[a-zA-Z ]+$/",$MiddleName) || (strlen($MiddleName) < 3 )) 
  {
    $error = true;
    $MiddleName_error = "your middle name must contain only alphabets and space";
  }
	elseif (!preg_match("/^[a-zA-Z ]+$/",$lastname) || (strlen($lastname) < 3 )){
    $error = true;
		$lastname_error = "your last name must contain only alphabets and space";
	}
 
	elseif(filter_var($email,FILTER_VALIDATE_EMAIL) == false) {
    $error = true;
    $email_error = "Please Enter Valid Email Address";
  }
	elseif ($email_count > 0) {
    $error = true;
    $email_error="this email is already used kindly choose another email address";
  }
  elseif ($phone_count > 0) {
    $error = true;
    $phonenumber_error="this phone number is already used by another person";
  }
  elseif(strlen($password) < 6  || ($_POST['password']!==$_POST['confirmpassword']) )
  {
    $error = true;
    $password_error = "password do not match try again";
  }
  else
  {
    $password = hash('sha256', $password);
    
    $save = insert('All_user', "`firstname`, `MiddleName`, `lastname`, `phonenumber`, `email`, `password`, `Registration_Date`", "'$firstname' ,'$MiddleName', '$lastname', '$phonenumber', '$email', '$password',now() ");
    // debug($save);
    $successmsg ="<h1>successfull,  click login button to login and report your news now </h1>";

    // header("Location: index");
  }

	//  if (!$error) {
	//  		$password = hash('sha256', $password);
	// 		$confirm_password = hash('sha256',$confirm_password);

	// 		// $save = insert('member', "`name`, `othername`, `email`, `password`, `confirm_password`, `phone`, `date-Registered`,`code`", "'$name' ,'$othername', '$email', '$password', '$confirm_password', '$phone',now() ,'$code'");


	// 			if($save)  
	// 			{
	// 				$to=$email;
	// 				$subject="Welcome to jambcbtmock.com";
	// 				$body='Your Registration was successful and your activation code is on the link  Please Click On This link(copy this link to your url if it is not clickable)<a href="http://www.jambcbtmock.com/nkin.php?code='.$code.'">http://www.jambcbtmock.com/nkin.php?code='.$code.'</a> to activate your account';
	// 				$from ='info@jambcbtmock.com';
	// 				$header="from: $from\r\n";
	// 				$header.="Content-Type: text/html; charset=UTF-8";
	// 				mail($to,$subject,$body,$header);

	// 				header("Location: verification");

	// 			} else {
	// 					$errormsg = "Error in registering...Please try again !";
	// 			}
	// 			if ($save) {
	// 				$to='admin@jambcbtmock.com,info@jambcbtmock.com';
	// 				$subject="Registered";
	// 				$body='This member <b>'.$name.' '.$othername.'</b> with phone number <b>'.$phone.'</b> has register with us call to follow up';
	// 				$from ='Admin@jambcbtmock.com';
	// 				$header="from: $from\r\n";
	// 				$header.="Content-Type: text/html; charset=UTF-8";
	// 				mail($to,$subject,$body,$header);
	// 			}
	// 			// else{
	// 			//   $successmsg
	// 			// }
	// 	}
  }
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="">
<head>
    <title>Obidient_reporters</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/logo1.jpg" type="image/png"  sizes="16x16">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/font/font.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />

    <link rel="stylesheet" href="assets/css/bootstrap.min1.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <!-- <link rel="stylesheet" href="assets/css/responsive.css"> -->
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">

</head>
<body>
<div class="body_wrapper">
  <div class="center">
    <div class="header_area">
      
          <div class="logo floatleft"><a href="#"><img src="images/logo3.png" alt=""  width="170" height="170"/></a></div>
      
      
                <!-- collection of errors  -->
          <div class="top_menu floatcenter">
              <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
              <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
          </div>
      
      
        <div class="top_menu floatright form-group">
          <h2 class="text-success text-center"> Please <b>subscribe </b></h2>

          <form>
            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="submit" name="subsubmit" class="form-control btn-primary text-center" value="Subscribe" >
            </div> 
          </form>
      </div>
  
    </div>
    <!-- menue page  -->
    <div class="main_menu_area">
      
      

      <ul id="nav2">
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav2" aria-controls="nav2" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
        </button> -->
      <li><a href="index">Home</a></li>
        <li class="nav-item"><a class=""href="#">Breaking News</a>
          <ul>
            <li><a href="#">Peter Obi Court News</a></li>
            <li><a href="#">Peter TV news</a></li>
            <li><a href="#">Pull Result Collection </a>
              <ul>
                <li><a href="#">2023</a></li>
                <li><a href="#">2027</a></li>
                <li><a href="#">2031</a></li>
                <li><a href="#">2035</a></li>
                <li><a href="#">2039</a></li>
              </ul>
            </li>
            <li><a href="#">Governance</a></li>
            <li><a href="#">More item</a></li>
          </ul>
        </li>
        <li><a href="#">Polities</a></li>
        <li><a href="#">Gallery</a>
          <ul>
            <li><a href="#">2023</a></li>
            <li><a href="#">2027</a></li>
            <li><a href="#">2031</a></li>
            <li><a href="#">2035</a></li>
            <li><a href="#">2039</a></li>
          </ul>
        </li>
        
        <li><a href="#">videos</a>
          <ul>
            <li><a href="#">More videos</a></li>
            <li><a href="#">More videos</a></li>
            <li><a href="#">More videos</a>
              <ul>
                <li><a href="#">More videos</a></li>
                <li><a href="#">More videos</a></li>
                <li><a href="#">More videos</a></li>
                <li><a href="#">More videos</a></li>
                <li><a href="#">More videos</a></li>
              </ul>
            </li>
            <li><a href="#">More videos</a></li>
            <li><a href="#">More videos</a></li>
          </ul>
        </li>
        
        
        <li><a href="#">Candidates</a>
          <ul>
            <li><a href="#">2023</a></li>
            <li><a href="#">2027</a></li>
            <li><a href="#">2031</a></li>
            <li><a href="#">2035</a></li>
            <li><a href="#">2039</a></li>
          </ul>
        </li>
        <li><a href="about">About Us</a></li>
      </ul>
    </div>

    <div class="slider_area">
      <div class="slider">
        <ul class="bxslider">
          <li><img src="images/image7.jpg" alt="" title="Slider caption text" width="1000" Height="300" Style="height:500px;"></li>
          <li><img src="images/image9.jpg" alt="" title="Slider caption text" width="1000" Height="300" Style="height:500px;"/></li>
          <li><img src="images/image11.jpg" alt="" title="Slider caption text" width="1000" Height="300" Style="height:500px;"/></li>
        </ul>
      </div>
    </div>
<div class="clearfix" style="padding: 7px;"></div>
    <div class="content_area">
      <!-- left row -->
      <div class="main_content floatleft">
        <div class="left_coloum floatleft">
          <div class="single_left_coloum_wrapper">
            <h2 class="title">Breaking News</h2>
            <a class="more" href="#">more</a>
            <div class="single_center_coloum floatright"> <img src="images/image16.jpg" alt="" />
              <h1 class="text-center">Enough is enough</h1>
              <p style="margin-left: 12px;">I stand to be arrested and prosecuted . If the police is failing to take steps to protect voters in Nigeria particularly in Lagos , I urge all Nigerians who feel threatened by thugs wanting  to deprive them from voting and harm them   to go to their polling booths armed with 2 by 2 , 2 by 4 planks , , iron rods </p>
              <a class="readmore" href="#"style="margin-left: 12px; padding: 6px;">read more</a> </div>
            <div class="single_right_coloum floatright"> <img src="images/image7.jpg" alt="" />
              <h1 class="text-center">LAY MAN BREAKDOWN CASE AGAINST TINUBUAND INEC.</h1>
              <p  style="margin-left: 12px;">LAY MAN BREAKDOWN OF OBI CASE AGAINST TINUBU AND INEC. 1 Obi say Tinubu “was fined $460,000 for an offence involving dishonesty, namely narcotics trafficking imposed by the United States District Court, Northern District of Illinois, Eastern Division, in case no:93C 4483″ between the United States of America and Bola Tinubu. Meaning Tinubu was an alleged DRUG BARON. Anybody wey don pay fine to any govt for drug business no suppose contest for any election for Nigeria .( I go explain this more in my bullet) . </p>
              <a class="readmore" href="#" style="margin-left: 12px;">read more</a> </div>
            <div class="single_left_coloum floatleft"> <img src="images/single_featured.png" alt="" />
              <h3>Lorem ipsum dolor sit amet, consectetur</h3>
              <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper 
                dolor eu mattis.</p>
              <a class="readmore" href="#">read more</a> </div>
          </div>
          <div class="single_left_coloum_wrapper">
            <h2 class="title">Obidient latest news</h2>
            <a class="more" href="#">more</a>
            <div class="single_left_coloum floatleft"> <img src="images/single_featured.png" alt="" />
              <h2>Corruption among Nigerian Judiciary</h2>
              <p>The Nigerian Judiciary is highly highly corrupt, so Politicians are taking advantage of our corrupt Judiciary, to subvert the will of the people by rigging themselves into power. Hence the phrase "Go to court" because they know nothing will happen. Tinubu planned to use that Format on Peter Obi, after openly rigging himself to victory, alongside our corrupt INEC.</p>
              <a class="readmore" href="#">read more</a> </div>
            <div class="single_left_coloum floatleft"> <img src="images/single_featured.png" alt="" />
              <h2>Peter Obi's Election Petition</h2>
              <p> have just carefully gone through this Peter Obi’s election petition and I have come to the conclusion that Peter Obi is the most dangerous man in this here country called Nigeria. Not only is he challenging the fraud for an election, but he is putting the entire country on trial for allowing a drug baron qualify to run and thereafter proceeded to rig the election. 
                dolor eu mattis.</p>
              <a class="readmore" href="#">read more</a> </div>
            <div class="single_left_coloum floatleft"> <img src="images/single_featured.png" alt="" />
              <h2>Bola Tinubu first speech against Igbos
              </h2>
             <p>President-elect, Federal Republic of Nigeria, Bola Tinubu Jagaban delivers first Presidential Speech against Igbos in Lagos. "( Oracle ti soro ) Ohun ti Awon Agba Eko yoo fi jeko ni ojo Saturday, abe ewe ni won toju re si o".Translation:   "These are people who left their villages, came into lagos from childhood, 12 years of age. We accommodated and took care of them. Now, they want to bite the fingers that fed them"..</p>
              <a class="readmore" href="#">read more</a> </div>
          </div>
          <div class="single_left_coloum_wrapper gallery">
            <h2 class="title">Obidient gallery</h2>
            <a class="more" href="#">more</a> 
            <img src="images/image1.jpg" alt=""   style="width: 140px; height: 100px;"> 
            <img src="images/image2.jpg" alt="" style="width: 140px; height: 100px;"> 
            <img src="images/image3.jpg" alt="" style="width: 140px; height: 100px;"> 
            <img src="images/image4.jpg" alt="" style="width: 140px; height: 100px;"> 
            <img src="images/image5.jpg" alt="" style="width: 140px; height: 100px;"> 
            <img src="images/image6.jpg" alt="" style="width: 140px; height: 100px;"> 
          </div>

          <div class="single_left_coloum_wrapper single_cat_left">
            <h2 class="title">Obidient endorsed candidate 2023</h2>
            <a class="more" href="#">more</a>
            <div class="single_cat_left_content floatleft">
              <h3>Lorem ipsum dolor sit amet conse ctetur adipiscing elit </h3>
              <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor ...interdum</p>
              <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>
            </div>
            <div class="single_cat_left_content floatleft">
              <h3>Lorem ipsum dolor sit amet conse ctetur adipiscing elit </h3>
              <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor ...interdum</p>
              <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>
            </div>
            <div class="single_cat_left_content floatleft">
              <h3>Lorem ipsum dolor sit amet conse ctetur adipiscing elit </h3>
              <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor ...interdum</p>
              <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>
            </div>
            <div class="single_cat_left_content floatleft">
              <h3>Lorem ipsum dolor sit amet conse ctetur adipiscing elit </h3>
              <p>Nulla quis lorem neque, mattis venenatis lectus. In interdum ullamcorper dolor ...interdum</p>
              <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>
            </div>
          </div>
        </div>
        <!-- center row -->
        <div class="right_coloum floatright">
          <div class="single_right_coloum">
            <h2 class="title">Obidient article</h2>
            <ul>
              <li>
                <div class="single_cat_right_content">
                  <h3>OBI Challenges the process through which TINUBU was Elected</h3>
                  <p>If Peter Obi tells the court that he won the election and should be declared winner, that would be DELUSIONAL and he will lose the case. That is why I tell the Obidients to calm down and know the facts and stop holding on to delusions. By what INEC produced as results, Peter Obi did not win. So Peter Obi's MAJOR case should be to challenge the process that produced TINUBU with enormous evidence of rigging and Disenfranchisement etc.</p>
                  <p class="single_cat_right_content_meta"><a href="#"><span>read more</span></a> 3 hours ago</p>
                </div>
              </li>
              <li>
                <div class="single_cat_right_content">
                  <h3> INDIGENOUS PEOPLE OF NIGER DELTA</h3>
                  <p>Lagos Election is Declaration of War against our People - Indigenous People of Niger Delta (IPND) We have watched with sadness the Governorship and House of Assembly Election in Lagos that follow same process with the Presidential and National Assembly Elections as they were used by some political elements from Yoruba tribe as declaration of war against our people and fellow citizens. As we condemn this act of barbarism by some political elements from Yoruba tribe, we hereby call on the Government of Nigeria and the International Communities, most especially the EU, USA, Government of Canada, UK Government etc to intervene before it is too late.</p>
                  <p class="single_cat_right_content_meta"><a href="#"><span>read more</span></a> 3 hours ago</p>
                </div>
              </li>
              <li>
                <div class="single_cat_right_content">
                  <h3>Lorem ipsum dolor sit amet conse ctetur adipiscing elit</h3>
                  <p>Nulla quis lorem neque, mattis venen atis lectus. In interdum ull amcorper dolor eu mattis.</p>
                  <p class="single_cat_right_content_meta"><a href="#"><span>read more</span></a> 3 hours ago</p>
                </div>
              </li>
            </ul>
            <a class="popular_more" href="#">more</a> </div>
          <div class="single_right_coloum">
            <h2 class="title">Obidient videos</h2>
            <div class="single_cat_right_content editorial"> <video width="200" height="200" controls src="filevideo/video6.mp4" type="video/mp4" ></video>
              <h3>Exposed!! 21 lies Festus Kayamo Told on Tinubu U.S.Drug and Money Laudering Court Case </h3>
            </div>
            <div class="single_cat_right_content editorial"> <video width="200" height="200" controls src="filevideo/video2.mp4" type="video/mp4" ></video><h3> Citizens been Defranchised by APC sponsored thugs</h3>
            </div>
            <div class="single_cat_right_content editorial"> <video width="200" height="200" controls src="filevideo/video3.mp4" type="video/mp4" ></video>
              <h3>Protest at Abia Against Malpractices during Governorship Election
              </h3>
            </div>
            <div class="single_cat_right_content editorial"> <video width="200" height="200" controls src="filevideo/video4.mp4" type="video/mp4" ></video>
              <h3>Historic event by which Bola Tinubu Retreived his Mandate</h3>
            </div>
          </div>
        </div>
      </div>
          <!-- right row  -->
      <div class="sidebar floatright">
        <div class="single_sidebar"> <img src="images/logo3.png" alt="" /> </div>
        <div class="single_sidebar">
          <div class="news-letter">
            <h2 class="text-center text-danger">Sign Up for Obidient reporters</h2>
            <p style="font-size:1.2vw" class="text-center">Sign up or Login to report a News</p>

                  <!-- collection of error message  -->
            

                  <!-- Registration  -->
            <form  role="form" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="register" >

              <div class="form-group">
                    <input type="text" name="firstname" value="<?php if($error) echo $firstname; ?>" placeholder="First Name" class="form-control" id="firstname" required="required"/>
                    <span class="text-danger"><?php if (isset($firstname_error)) echo $firstname_error; ?></span>
              </div>
              
              <div class="form-group">
                    <input type="text" name="MiddleName" value="<?php if($error) echo $MiddleName; ?>" placeholder="Middle Name" class="form-control" id="MiddleName" required="required"/>
                    <span class="text-danger"><?php if (isset($MiddleName_error)) echo $MiddleName_error; ?></span>
              </div>
              

              <div class="form-group">
                    <input type="text" name="lastname" value="<?php if($error) echo $lastname; ?>" placeholder="Last Name" class="form-control" id="lastname" required="required" />
                    <span class="text-danger"><?php if (isset($lastname_error)) echo $lastname_error; ?></span>
              </div>

              <div class="form-group">
                    <input type="Phone" name="phonenumber" value="<?php if($error) echo $phonenumber; ?>" placeholder="phone Number" class="form-control" id="phonenumber" required="required"/>

                    <span class="text-danger"><?php if (isset($phonenumber_error)) echo $phonenumber_error; ?></span>
              </div>

              <div class="form-group">
                  <input type="email" name="email" value="<?php if($error) echo $email; ?>" placeholder="Email"
                  class="form-control" id="email" required="required"/>
                  <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
              </div>
              <div class="form-group">
                  <input type="password" name="password" value="<?php if($error) echo $password; ?>" placeholder="Password" class="form-control" id="password" required="required"/>
                  <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
              </div>

              <div class="form-group">
                    <input type="password" name="confirmpassword" value="<?php if($error) echo $confirmpassword; ?>" placeholder="Re-enter Password" class="form-control" id="confirmpassword" required="required"/>

                    <span class="text-danger"><?php if (isset($confirmpassword_error)) echo $confirmpassword_error; ?></span>
              </div>
              <div class="form-group">
                    <input type="submit"  name="submit" value="Register" class="form-control btn btn-primary" id="submit" />
              </div>
              
                <div class="form-group">
                    <a type="button" href="login" class="btn btn-success text-center form-control" value="login">Login</a>
                </div>
              
            </form>
            <!-- <p class="news-letter-privacy">We do not spam. We value your privacy!</p> -->
          </div>
        </div>
        <div class="single_sidebar">
          <div class="popular">
            <h2 class="title">Obidient audio News</h2>
            <ul>
              <li>
                <div class="single_popular">
                  <p>Feb 28th 2023</p>
                  <h3 class="" >
                    <audio controls autoplay muted  style="width:100%;">
                      <source src="filevAudio/audio4.ogg" type="audio/ogg">
                      <source src="filevAudio/audio1.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                  </h3>
                </div>
              </li>
              <li>
                <div class="single_popular">
                  <p>Feb 28th 2023</p>
                  <h3>
                    <audio controls autoplay muted  style="width:100%;">
                      <source src="filevAudio/audio5.ogg" type="audio/ogg">
                      <source src="filevAudio/audio1.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                  </h3>
                </div>
              </li>
              <li>
                <div class="single_popular">
                  <p>Feb 28th 2023</p>
                  <h3>
                    <audio controls autoplay muted  style="width:100%;">
                      <source src="filevAudio/audio6.ogg" type="audio/ogg">
                      <source src="filevAudio/audio1.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                  </h3>
                </div>
              </li>
              <li>
                <div class="single_popular">
                  <p>Feb 28th 2023</p>
                  <h3>
                    <audio controls autoplay muted  style="width:100%;">
                      <source src="filevAudio/audio1.ogg" type="audio/ogg">
                      <source src="filevAudio/audio1.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                  </h3>
                </div>
              </li>
              <li>
                <div class="single_popular">
                  <p>Feb 28th 2023</p>
                  <h3>
                    <audio controls autoplay muted  style="width:100%;">
                      <source src="filevAudio/audio7.ogg" type="audio/ogg">
                      <source src="filevAudio/audio1.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                    </audio>
                  </h3>
                </div>
              </li>
            </ul>
            <a class="popular_more">more</a> </div>
        </div>
        <div class="single_sidebar"> <img src="images/logo3.png" alt="" /> </div>
        
      </div>
    </div>
    <div class="footer_top_area">
      
    </div> 
  </div>
</div>
  <div class="info_section layout_padding">
      <div class="container ">
        <div class="info_content">
              <div>
          <div class="row">
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Politics 
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="">
                      Politics For today
                    </a>
                  </li>
                  <li>
                    <a href="">
                      2023 Election Details
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Governance
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Editorial
                    </a>
                  </li>
                  <li>
                    <a href="">
                      News
                    </a>
                  </li>
                </ul>
                <!-- <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="">
                       FOREIGN
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Obidient diaspora
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Gallary
                    </a>
                  </li>
                  <li>
                    <a href="">
                      public opinion
                    </a>
                  </li>
                </ul> -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Organisation
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="">
                      Termes of service
                    </a>
                  </li>
                  <li>
                    <a href="">
                      meet the teams
                    </a>
                  </li>
                  <li>
                    <a href="">
                      About Departments
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Services
                    </a>
                  </li>
                  <li>
                    <a href="">
                      profile
                    </a>
                  </li>
                </ul>
                <!-- <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="">
                      Cancer Oncology
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Dental Surgery
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Diagnose & Research
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Drug / Medicines
                    </a>
                  </li>
                </ul> -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Departments
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="">
                      FOREIGN News
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Obidient diaspora
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Gallary
                    </a>
                  </li>
                  <li>
                    <a href="">
                       public opinion
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Contact Us
                    </a>
                  </li>
                </ul>
                <!-- <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="">
                      Cancer Oncology
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Dental Surgery
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Diagnose & Research
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Drug / Medicines
                    </a>
                  </li>
                </ul> -->
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center align-items-lg-baseline">
          <div class="social-box">
            <a href="">
              <img src="images/fb-icon.png" alt="" />
            </a>

            <a href="">
              <img src="images/twitter-icon.png" alt="" />
            </a>
            <a href="">
              <img src="images/linkedin-icon.png" alt="" />
            </a>
            <a href="">
              <img src="images/instagram-icon.png" alt="" />
            </a>
          </div>
          <div class="form_container mt-5">
            <form action="">
              <label for="subscribeMail">
                Newsletter
              </label>
              <input
                type="email"
                placeholder="Enter Your email"
                id="subscribeMail"
              />
              <button type="submit">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        </div>
      </div>
  </div>

  <div class="copyright_section text-center">
      <div class="container">
        <p class="mb-md-0">&copy; <script>document.write(new Date().getFullYear());</script>  <a class="text-primary" href="#">The Obidient News Reporter</a>. All Rights Reserved.</p>
      
      </div>
  </div>

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 
<!-- copyright section end -->
      <!-- Javascript files-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.0.0.min.js"></script>
<script src="assets/js/plugin.js"></script>
<!-- sidebar -->
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/custom.js"></script>
<!-- javascript --> 
<script src="assets/js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script type="text/javascript">
    selectnav('nav', {
        label: '<span class="navbar-toggler-icon">Menu</span>',
        nested: true,
        indent: '*'
    });
    selectnav('f_menu', {
        label: '<span class="navbar-toggler-icon">Menu</span>',
        nested: true,
        indent: '*'
    });
    $('.bxslider').bxSlider({
        mode: 'fade',
        captions: true,
        speed: 200
    });
</script>
</body>
</html>