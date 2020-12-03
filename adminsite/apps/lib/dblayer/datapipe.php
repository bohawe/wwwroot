<?php
class datapipe_admin
{
	private $restapi = "https://www.thedashboardaspire.com/AdminSite/restapi/api.php?data=";
		function validateuser($userid)
	{		
		$api = $this->restapi.'validateuser';		
		$myvars = 'userid='.$userid;
		
		$ch = curl_init( $api );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
		return $response;
		
	}
	function checkurl($reporturl,$reportid)
	{		
		$api = $this->restapi.'checkurl';		
		$myvars = 'url='.$reporturl.'&reportid='.$reportid;
		
		$ch = curl_init( $api );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
		return $response;
		
	}	
	function newreport($sbu,$reportname,$author,$enable,$expire,$passcode,$reporturl,$reqref,$mail)
	{		
		$api = $this->restapi.'newreport';		
		$myvars = 'sbu='.$sbu.'&reportname='.$reportname.'&author='.$author.'&enable='.$enable.'&expire='.$expire.'&passcode='.$passcode.'&reporturl='.$reporturl.'&reqref='.$reqref.'&mail='.$mail;
		
		$ch = curl_init( $api );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
	}	
	function updatereport($reportid,$sbu,$reportname,$author,$enable,$expire,$passcode,$reporturl,$reqref,$mail)
	{		
		$api = $this->restapi.'updatereport';		
		$myvars = 'reportid='.$reportid.'&sbu='.$sbu.'&reportname='.$reportname.'&author='.$author.'&enable='.$enable.'&expire='.$expire.'&passcode='.$passcode.'&reporturl='.$reporturl.'&reqref='.$reqref.'&mail='.$mail;
		//echo $myvars;
		//,$datecreated,$author,$enable,$expire,$passcode,$reporturl = '';$reqref = '';$mail
		$ch = curl_init( $api );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
	}
	function getreportlist()
    {			
		$api = $this->restapi.'getreportlist';	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}
	
	function getreportdetail($recordid)
    {		
	
		$api = $this->restapi.'getreportdetail/'.$recordid;	
		$client = curl_init($api);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);						
		return $response;		
	}		
}