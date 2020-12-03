<?php
class page_parts
{
	
	function pg_header($reportid) 
	{
		$pg_path = 'apps/mod_report/header.php';						
		require_once($pg_path);				
	}		
	
	function pg_body($reportid) 
	{
		echo '<div class = "bodycontent">';
		require 'apps/lib/message.php';
	
		$msg = new message();
		$db = new datalayer();
		
		if ($reportid ==''){$msg->noreport();$reportname='Missing Report Identifier';}
		else
		{		
			
			if ($db->checkid($reportid)=='not exist')
			{
				$msg->reportinvalid($reportid);
			}
			else
			{
				$header = $db->getheaders($reportid);			
				if ($header=='dberror')
				{
					$msg->reportdberror();
				}
				else
				{
					$allowed = 'yes';
					$hdr = explode('|',$header);
					$public = $hdr[2];
					$expired = $hdr[3];
					if ($public=='no')
					{
						$allowed = 'no';
						$msg->reportprivate($hdr[1]);
					}
					else
					{
						if ($expired == 'yes')
						{
							$allowed = 'no';
							$msg->reportexpired($hdr[1]);
						}
					}
					if ($allowed == 'yes')
					{
						
						?>
						<script>var reportid = "<?php echo $reportid;?>";</script>
						<script src="/public/js/jquery-3.1.0.min.js"></script>
						<script type="text/javascript" src="/public/js/jquery_aspire.js" ></script>
						<div class ="bodycontent">
						<div id="panel"></div></div>
						<?php
					}
				}
			}
		}
		
		echo '</div>';
	}
	function pg_end() 
	{ 
		echo '</div></body></html>';		
	}

	
}
?>