<?php
require 'apps/mod_home/pagecontent.php';

class Home extends page_parts 
{    
    public function index($action,$subaction)
    {							
        $this->pg_header($subaction,$subaction);				
		$this->pg_body($action,$subaction);
		$this->pg_end();		
		
    }
}
