<?php
class message		
{	
	
	function noreport()
    {
		$msgh = 'Missing Report Identifier';
		$msgb = 'You need to enter the correct URL with correct report identity provided by the author/publisher of the report from Azpire Zone.';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}
	function reportinvalid($reportid)
    {
		$msgh = 'Invalid Report Identifier';
		$msgb = 'The report identifier "'.$reportid.'" is invalid, please contact the author/publisher of the report from Azpire Zone.';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}	
	function reportprivate($reportid)
    {
		$msgh = 'Unavailable for Public Preview';
		$msgb = 'The report "'.$reportid.'" is not yet ready for public preview.';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}	
	function reportexpired($reportid)
    {
		$msgh = 'Blocked for Public Preview';
		$msgb = 'The report "'.$reportid.'" is set for public preview by the author/publisher with specific date of lockout.';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}	
	function reportdberror()
    {
		$msgh = 'Internal Error Encountered';
		$msgb = 'Internal error encountered, will get back to you soon';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}	
	function report404()
    {
		$msgh = 'HTTP Error 404.0 - Not Found';
		$msgb = 'The resource you are looking for has been removed, had its name changed, or is temporarily unavailable.<br>';
		echo '<div class = "msg_error">';
		echo '<h3>'.$msgh.'</h3>';
		echo '<h4>'.$msgb.'</h4>';
		echo '</div>';
		return 'no id';
	}		
}			
?>
