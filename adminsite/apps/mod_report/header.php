<head runat="server">
<title><?php echo $GLOBALS['title'];?></title>
<link rel="shortcut icon" type="image/jpg" href="/public/image/favicon.png"/>
<link href="/public/css/default.css" rel="stylesheet" type="text/css" />	
<link href="/public/css/header.css" rel="stylesheet" type="text/css" />	
</head>
<?php
	$sbu = null;
	$reportname = null;
	$header = null;
	$sbu = $GLOBALS['default_sbu'];
	$reportname = $GLOBALS['default_report'];
	
	require 'apps/lib/dblayer/datalayer.php';
	$db = new datalayer();
	if ($reportid !='')
	{
		if ($db->checkid($reportid)=='exist')
		{
			$header = $db->getheaders($reportid);			
			if ($header=='dberror')
			{
				
			}
			else
			{
				$hdr = explode('|',$header);
				$sbu = $hdr[0];
				$reportname = $hdr[1];
			}
			
			
		}
	}
	
?>
<body oncontextmenu="return false">
<div  class="bodypage">
<div  class="topbar">
<div  class="titlebox">
<div class = "toptitle"><div class ="toptitle_align"><?php echo $sbu;?></div></div>
<div class = "toptitleend"><div class ="toptitle_align"><?php echo $reportname;?></div></div>
</div>
<div class = "menulogo"><img src="/public/image/logoheader.png" >	</div>
</div>





