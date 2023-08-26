<?php

function post($url, $data, $headers = ['Content-type: application/json'])
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$post = http_build_query($data);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	return  _result($ch);
}

function get($url, $headers = ['Content-type: application/json'])
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	return  _result($ch);
}

function direct($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return  _result($ch);
	
}

function _result($ch)
{
	$result = curl_exec($ch);
	$error = curl_error($ch);
	curl_close($ch);

	if ($error) 
	{
		$response['status'] = false;
		$response['message'] = "cURL Error #:" . $error;
	} 
	else 
	{
	  	$result = explode("\r\n\r\n", $result);

	  	while (count($result) > 2) 
	  	{
	  		array_shift($result);
	  	}

	  	 @list($headers, $body) = $result;

	  	 $response['status'] = true;
	  	 $response['data'] = $result;
	}

	return $response;
}