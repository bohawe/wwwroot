<?php
class message		
{	
	
	function noreport()
    {
		$msgh = 'Missing report identifier';
		$msgb = 'You need to enter the correct URL with correct report identity provided by the author/publisher of the report from Aspire Zone.';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent"><br/>'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
	}
	function reportinvalid($reportid)
    {
		$msgh = 'Report is no longer available';
		$msgb = 'The report identifier "'.$reportid.'" is invalid, please contact the author/publisher of the report from</br>Aspire Zone.';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent">'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
		
	}	
	function reportprivate($reportid)
    {
		$msgh = 'Report is unavailable for public view';
		$msgb = 'The report "'.$reportid.'" is set to private.';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent"><br/>'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
	}	
	function reportexpired($reportid)
    {
		$msgh = 'Blocked for public view';
		$msgb = 'The report "'.$reportid.'" is set for public view by the author/publisher with specific date of lockout.';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent"><br/>'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
	}	
	function reportdberror()
    {
		$msgh = 'Internal Error Encountered';
		$msgb = 'Internal error encountered, will get back to you soon.';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent"><br/>'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
	}	
	function report404()
    {
		$msgh = 'HTTP Error 404.0 - Not Found';
		$msgb = 'The resource you are looking for has been removed, had its name changed, or is temporarily unavailable.<br>';
		echo '<div class = "entryformmsg">';
		echo '<div class = "entryform_headermsg">'.$msgh.'</div>';		
		echo '<div class = "entryform_headermsgcontent"><br/>'.$msgb.'</div>';				
		echo '</div>';
		return 'no id';
	}		
}			
?>
