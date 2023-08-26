<?php
/**
* 
*/
namespace Libraries\Curl;

class CurlClient implements CurlClientInterface
{
	private $method,
			$url,
			$data,
			$headers = ['Content-type: application/json'],
			$route = 'protocol',
			$errorMessage,
			$build_query = false,
			$_verify_ssl = false,
			$accepted_methods = ['post', 'put', 'patch', 'delete', 'get'];


	public function channel($channel)
	{
		$this->route = $channel;

		return $this;
	}

	public function verify_ssl($status)
	{
		$this->_verify_ssl = $status;

		return $this;
	}

	public function build($status = false)
	{
		$this->build_query = $status;

		return $this;
	}

	public function url($url)
	{
		$this->url = $url;

		return $this;
	}

	public function method($method, $data=null)
	{	
		$this->method 	= $method;
		$this->data 	= $data;

		return $this;
	}

	public function setHeaders($headers=null)
	{
		$headers = array_values($headers);
		
        $this->headers = $headers;

		return $this;
	}

	private function _handleErrors()
	{
		$response['status'] = false;

		if ($this->route == 'url') 
		{
			if (empty($this->url)) 
			{
				$response['status'] = true;
				$response['message'] = 'Url is missing';
			}
		}
		else
		{
			if (empty($this->url)) 
			{
				$response['status'] = true;
				$response['message'] = 'Url is missing';
			}
			elseif(empty($this->method)) 
			{
				$response['status'] = true;
				$response['message'] = 'Method is missing';
			}
			elseif(!in_array($this->method, $this->accepted_methods))
			{
				$response['status'] = true;
				$response['message'] = 'the only methods allowed are '.implode(',', $this->accepted_methods);
			}
			elseif(in_array($this->method, ['post', 'put', 'patch']) && empty($this->data))
			{
				$response['status'] = true;
				$response['message'] = 'Data is missing';
			}
		}

		return $response;
	}

	public function send()
	{
		$error = $this->_handleErrors();

		if ($error['status']) 
		{
			return ['status'=>false, 'message'=>$error['message']];
		}
		else
		{
			return $this->_processRequest();
		}
	}

	private function _processRequest()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);

		if($this->route == 'protocol')
		{
			$post = $this->build_query ? http_build_query($this->data) : $this->data;

			if ($this->method == 'post') 
			{
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_verify_ssl);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			}
			elseif ($this->method == 'get') 
			{
				curl_setopt($ch, CURLOPT_HTTPGET, true);
			}
			elseif (in_array($this->method, ['patch', 'put', 'delete'])) 
			{
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_verify_ssl);
				$method = strtoupper($this->method);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, ''.$method.'');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			}

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		}
		elseif($this->route == 'url')
		{
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		}

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

	public function headerDetails()
	{
		 return $this->_get_header_feedback();
	}

	private function _get_header_feedback()
	{
		$data = $this->build_query ? http_build_query($this->data) : $this->data;

		if ($this->method == 'get') 
		{
			$context_options = [
				'http' => [
					'method' => ''.strtoupper($this->method).'',
					'header'=> $this->headers
				]
			];
		}
		elseif (in_array($this->method, ['post', 'put', 'patch', 'delete'])) 
		{
			$context_options = [
				'http' => [
					'method' => ''.strtoupper($this->method).'',
					'header'=> $this->headers,
					'content' => $data
				]
			];
		}

		$context = stream_context_set_default($context_options);
		return get_headers($this->url,1);
	}

	public function responseStatus()
	{
		return $this->headerDetails()[0];
	}
}