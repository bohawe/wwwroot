<?php
require 'pbidatabase.php';


$url_controller = null;
if (isset($_GET['data']) && $_GET['data']!="") 
{
	$url = rtrim($_GET['data'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
	$url_controller = (isset($url[0]) ? $url[0] : null);
	$url_para = (isset($url[1]) ? $url[1] : null);
	
	$restval = new pbidata();
	
}
else
{
	echo 'Invalid URL';
}

?>