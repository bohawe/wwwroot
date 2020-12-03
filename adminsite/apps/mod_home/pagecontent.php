<link href='/public/css/jquery.growl.css' rel='stylesheet' type='text/css'>
<script src='/public/js/jquery.growl.js' type='text/javascript'></script>
	
<?php
class page_parts
{
	function pg_header($action) 
	{
		
		$pg_path = getcwd().'/apps/mod_home/header.php';						
		require_once($pg_path);
		
		
	}		
	
	function pg_body($action,$error) 
	{		
		//echo getcwd();
		//print_r($_POST);
		$userid = 'local user';
		if (isset($_SESSION['userid']))
		{
			$userid = $_SESSION['userid'];
		}
		require_once( getcwd().'/apps/lib/dblayer/datapipe.php');
		$apidata = new datapipe_admin();			
		$checkuser=$apidata->validateuser($userid);
		if ($checkuser!='1exist')
		{
				?>
					<div class = "bodycontent_user">
					<form class="passcodeform" method="post" id="scupdate">
					<div class = "entryform">
					<div class = "entryform_header1">Aspire Zone Dashboard</div>
					
					<br/>
										
					<div class = "entryform_header2">You are not an authorized to access this application.</a></div>
					<br/>
					<div class = "entryform_header2">Please contact system administrator for information about this web site.</a></div>
					<br/>
					<div class = "entryform_header3">
						<input class="button_passcode" name = "useraction" type="submit" value="Log Out" >						
					</div>
					</div>
					</form>
					</div>
					<?php
			exit;
		}
		
		$vmsg = '';
		$reportid = '';$sbu='';$reportname='';$sbu='';$author='';$enable='';$expire='';$passcode='';		
		$reporturl = '';$reqref = '';$mail='';
		if (isset($_POST['reportid'])){$reportid = $_POST['reportid'];}
		if (isset($_POST['reportname'])){$reportname = $_POST['reportname'];}
		if (isset($_POST['author'])){$author = $_POST['author'];}
		if (isset($_POST['enable'])){$enable = $_POST['enable'];}
		if (isset($_POST['expire'])){$expire = (string)$_POST['expire'];}
		if (isset($_POST['passcode'])){$passcode = $_POST['passcode'];}
		if (isset($_POST['reporturl'])){$reporturl = $_POST['reporturl'];}
		if (isset($_POST['reqref'])){$reqref = $_POST['reqref'];}
		if (isset($_POST['mail'])){$mail = $_POST['mail'];}
		if (isset($_POST['sbu'])){$sbu = $_POST['sbu'];}
		if (isset($_POST['useraction']))
		{
			if ($_POST['useraction'] == 'Back' || $_POST['useraction'] == 'Refresh')
			{
				$action='home';
			}
			else
			{
				$action=$_POST['useraction'];
			}
		}
		if ($action == 'Update' || $action == 'Save') /* validation */
		{
			$chk=$apidata->checkurl($reporturl,$reportid);
			
			if($chk=='exist')
			{
				$vmsg = $vmsg.'|Report URL already exist';
			}
			if (isset($_POST['passcode']))
			{
			if ($_POST['passcode'] == 'on')
			{
				if ($_POST['mail'] == '')
				{
					$vmsg = '|Associated mail is require if passcode is enabled';		
					//$action='Edit';
				}
				else
				{
					$mails = explode(";",$_POST['mail']);	
					foreach ($mails as $mailcheck)
					{					
						if ($mailcheck!='')
						{
						if (!filter_var($mailcheck, FILTER_VALIDATE_EMAIL)) {
						$vmsg = $vmsg.'|<b>'.$mailcheck.'</b> is not valid email address, separate email address with semi colon for multiple emails.';		
						//$action='Edit';
						}}
					}
				}
			}}
			
			if ($_POST['reportname']==''){$vmsg = $vmsg.'|Report title is required';if ($_POST['useraction'] == 'Save') {$action == 'Add';}if ($_POST['useraction'] == 'Update') {$action == 'Edit';}}
			if ($_POST['reqref']==''){$vmsg = $vmsg.'|Request description title is required';if ($_POST['useraction'] == 'Save') {$action == 'Add';}if ($_POST['useraction'] == 'Update') {$action == 'Edit';}}
			if ($_POST['sbu']==''){$vmsg = $vmsg.'|Business unit is required';if ($_POST['useraction'] == 'Save') {$action == 'Add';}if ($_POST['useraction'] == 'Update') {$action == 'Edit';}}
			if ($_POST['author']==''){$vmsg = $vmsg.'|Author is required';if ($_POST['useraction'] == 'Save') {$action == 'Add';}if ($_POST['useraction'] == 'Update') {$action == 'Edit';}}
			
		}

		if ($action == 'Update')
		{
			if ($vmsg == '')
			{			
				
				$ary = $apidata->updatereport($reportid,$sbu,$reportname,$author,$enable,$expire,$passcode,$reporturl,$reqref,$mail);										
				$action='home';
			}
			else
			{
				$action = 'Edit';
			}
		}
		if ($action == 'Save')
		{
			if ($vmsg == '')
			{							
				$ary = $apidata->newreport($sbu,$reportname,$author,$enable,$expire,$passcode,$reporturl,$reqref,$mail);										
				
				$action='home';
			}
			else
			{
				$action = 'Add';
			}
		}
		if ($action=='Save'){if ($vmsg !=''){$action = 'Add';}else{$action = 'home';}}		
		if ($action=='Edit'){
			if (isset($_POST['reportid'])){$action='Edit';}
			else
			{
				if (!isset($_POST['selectedrow'])){
					$action = 'home';$vmsg='Please select a record to edit';
				}
			}
			
		}		
		require 'apps/lib/message.php';			
		$msg = new message();		
		if ($error=='')
		{
			if ($action=='Add')
			{
				echo '<div class = "bodycontent">';
				$pg_path = getcwd().'/apps/mod_home/AddReport.php';						
				require_once($pg_path);		
				echo '<div>';
			}
			if ($action=='Edit')
			{
				echo '<div class = "bodycontent">';
				
				$pg_path = getcwd().'/apps/mod_home/EditReport.php';						
				require_once($pg_path);		
				echo '<div>';
			}
			if ($action=='home')
			{				
				echo '<div class = "bodycontent">';
				$pg_path = getcwd().'/apps/mod_home/reportlist.php';						
				require_once($pg_path);		
				echo '<div>';
			}
		}
		else
		{
			echo '<div class = "bodycontent">';
			$msg->report404();
			echo '<div>';
		}
		
	}
	function pg_end() 
	{ 
		echo '</body></html>';		
	}

	
}
?>