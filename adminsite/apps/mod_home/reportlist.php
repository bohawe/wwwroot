<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:wght@300;700&display=swap" rel="stylesheet"> 
<link href="/AdminSite/public/css/header.css" rel="stylesheet" type="text/css" />	
<link href='/AdminSite/public/css/jquery.growl.css' rel='stylesheet' type='text/css'>
<script src='/AdminSite/public/js/jquery.growl.js' type='text/javascript'></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
$('.dashboards tr').click(function() {
 $(this).children('td').children('input').prop('checked', true);
  
  $('.dashboards tr').removeClass('selected');
  $(this).toggleClass('selected');

})
});
</script>
<?php

if (isset($vmsg)){if ($vmsg !=''){
	echo '<script type="text/javascript">';
	echo '$.growl.notice({ message: "'.$vmsg.'" });';
	echo '</script>';}}
?>
<div class = "list_content">
<form class="entryform" method="post" id="scupdate">
<div class = "list_table">
<table width="100%">
	<tr class ="nohover">
	<th colspan="8">
	<input class="button_exit" name = "useraction" type="submit" value="Log Out" >
	<input class="button_add" name = "useraction" type="submit" value="Add" >
	<input class="button_edit" name = "useraction" type="submit" value="Edit" >
	<input class="button_refresh" name = "useraction" type="submit" value="Refresh" >
	
	</th>
	</tr>
<tr class ="nohover">
	<th style="display: none;" width="0px"></th>
	<th width="20%">Report Name</th>
	<th width="20%">Business Unit</th><th width="10%">Date Created</th>
	<th width="10%">Enable</th><th width="10%">Passcode</th><th width="10%">Expiry Date</th>
	<th width="10%">Author</th>
</tr>
<tbody class="dashboards">
<?php 
	require_once( getcwd().'/apps/lib/dblayer/datapipe.php');
	$apidata = new datapipe_admin();			
	$ary = json_decode($apidata->getreportlist());	
	$chkcntr = 0;
	
	foreach ($ary as $row){		 
		echo '<tr>';				
		$reportid = '';$sbu='';$reportname='';$datecreated='';$author='';$enable='';$expire='';$passcode='';		
		foreach ($row as $key=>$value){
			if ($key=='enable'){if ($value == 1) {$value = 'Yes';} else {$value = 'No';}}			
			if ($key=='passcode'){if ($value == 1) {$value = 'Yes';} else {$value = 'No';}}			
			if ($key == 'reportid') {$reportid=$value;}
			if ($key == 'sbu') {$sbu=$value;}
			if ($key == 'reportname') {$reportname=$value;}
			if ($key == 'datecreated') {$datecreated=$value;}
			if ($key == 'author') {$author=$value;}
			if ($key == 'enable') {$enable=$value;}
			if ($key == 'expire') {$expire=$value;}				
			if ($key == 'passcode') {$passcode=$value;}		
			
		}
		echo '<td style="display: none;">  <input type="radio" id="r'.$chkcntr.'" name="selectedrow" value="'.$reportid.'"/></td>';
		echo '<td>'.$reportname.'</td>';
		echo '<td>'.$sbu.'</td>';
		echo '<td>'.$datecreated.'</td>';
		echo '<td>'.$enable.'</td>';
		echo '<td>'.$passcode.'</td>';
		echo '<td>'.$expire.'</td>';
		echo '<td>'.$author.'</td>';
		echo '</tr>';
		$chkcntr++;
	}
	 
?>

</table>
</div>
</div>
</form>

