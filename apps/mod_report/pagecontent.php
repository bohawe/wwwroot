<link href='/public/css/jquery.growl.css' rel='stylesheet' type='text/css'>
<script src='/public/js/jquery.growl.js' type='text/javascript'></script>
<link href="/public/css/default.css" rel="stylesheet" type="text/css" />	
<link href="/public/css/header.css" rel="stylesheet" type="text/css" />	
<script type="text/javascript">
function msgMe(msg)
{
 $.growl.notice({ message: msg });
 }
</script>
<?php
class page_parts
{
	
	function pg_header($sbu,$reportname,$pageimg,$bg,$protected) 
	{
		
		$pg_path = 'apps/mod_report/header.php';						
		require_once($pg_path);				
	}		
	
	function pg_body($reportid,$pagemsg,$public,$expired,$reportname,$protected) 
	{
		$email ='';
		$passcode ='';
		
		require_once('apps/lib/dblayer/datapipe.php');
		$apidata = new datapipe();			
		echo '<div class = "bodycontent">';
						
		require 'apps/lib/message.php';	
		$msg = new message();
		$allowed = 'yes';
		if ($pagemsg=='dberror')
		{
			$msg->reportdberror();			
		}
		if ($pagemsg!='dberror')
		{
			
		if ($pagemsg=='notexist')
		{
			$msg->reportinvalid($reportid);			
		}
		else
		{
			$allowed = 'yes';					
			if ($public=='no')
			{
				$allowed = 'no';
				$msg->reportprivate($reportname);
			}
			else
			{
				if ($expired == 'yes')
				{
					$allowed = 'no';
					$msg->reportexpired($reportname);
				}
			}
			
			if ($allowed == 'yes')				
			{				
				if ($protected=='no')
				{
				?>
				<script>var reportid = "<?php echo $reportid;?>";</script>
				<script src="/public/js/jquery-3.1.0.min.js"></script>
				<script type="text/javascript" src="/public/js/jquery_aspire.js" ></script>
				<div class ="bodycontent">
				<div id="panel"></div></div>
				<?php
				}
				else
				{
					$isok='invalid';
					$contok=true;
					if (isset($_POST['useraction']))
					{
					$email=$_POST['email'];
					$passcode=$_POST['passcode'];
					if (isset($_POST['email']))
					{
						if ($_POST['email']==''){
						echo '<script type="text/javascript">';
						echo '$.growl.notice({ message: "Email address is required" });';
						echo '</script>';$contok=false;
						}	
					}
					if ($_POST['useraction']=='Continue')
					{
						if ($_POST['passcode']==''){
							echo '<script type="text/javascript">';
							echo '$.growl.notice({ message: "Passcode is required" });';
							echo '</script>';		$contok=false;					
						}
					}
					
					if ($_POST['email']!=''){
						if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						echo '<script type="text/javascript">';
						echo '$.growl.notice({ message: "Email address is invalid format" });';
						echo '</script>';	$contok=false;												
						}
						else
						{
							if ($_POST['useraction']=='Send Passcode'){
							
							$chkemail=$apidata->getpasscode($_POST['email'],$reportid);
							if ($chkemail=='')
							{
								echo '<script type="text/javascript">';
								echo '$.growl.warning({ message: "Email address is not associated with the report" });';
								echo '</script>';$contok=false;
							}
							else
							{
								echo '<script type="text/javascript">';
								echo '$.growl.notice({ message: "Passcode sent to email address : '.$chkemail.'" });';
								echo '</script>';$contok=false;
							}
							}
						}
					}
					if ($_POST['useraction']=='Continue')
					{
					if ($contok)
					{
						if ($passcode!='')
							{
							$isok=$apidata->validatepasscode($email,$reportid,$passcode);}
						
					}
					}
					}
					if ($isok=='invalidpasscode' || $isok=='expire')
					{
							echo '<script type="text/javascript">';
							echo '$.growl.warning({ message: "Passcode is not valid or exceeded 24 hour validity." });';
							echo '</script>';					
					}					
					if ($isok=='valid')
					{
								?>
								<script>var reportid = "<?php echo $reportid;?>";</script>
								<script src="/public/js/jquery-3.1.0.min.js"></script>
								<script type="text/javascript" src="/public/js/jquery_aspire.js" ></script>
								<div class ="bodycontent">
								<div id="panel"></div></div>
								<?php
								}
					else
					{
					?>
					<form class="passcodeform" method="post" id="scupdate">
					<div class = "entryform">
					<div class = "entryform_header1">Aspire Zone Dashboard</div>
					<br/>
					<br/>
										
					<div class = "entryform_header2">Email address&nbsp;<a href="#" onclick="msgMe('Email address associated with report');" ><img alt="AZF" src="/public/image/tooltip.png" ></a></div>
					<input  style="height:30px; width:100%" type="text" name="email" value="<?php echo $email;?>">
					<br/>
					<br/>
					<div class = "entryform_header2">Passcode&nbsp;<a href="#" onclick="msgMe('Passcode send to associated email address, valid only for 24 hours');" ><img alt="AZF" src="/public/image/tooltip.png" ></a></div>
					<input  style="height:30px; width:100%" type="text" name="passcode" "<?php echo $passcode;?>" >
					<br/>
					<br/>
					<div class = "entryform_header4">To recieve a new passcode select "Send Passcode"</div>
					<br/>
					<div class = "entryform_header3">
						<input class="button_passcode" name = "useraction" type="submit" value="Send Passcode" >
						<input class="button_continue" name = "useraction" type="submit" value="Continue" >
					</div>
					</div>
					</form>
					<?php
					}
					
				}
			}
		}
		
		
		
		echo '</div>';
		}
		
	}
	function pg_end() 
	{ 
		echo '</body></html>';		
	}

	
}
?>