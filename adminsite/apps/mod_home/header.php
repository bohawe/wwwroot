<head runat="server">
<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:wght@300;700&display=swap" rel="stylesheet"> 
<title><?php echo $GLOBALS['title'];?></title>
<link rel="icon" href="/AdminSite/public/image/favicon.png" type="image/x-icon"/>
<link href="/AdminSite/public/css/default.css" rel="stylesheet" type="text/css" />	
<link href="/AdminSite/public/css/header.css" rel="stylesheet" type="text/css" />	
<script src="/AdminSite/public/js/jquery-2.1.3.min.js"></script>
</head>
<?php
	$sbu = null;
	$reportname = null;
	$sbu = $GLOBALS['default_sbu'];
	$reportname = $GLOBALS['default_report'];	
	//if (strtolower($subaction)=='terms') {$reportname='Terms of Use';}
	//if (strtolower($subaction)=='privacy') {$reportname='Privacy Policy';}
	//if (strtolower($subaction)=='privacy') {$reportname='Privacy Policy';}
	if (isset($_POST['useraction']))
	{
		if ($_POST['useraction']=='Edit' || $_POST['useraction']=='Update')
		{
			$reportname = 'Update Dashboard';
		}
		if ($_POST['useraction']=='Add' || $_POST['useraction']=='Save')
		{
			$reportname = 'Add Dashboard';
		}
	}
?>

<body oncontextmenu="false">
<div  class="topbar">
<div  class="titlebox">
	<div class = "menulogo"><img src="/public/image/header.png" >	</div>
	<div class = "toptitle"><div class ="toptitle_align"><?php echo $sbu;?></div></div>
	<div class = "toptitleend"><div class ="toptitle_align"><?php echo $reportname;?></div></div>
	
</div>

<div class="titlebox_left">
	<div class = "titlebox_left_but"><a class = "button" href="#"><?php echo $_SESSION['userid'];?></a> </div>
</div>

</div>





