<?php
class page_parts
{
	function pg_header($action,$subaction) 
	{		
		$pg_path = 'apps/mod_home/header.php';						
		require_once($pg_path);				
	}		
	
	function pg_body($action,$error) 
	{		
		
		require 'apps/lib/message.php';	
		$msg = new message();
		if ($error=='')
		{
			if ($action=='home')
			{
				$pg_path = 'apps/mod_home/welcome.php';						
				require_once($pg_path);		
			}
		}
		else
		{
			if ($error=='terms')
			{
				$pg_path = 'apps/mod_home/terms.php';						
				require_once($pg_path);		
			} else if ($error=='privacy')
			{
				$pg_path = 'apps/mod_home/privacy.php';						
				require_once($pg_path);		
			}		
			else
			{
			echo '<div class = "bodycontent">';
			$msg->report404();
			echo '<div>';
			}
		}
		
	}
	function pg_end() 
	{ 
		echo '</body></html>';		
	}

	
}
?>