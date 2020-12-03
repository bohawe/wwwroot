<?php
require getcwd().'/apps/mod_report/pagecontent.php';

class report extends page_parts 
{    
    public function index($reportid)
    {		
        $this->pg_header($reportid);				
		$this->pg_body($reportid);
		$this->pg_end();		
    }
}
