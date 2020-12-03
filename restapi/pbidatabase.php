<?php

class pbidata
{
	protected $conn;
	private $url_controller = null;
    private $url_parameter_0 = null;
    private $url_parameter_1 = null;
    private $url_parameter_2 = null;
    private $url_parameter_3 = null;
	private $url_parameter_4 = null;
	private $url_parameter_5 = null;
	private $url_parameter_6 = null;
	private $url_parameter_7 = null;
	private $url_parameter_8 = null;
	private $url_parameter_9 = null;
	private $url_parameter_10 = null;	
	private $com = "azfsqlbohawe";
	public function __construct()
    {				
		$this->splitUrl();		
		if (strtolower($this->url_controller)==strtolower('getiddetail'))
		{							
				echo ( $this->getiddetail($this->url_parameter_0));
			
		}		
		if (strtolower($this->url_controller)==strtolower('getreporturl'))
		{							
				echo ( $this->getreporturl($this->url_parameter_0));
			
		}	
		if (strtolower($this->url_controller)==strtolower('getpasscode'))
		{							
				echo ( $this->getpasscode($this->url_parameter_0,$this->url_parameter_1));
			
		}			
		if (strtolower($this->url_controller)==strtolower('validatepasscode'))
		{							
				echo ( $this->validatepasscode($this->url_parameter_0,$this->url_parameter_1,$this->url_parameter_2));
			
		}			
	}	
	function validatepasscode($email,$reportid,$passcode)
	{	
	if ($this->initdb())
		{
		$retval = '';
		$sql = "select case when DATEDIFF(hour,expires,getdate()) < 0 then 'valid' else 'expire' end [expire] from emails where reportid ='".$reportid."' and emailadd = '".$email."' and passcode ='".$passcode."'";
		error_log($sql);
		$stmt = sqlsrv_query( $this->conn, $sql );
		if( $stmt === false) {
			$retval = "";
		}
		else
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$retval = $row['expire'];				
				break;
			}
		}		
		if ($retval=='')
		{
			$retval='invalidpasscode';
		}
		return $retval;
				}
		else
		{
		return 'dberror';
		}

	}	
	function getpasscode($email,$reportid)
	{	
	if ($this->initdb())
		{
		$retval = '';
		$sql = "select emailadd from emails where reportid ='".$reportid."' and emailadd = '".$email."'";
		
		$stmt = sqlsrv_query( $this->conn, $sql );
		if( $stmt === false) {
			$retval = "";
		}
		else
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$retval = $row['emailadd'];				
				break;
			}
		}
		if ($retval!='')
		{
			$newpasscode = $this->genpasscode();
			$sql = "update emails set passcode = '".$newpasscode."',expires=getdate()+1 where reportid ='".$reportid."' and emailadd = '".$email."'";
			$stmt = sqlsrv_query( $this->conn, $sql );
			$this->sendmail($email,$newpasscode);
		}
		return $retval;
				}
		else
		{
		return 'dberror';
		}

	}	
	function sendmail($emailadd,$passcode)
	{
				
		$body= '<html>
		<head runat="server">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:wght@300;700&display=swap" rel="stylesheet"> 
		<style>
		body {
		  font-family: "Roboto Condensed", sans-serif;
		  font-size:1.50em;
		}
		.pcode
		{
			font-family: "Roboto Condensed", sans-serif;
			font-size:1.90em;
			font-weight: bold;
		}
		</style>
		</head>
		<body><p>Dear '.$emailadd.',</p><p>This is your passcode to access Aspire Zone Dashboard and valid for 24 hours.</p><div class="pcode">'.$passcode.'</div></body></html>';

		require_once __DIR__ .'\mailer\PHPMailer.php';
		require_once __DIR__ .'\mailer\smtp.php';
		require_once __DIR__ .'\mailer\exception.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		 
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true;
		 
		$mail->Host = "smtp.office365.com"; 		
		$mail->Port = 587 ;
		$mail->SMTPSecure = "tls";
		 //$mail->SMTPSecure = 'tls'; // if Port is 587 
		$mail->Username = "passcode@aspirezone.qa"; 
		$mail->Password = "Aspire@123"; 
		 
		

		$mail->IsHTML(true); 
		$mail->AddAddress("allrock.antonio@gmail.com");
		
		$mail->SetFrom("passcode@aspirezone.qa");
		$mail->Subject = "Aspire Zone Passcode";
		$mail->Body    = $body;		
		 
		try
		{
			$mail->Send();
			
		} 
		catch(Exception $exception)
		{   			
			error_log($mail->ErrorInfo);
		}
	}
	function genpasscode()
	{
		$length = 6;
		$add_dashes = false;
		$available_sets = 'd';
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '1234567890';
		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';

		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}

		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];

		$password = str_shuffle($password);

		if(!$add_dashes)
			return $password;

		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
	}
	function getreporturl($reportid)
	{	
	if ($this->initdb())
		{
		$retval = '';
		$sql = "geturl '".$reportid."'";
		$stmt = sqlsrv_query( $this->conn, $sql );
		if( $stmt === false) {
			$retval = "";
		}
		else
		{
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$retval = $row['reporturl'];
				if ($row['enabled'] == 'no') {$retval = '';}
				if ($row['expired'] == 'yes') {$retval = '';}
				break;
			}
		}
		return $retval;
				}
		else
		{
		return 'dberror';
		}

	}	
	function getiddetail($reportid)
	{	
		if ($this->initdb())
		{
			$response = "";
			$sql = "getiddetails '".$reportid."'";
			$stmt = sqlsrv_query( $this->conn, $sql );
			

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$response = $row['sbu']."|".$row['reportname']."|".$row['enabled']."|".$row['expired']."|".$row['pwd'];
				break;
			}
			if ($response=="")
			{
				return "notexist";
			} else {return $response;}			
		}
		else
		{		
			return 'dberror';
		}				
	}
	function initdb()
	{
		$sqlserver = "tcp:pbitestsqlserver.database.windows.net";
		$UID = "pbitestsqlserver";
		$pwd = "QBrwdZ2RfYvkbq8x";
		$Database= "testdashboard";
		
		$conninfo= array("UID" => $UID, "pwd" => $pwd, "Database" => $Database);	
		$this->conn = sqlsrv_connect($sqlserver,$conninfo);
		if ($this->conn == false){return false;}else{return true;}			
	}
	
	function ViewComments($RecordID,$Internal)
	{	
		$api = new COM($this->com.".ServiceCatalog");
		
		$retval =  $api->ViewComments($RecordID,$Internal);
		$retval = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $retval);		
		echo $retval;
	}
	function CreateComment($RecordID,$ByUser,$Comment,$Internal)
	{	
		$api = new COM($this->com.".ServiceCatalog");
		
		$retval =  $api->CreateComment($RecordID,$ByUser,$Comment,$Internal);
		$retval = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $retval);		
		echo $retval;
	}
	
	private function splitUrl()
    {
        if (isset($_GET['data'])) {

            $url = rtrim($_GET['data'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_parameter_0 = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
			$this->url_parameter_4 = (isset($url[5]) ? $url[5] : null);
			$this->url_parameter_5 = (isset($url[6]) ? $url[6] : null);
			$this->url_parameter_6 = (isset($url[7]) ? $url[7] : null);
			$this->url_parameter_7 = (isset($url[8]) ? $url[8] : null);
			$this->url_parameter_8 = (isset($url[9]) ? $url[9] : null);
			$this->url_parameter_9 = (isset($url[10]) ? $url[10] : null);
			$this->url_parameter_10 = (isset($url[11]) ? $url[11] : null);
			$this->url_parameter_11 = (isset($url[12]) ? $url[12] : null);

            // for debugging. uncomment this if you have problems with the URL
			/*
             echo 'Controller: ' . $this->url_controller . '<br />';
             echo 'Parameter 0: ' . $this->url_parameter_0 . '<br />';
             echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
             echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
             echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
			*/
			
			
        }
    }
}
?>