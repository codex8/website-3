<?php
date_default_timezone_set('Europe/London');

$menu = strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
$menu = str_replace("/", "", $menu);


if (substr($menu,0,4)=="wiki" || substr($menu,0,9)=="mediawiki"){ 
 
	$location = "http://wiki.phplondon.org".$_SERVER['REQUEST_URI'];
	
	if($_SERVER['QUERY_STRING']) {
            $location .= '?' . $_SERVER['QUERY_STRING'];
    }
	
	header ('HTTP/1.1 301 Moved Permanently');
	header ('Location: '.$location);
} else {

	header ('HTTP/1.1 301 Moved Permanently');
	header ('Location: http://phplondon.org');

}

