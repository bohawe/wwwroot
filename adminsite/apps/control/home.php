<?php
require getcwd().'/apps/mod_home/pagecontent.php';

class Home extends page_parts 
{    
    public function index($action,$error)
    {		
        $this->pg_header($action);				
		$this->pg_body($action,$error);
		$this->pg_end();		
    }
}
