<?php
require_once 'helper/autoload.php';
// require_once 'helper/user.php';

$error = true;


function profile($value)
{
	
	{
		$output1 = "";
		$email = $_SESSION['email'];
		$sn = 0;
		$result = getAll("*", 'script_news');
		while ($value = mysqli_fetch_array($result))
		// foreach ($result as $key => $value)
		{

			$sn+=1;
			$fileimage = ($value['fileimage']);
			$topic = ($value['topic']);
			$date_publish = ($value['date_publish']);
			$News_area = ($value['News_area']);
		

			$output1 .= '<div class="col-lg-6"><div class="media"><div class="media-left">
						<img src="contentimage/'.$fileimage.'"class="media-object" style="width:70px">
					</div>
					<div class="media-body">
						<h4 class="media-heading" style="font-weight:bold; color:#800080;">'.$topic.'</h4>
						<small class="media-heading" size = 4px; style="color:#000080;">'.$date_publish.'</small>
						<p>'.substr($News_area, 0, 200).'...</p> <button class="btn btn-default btn-sm"><a href="">Read More &raquo;</a></button>
					</div>
				</div></div>';
		}
	}
	return $output1;
}

function profile1($value)
{
	$output2 = "";
	$email = $_SESSION['email'];
	$sn = 0;
	// $result = getAll('*', 'video_file', "email='$email'");
	$result = getAll('*', 'video_file');
	while ($value = mysqli_fetch_array($result)) 
	{
			$sn+=1;
			$video_name = ($value['video_name']);
			$video_newfile = ($value['Video_newfile']);


			$output2 .='<div class="col-xs-4 col-sm-4 col-md-4" style=" height:auto;">
			<video width="300" height="300" controls src="filevideo/'.$video_newfile.'" type="video/mp4" >
			</video>
			
			<div><h3>'.$video_name.'</h3></div></div>';

			
	}

	return $output2;
}

function price1($value)
{
	//$email = $_SESSION['email'];
	$result = getAll('spricebtc', 'users', "email='admin@betaexchangeng.com'");
	while ($row = mysqli_fetch_array($result)) 
	{
		$spricebtc = $row['spricebtc'];
		
		
	}

	return $$value;
}
function price2($value)
{
	//$email = $_SESSION['email'];
	$result = getAll('bpricebtc', 'users',"email='admin@betaexchangeng.com'");
	while ($row = mysqli_fetch_array($result)) 
	{
		$bpricebtc = $row['bpricebtc'];
		
		
	}

	return $$value;
}

function price3($value)
{
	//$email = $_SESSION['email'];
	$result = getAll('bpricepm', 'users',"email='admin@betaexchangeng.com'");
	while ($row = mysqli_fetch_array($result)) 
	{
		$bpricepm = $row['bpricepm'];
		
		
	}

	return $$value;
}

function price4($value)
{
	//$email = $_SESSION['email'];
	$result = getAll('spricepm', 'users',"email='admin@betaexchangeng.com'");
	while ($row = mysqli_fetch_array($result)) 
	{
		$spricepm = $row['spricepm'];
		
		
	}

	return $$value;
}


function datetime_to_word($datetime=""){
	// date_default_timezone_set();
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);

}