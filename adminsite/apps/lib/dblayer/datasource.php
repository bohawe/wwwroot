<?php
class dbsource
{	
	private $url_controller = null;
    private $url_function = null;
	protected $conn;
	
	function initdb()
	{
		$sqlserver = "tcp:pbitestsqlserver.database.windows.net";
		$UID = "pbitestsqlserver";
		$pwd = "QBrwdZ2RfYvkbq8x";
		$Database= "testdashboard";
		
		$conninfo= array("UID" => $UID, "pwd" => $pwd, "Database" => $Database);	
		$this->conn = sqlsrv_connect($sqlserver,$conninfo);
		if ($this->conn == false)
		{	
			
			return false;
			
		}	
		else{
			return true;
		}	
		
	}
	function dbgetlist()
	{	
		if ($this->initdb())
		{
		$result  = array();
		
		$sql = "select [reportid], [sbu], [reportname],convert(nvarchar(10),cast([datecreated] as date),101) datecreated, [author],[enable],[expire] from reports order by 
				case enable when 1 then 1 else 0 end desc, datecreated desc";
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
	function returnerror($error)
	{	
		
		echo $error;
	}
	function dbcheckid($reportid)
	{			
		if ($this->initdb())
		{
		$response = "";
		$sql = "checkid '".$reportid."'";
		$stmt = sqlsrv_query( $this->conn, $sql );
		

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			$response = $row['reportid'];
			break;
		}
		return $response;	
		}
		else
		{
		return 'dberror';
		}
	}
	
	function dbgetheaders($reportid)
	{	
		if ($this->initdb())
		{
		$this->initdb();		
		$response = "";
		$sql = "getheaders '".$reportid."'";
		$stmt = sqlsrv_query( $this->conn, $sql );
		

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			$response = $row['sbu']."|".$row['reportname']."|".$row['enabled']."|".$row['expired'];
			break;
		}
		return $response;
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
	
    
}

?>