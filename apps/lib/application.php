<?php

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();				
		if ($this->url_controller == '') {$this->url_controller='home';} /* set to default home */		
		
        // check for controller: does such a controller exist ?
        if (file_exists('./apps/control/' . $this->url_controller . '.php') ) 
			{

				require './apps/control/' . $this->url_controller . '.php';						            
				if ($this->url_controller == 'report') 
				{            
					$this->url_controller = new $this->url_controller();            
					$this->url_controller->index($this->url_action);
				}
				if ($this->url_controller == 'home') {                				
					$this->url_controller = new $this->url_controller();            
					$this->url_controller->index('home',$this->url_action);
				}
			}


        
		else
		{
			
			$this->url_controller = 'home';
			$this->url_action = '404';			
			require './apps/control/' . $this->url_controller . '.php';						            
			$this->url_controller = new $this->url_controller();   
            $this->url_controller->index('home',$this->url_action);
		}
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['apps'])) {

            $url = rtrim($_GET['apps'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
			

            // for debugging. uncomment this if you have problems with the URL			
			/*
			 echo '<br/><br/><br/><br/><br/><br/><br/><br/>';
             echo 'Controller: ' . $this->url_controller . '<br />';
             echo 'Action: ' . $this->url_action . '<br />';
             echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
             echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
             echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';											 
			*/
        }
		else
		{
			if (empty($_GET))
			{
				$this->url_controller = '';
			}
			else
			{
				$this->url_controller = '404';
			}
		}
		
    }
}
