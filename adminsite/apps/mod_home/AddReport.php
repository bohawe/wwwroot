<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Condensed:wght@300;700&display=swap" rel="stylesheet"> 
<link href="/Adminsite/public/css/header.css" rel="stylesheet" type="text/css" />	
<link href='/Adminsite/public/css/jquery.growl.css' rel='stylesheet' type='text/css'>
<script src='/Adminsite/public/js/jquery.growl.js' type='text/javascript'></script>
<script type="text/javascript">
function msgMe(msg)
{
 $.growl.notice({ message: msg });
 }
</script>
<?php
//print_r($_POST);
?>
	
<div class = "list_content">
<form class="entryform" method="post" id="scupdate">
<div class = "list_table">
<table width="100%">
	<tr class ="nohover">
	<th colspan="2">
	<input class="button_left" name = "useraction" type="submit" value="Back" >		
	<input class="button_save" name = "useraction" type="submit" value="Save" >
	
	</th>
	</tr>

<?php
	if ($vmsg != '')
	{
		$imsg = explode("|", $vmsg);
		foreach ($imsg as $imsg)
		{
			if ($imsg!='')
			{
			echo '<script type="text/javascript">';
			echo '$.growl.warning({ message: "'.$imsg.'" });';
			echo '</script>';
			}
			
		}			
	}
	$reportid = '';$sbu='';$reportname='';$datecreated='';$author='';$enable='';$expire='';$passcode='';		
	$reporturl = '';$reqref = '';$mail='';$sbu='';

	
	if (isset($_POST['reportname'])){$reportname = $_POST['reportname'];}
	if (isset($_POST['author'])){$author = $_POST['author'];}
	if (isset($_POST['enable'])){$enable = $_POST['enable'];}
	if (isset($_POST['sbu'])){$sbu = $_POST['sbu'];}
	if (isset($_POST['expire'])){$expire = $_POST['expire'];}
	if (isset($_POST['passcode'])){$passcode = $_POST['passcode'];}
	if (isset($_POST['reporturl'])){$reporturl = $_POST['reporturl'];}
	if (isset($_POST['reqref'])){$reqref = $_POST['reqref'];}
	if (isset($_POST['mail'])){$mail = $_POST['mail'];}


	if ($enable=='on'){$enable = 'Yes';}
	if ($passcode=='on'){$passcode = 'Yes';}	
	$msg = '<b>Report Title</b><br/><br/>Title to be displayed on the published report.';
	echo '<tr class ="nohover">';
	echo '<td width="10%">Report Title&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  maxlength="100" style="width:50%" type="text" name="reportname" value="'.$reportname.'"></td>';
	echo '</tr>';
	$msg = '<b>Business Unit</b><br/><br/>Business Unit of requesting party.';
	echo '<tr class ="nohover">';
	echo '<td width="10%">Business Unit&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%">
			<select maxlength="100" style="width:250px" class="selectstyle" name="sbu" id ="sbu" style="width:100px;" >
			<option value="Aspire Zone"';
			if ($sbu =="Aspire Zone") { echo ' selected ';}
			echo '>Aspire Zone</option>
			<option value="President\'s Office"';
			if ($sbu =="President's Office") { echo ' selected ';}
			echo'>President\'s Office</option>					
			<option value="Aspetar"';
			if ($sbu =="Aspetar") { echo ' selected ';}
			echo'>Aspetar</option>					
			<option value="Academy"';
			if ($sbu =="Academy") { echo ' selected ';}
			echo'>Academy</option>					
			</select>
			</td>';
	echo '<tr>';
		$msg = '<b>Author</b><br/><br/>A person or department who created the report to be publish.';
	echo '<tr class ="nohover">';
	echo '<td width="10%">Author&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  maxlength="200" style="width:50%" type="text" i name="author" value="'.$author.'"></td>';
	echo '</tr>';
	echo '<tr class ="nohover">';
	$msg = '<b>Request Description</b><br/><br/>Should contain detail of the request.';
	echo '<td width="10%">Request Description&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  maxlength="200" style="width:70%" type="text" i name="reqref" value="'.$reqref.'"></td>';
	echo '</tr>';	
	$msg = '<b>Enable</b><br/><br/>Block access to the report for viewing not checked';
	echo '<tr class ="nohover">';
	echo '<td width="10%">Enable&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	if ($enable == 'Yes')
	{
		echo '<td  width="90%"><input type="checkbox" id="c1" name="enable" checked/><label for="c1" ><span></span></label></td>';
	}
	else
	{
		echo '<td  width="90%"><input type="checkbox" id="c1" name="enable" /><label for="c1"><span></span></label></td>';
	}
	echo '</tr>';	
	$msg = '<b>Expiry Date</b><br/><br/>Set the date when the report will no longer available, expiry date can be extended by editing the date to future.<br/><br/><sup>Note<br/>Leave it blank if report has no expiration.</sup>';
	echo '<tr class ="nohover">';
	echo '<td width="10%">Expiry Date&nbsp;&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  maxlength="12" style="width:120px" type="date" name="expire" value="'.$expire.'"></td>';
	echo '</tr>';
	echo '</tr>';	
	$msg = '<b>Report URL</b><br/><br/>This is the Power BI report URL to be provided by Sys Admins.<br/><br/><sup>Note<br/>Do not share this URL to anyone.</sup>';
	echo '<tr>';		
	echo '<tr class ="nohover">';
	echo '<td width="10%">Report URL&nbsp;&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  style="width:70%" type="text"  name="reporturl" value="'.$reporturl.'">';
	
				

	echo '</td>';
	echo '</tr>';
	
	$msg = '<b>Require Passcode</b><br/><br/>If report require security protection enable this feature, passcode will be sent to associated email address when report is accessed.';
	echo '<tr class ="nohover">';	
	
	echo '<td width="10%">Require Passcode&nbsp;&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	if ($passcode == 'Yes')
	{	
		echo '<td  width="90%"><input type="checkbox" id="c2" name="passcode" checked /><label for="c2"><span></span></label></td>';
	}
	else
	{
		echo '<td  width="90%"><input type="checkbox" id="c2" name="passcode" /><label for="c2"><span></span></label></td>';
	}
	echo '</tr>';		
	$msg = '<b>Associated Mail</b><br/><br/>Only required if Require Passcode is enabled, email address will recieve passcode when report is accessed.';
	echo '<tr class ="nohover">';	
	echo '<td width="10%">Associated Mail&nbsp;<a href="#" onclick="msgMe(\''.$msg.'\');" ><img alt="Qries" src="/adminsite/public/image/tooltip.png" ></a></td>';
	echo '<td  width="90%"><input  style="width:70%" type="text" name="mail" value="'.$mail.'"> 
			
			</td>';
	echo '</tr>';			
	
	
?>
	
</table>
</div>
</div>
</form>

