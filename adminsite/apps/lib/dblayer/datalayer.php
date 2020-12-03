<?php
require $_SERVER['DOCUMENT_ROOT'].'/apps/lib/dblayer/datasource.php';
class datalayer 
{	
	function getlist()
	{
		$db = new dbsource();
		return $db->dbgetlist();
	}
	function checkid($reportid)
	{
		$db = new dbsource();
		return $db->dbcheckid($reportid);
	}
	function getheaders($reportid)
    {	
		$db = new dbsource();
		return $db->dbgetheaders($reportid);
	}
	function getreporturl($reportid)
    {	
		$db = new dbsource();
		return $db->getreporturl($reportid);
	}
}