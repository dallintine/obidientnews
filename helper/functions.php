<?php
function sanitize($string)
{
	return stripcslashes(htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8'));
}


function debug($data)
{	
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
	exit;
}