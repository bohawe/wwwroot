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
		if (strtolower($this->url_controller)==strtolower('getreportlist'))
		{							
				echo ( $this->getreportlist());			
		}		
		if (strtolower($this->url_controller)==strtolower('getreportdetail'))
		{							
				echo ( $this->getreportdetail($this->url_parameter_0));			
		}			
		if (strtolower($this->url_controller)==strtolower('updatereport'))
		{							
				echo ( $this->updatereport());			
		}			
		if (strtolower($this->url_controller)==strtolower('newreport'))
		{							
				echo ( $this->newreport());			
		}			
		if (strtolower($this->url_controller)==strtolower('checkurl'))
		{							
				echo ( $this->checkurl());			
		}			
		if (strtolower($this->url_controller)==strtolower('validateuser'))
		{							
				echo ( $this->validateuser($this->url_parameter_0));			
		}			
	}
	function validateuser()
	{	
		$userid = '';
		if (isset($_POST['userid'])){$userid = $_POST['userid'];}
		
		if ($this->initdb())
		{
		$result=array();		
		$sql = "select username  from adminsite_users where  LOWER(username) = LOWER ('".$userid."')";
		
		$stmt = sqlsrv_query( $this->conn, $sql );
		$cnt = 0;
		do {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
			   array_push($result,$row);
			   $cnt++;
			}
		} while (sqlsrv_next_result($stmt));
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($this->conn );
		
		if ($cnt == 0)
		{	
			return 'notexist';}
		else {return 'exist';}
		}
		else
		{
		return 'dberror';
		}
		
	}
	
	
	
	function checkurl()
	{	
		$reportid = '';$url='';
		if (isset($_POST['reportid'])){$reportid = $_POST['reportid'];}
		if (isset($_POST['url'])){$url = $_POST['url'];}
		if ($this->initdb())
		{
		$result=array();		
		$sql = "select reportid from reports where reporturl ='".$url."'";
		if ($reportid!='')
		{
			$sql = $sql." and reportid <> '".$reportid."'";
		}
		error_log($sql);
		$stmt = sqlsrv_query( $this->conn, $sql );
		$cnt = 0;
		do {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
			   array_push($result,$row);
			   $cnt++;
			}
		} while (sqlsrv_next_result($stmt));
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($this->conn );
		
		if ($cnt == 0)
		{	
		return 'notexist';}
		else {return 'exist';}
		}
		else
		{
		return 'dberror';
		}
		
	}
	function newreport()
	{		
		$reportid = '';$sbu='';$reportname='';$author='';$enable='';$expire='';$passcode='';		
		$reporturl = '';$reqref = '';$mail='';$sbu='';		
		if (isset($_POST['reportname'])){$reportname = $_POST['reportname'];}
		if (isset($_POST['author'])){$author = $_POST['author'];}
		if (isset($_POST['enable'])){$enable = $_POST['enable'];}
		if (isset($_POST['expire'])){$expire = $_POST['expire'];}
		if (isset($_POST['passcode'])){$passcode = $_POST['passcode'];}
		if (isset($_POST['reporturl'])){$reporturl = $_POST['reporturl'];}
		if (isset($_POST['reqref'])){$reqref = $_POST['reqref'];}
		if (isset($_POST['sbu'])){$sbu = $_POST['sbu'];}
		if ($enable == '') {$enable = '0';}else{$enable='1';}
		if ($passcode == '') {$passcode = '0';}else{$passcode='1';}
		if (isset($_POST['mail'])){$mail = $_POST['mail'];}	
		if ($expire==''){$expire='NULL';} else {$expire = "'".$expire."'";}
		$sql = "insert into reports([sbu], [reportname], [reporturl], [enable], [datecreated], [expire], [author], [reqref], [passcode]) ".
		"values('".str_replace("'","''",$sbu)."',".
		"'".str_replace("'","''",$reportname)."',".
		"'".str_replace("'","''",$reporturl)."',".
		$enable.",".
		"getdate(),".
		$expire.",".
		"'".str_replace("'","''",$author)."',".
		"'".str_replace("'","''",$reqref)."',".
		$passcode.")";
		
		
		if ($this->initdb())
		{
			
			$stmt = sqlsrv_query( $this->conn, $sql );
					
			$mails = explode(";",$mail);	
			foreach ($mails as $mail)
			{					
				if ($mail!='')
				{
					
					$sql = "insert into emails(  [reportid], [emailadd], [passcode], [expires]) ".
					"select (select reportid from reports where id  = (select max(id) from reports)),'".$mail."','',NULL";															
					sqlsrv_query( $this->conn, $sql );					
				}
			}			
		}
		
	}
	function updatereport()
	{		
		$reportid = '';$sbu='';$reportname='';$author='';$enable='';$expire='';$passcode='';		
		$reporturl = '';$reqref = '';$mail='';$sbu='';
		if (isset($_POST['reportid'])){$reportid = $_POST['reportid'];}
		if (isset($_POST['reportname'])){$reportname = $_POST['reportname'];}
		if (isset($_POST['author'])){$author = $_POST['author'];}
		if (isset($_POST['enable'])){$enable = $_POST['enable'];}
		if (isset($_POST['expire'])){$expire = $_POST['expire'];}
		if (isset($_POST['passcode'])){$passcode = $_POST['passcode'];}
		if (isset($_POST['reporturl'])){$reporturl = $_POST['reporturl'];}
		if (isset($_POST['reqref'])){$reqref = $_POST['reqref'];}
		if (isset($_POST['sbu'])){$sbu = $_POST['sbu'];}
		if ($enable == '') {$enable = '0';}else{$enable='1';}
		if ($passcode == '') {$passcode = '0';}else{$passcode='1';}
		if (isset($_POST['mail'])){$mail = $_POST['mail'];}	
		if ($expire==''){$expire='NULL';} else {$expire = "'".$expire."'";}
		$sql = "update reports set reportname = '".str_replace("'","''",$reportname)."' ,
					sbu = '".str_replace("'","''",$sbu)."' ,
					author = '".str_replace("'","''",$author)."' ,
					reporturl = '".str_replace("'","''",$reporturl)."' ,
					reqref = '".str_replace("'","''",$reqref)."' ,
					expire = ".$expire." ,
					enable = ".$enable." ,
					passcode = ".$passcode." 
					where reportid = '".$reportid."'";
		if ($this->initdb())
		{
			
			$stmt = sqlsrv_query( $this->conn, $sql );
			
			$sql = "delete from emails where reportid = '".$reportid."'";
			sqlsrv_query( $this->conn, $sql );
			
			$mails = explode(";",$mail);	
			foreach ($mails as $mail)
			{					
				if ($mail!='')
				{
					
					$sql = "insert into emails(  [reportid], [emailadd], [passcode], [expires]) ".
					"values('".$reportid."','".$mail."','',NULL)";					
					error_log($sql);
					sqlsrv_query( $this->conn, $sql );					
				}
			}
			
			
			
		}
		
	}
	function genpasscode()
	{
		$length = 6;
		$add_dashes = false;
		$available_sets = 'ud';
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '123456789';
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
	function getreportdetail($reportid)
	{	
		
		if ($this->initdb())
		{
		$result  = array();
		
		$sql = "select [reportid], [sbu], [reportname]
,convert(nvarchar(12),[datecreated],103)  [datecreated]
,[author],[enable]
,case isnull([expire],'') when '' then '' else 
replace(convert(nvarchar(12),[expire],111),'/','-') end [expire]
,case isnull(passcode,0) when 1 then 1 else 0 end passcode,reporturl,reqref,dbo.getemails('".$reportid."') [mail]
from reports where reportid = '".$reportid."' ";
		$stmt = sqlsrv_query( $this->conn, $sql );
		
		do {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
			   array_push($result,$row);
			}
		} while (sqlsrv_next_result($stmt));
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($this->conn );
		
		return json_encode($result);
				}
		else
		{
		return 'dberror';
		}
		
	}	
	function getreportlist()
	{	
		if ($this->initdb())
		{
		$result  = array();
		
		$sql = "select [reportid], [sbu], [reportname]
,datename(month,[datecreated]) + ' '+ datename(day,[datecreated])+ ', '+ datename(year,[datecreated])  as [datecreated]
,[author],[enable]
,case isnull([expire],'') when '' then 'No' else convert(nvarchar(12),[expire],103) end [expire]
,case isnull(passcode,0) when 1 then 1 else 0 end passcode
from reports order by 
id desc";
		$stmt = sqlsrv_query( $this->conn, $sql );
		
		do {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
			   array_push($result,$row);
			}
		} while (sqlsrv_next_result($stmt));
		sqlsrv_free_stmt($stmt);
		sqlsrv_close($this->conn );
		
		return json_encode($result);
				}
		else
		{
		return 'dberror';
		}
		
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