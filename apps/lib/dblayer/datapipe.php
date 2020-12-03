<?php
class datapipe
{
	private $restapi = "https://www.thedashboardaspire.com/restapi/api.php?data=";
	function validatepasscode($email,$reportid,$passcode)
    {			
		$api = $this->restapi.'validatepasscode/'.$email.'/'.$reportid.'/'.$passcode;	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}	
	function getpasscode($email,$reportid)
    {			
		$api = $this->restapi.'getpasscode/'.$email.'/'.$reportid;	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}
	function getiddetails($reportid)
    {		
	
		$api = $this->restapi.'getiddetail/'.$reportid;	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}
	function getreporturl($reportid)
    {		
	
		$api = $this->restapi.'getreporturl/'.$reportid;	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}	
}