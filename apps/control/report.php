<?php
require 'apps/mod_report/pagecontent.php';

class report extends page_parts 
{    
    public function index($reportid)
    {		
		$sbu = null;
		$reportname = null;
		$pageimg='header.png';
		$pagemsg = null;
		$public = null;
		$expired = null;
		$protected = null;
		$bg = 'topbar_azf';
		require_once('apps/lib/dblayer/datapipe.php');
		$apidata = new datapipe();			
		$header = $apidata->getiddetails($reportid);			
		if ($header=='notexist' || $header=='dberror')
		{
			$sbu = $GLOBALS['default_sbu'];
			$reportname = 'Report identifier not found';
			$pageimg = 'header.png';
			$pagemsg = $header;
			if ($header=='dberror')
			{
				$reportname = 'Internal Error';
			}
		}
		else
		{
			if ($header!='dberror')
			{
			$hdr = explode('|',$header);
			$sbu = $hdr[0];
			$reportname = $hdr[1];			
			$public = $hdr[2];
			$expired = $hdr[3];
			$protected = $hdr[4];
			if ($sbu=='Aspetar')
			{
				$bg = 'topbar_aspetar';
				$pageimg = 'aspetar.png';
			}
			}
		}
		
		$this->pg_header($sbu,$reportname,$pageimg,$bg, $protected);				
		
		
		$this->pg_body($reportid,$pagemsg,$public,$expired,$reportname,$protected);
		$this->pg_end();		
    }
}
