<head runat="server">
<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:wght@300;700&display=swap" rel="stylesheet"> 
<title><?php echo $GLOBALS['title'];?></title>
<link rel="icon" href="/public/image/favicon.png" type="image/x-icon"/>
<link href="/public/css/default.css" rel="stylesheet" type="text/css" />	
<link href="/public/css/header.css" rel="stylesheet" type="text/css" />
<script src="/public/js/jquery-2.1.3.min.js"></script>
<link href='/public/css/jquery.growl.css' rel='stylesheet' type='text/css'>
<script src='/public/js/jquery.growl.js' type='text/javascript'></script>	
</head>

<body oncontextmenu="return false">
<?php
$link = 'https://aspirezone.qa/index.aspx?lang=en';
if ($pageimg=='aspetar.png') {$link = 'https://www.aspetar.com/index.aspx?lang=en';}
echo '<div  class="'.$bg,'">';
?>
<div  class="titlebox">	
	<div class = "menulogo">
	<a target="_blank" rel="noopener noreferrer" href="<?php echo $link; ?>">
	<img src="/public/image/<?php echo $pageimg; ?>" ></a></div>
	<div class = "toptitle"><div class ="toptitle_align"><?php echo $sbu;?></div></div>
	<div class = "toptitleend"><div class ="toptitle_align"><?php echo $reportname;?></div></div>	
</div>
<div class="titlebox_left">
	<div class = "titlebox_left_but"><a class = "button" href="/?apps=home/terms">Terms of Use</a> </div>
	<div class = "titlebox_left_but"><a class = "button" href="/?apps=home/privacy">Privacy Policy</a> </div>
</div>
</div>






