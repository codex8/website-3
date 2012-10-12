<?php
date_default_timezone_set('Europe/London');
require('../libs/Smarty.class.php');
require('../libs/helpers.php');

echo "<!-- orchestra.io test 4.3 -->";

$smarty = new Smarty;

$sys_tmp_dir = sys_get_temp_dir();

if (!is_dir($sys_tmp_dir."/phplondonorg/templates_c")){
	mkdir($sys_tmp_dir."/phplondonorg");
	mkdir($sys_tmp_dir."/phplondonorg/templates_c");
}

$smarty->compile_dir  = $sys_tmp_dir."/phplondonorg/templates_c/";

$menu = strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));

$menu = str_replace("/", "", $menu);

if(empty($menu)) { $menu = "home"; }

if (substr($menu,0,4)=="wiki" || substr($menu,0,9)=="mediawiki"){ 
 
	$location = "http://wiki.phplondon.org".$_SERVER['REQUEST_URI'];
	
	if($_SERVER['QUERY_STRING']) {
            $location .= '?' . $_SERVER['QUERY_STRING'];
    }
	
	header ('HTTP/1.1 301 Moved Permanently');
	header ('Location: '.$location);
}
	

$smarty->assign("menu", $menu);

$smarty->force_compile = false;
$smarty->debugging = false;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;




$smarty->display('header.tpl');




$next_meetup = json_decode(loadFile('./sample.json'));

// very hacky won't always work needs some major regex-fu
$description = explode("<p>", $next_meetup->results['0']->description);
$description = explode("</p>", $description[6]);
$description = $description['0'];


print "<pre>";

//print $next_meetup;

print($next_meetup->results['0']->name."\n");
print($next_meetup->results['0']->venue->name."\n");
print($next_meetup->results['0']->venue->address_1."\n");
print($next_meetup->results['0']->yes_rsvp_count."\n");
print($next_meetup->results['0']->rsvp_limit."\n");
print($next_meetup->results['0']->group->who."\n");
print($next_meetup->results['0']->event_url."\n");
print($description."\n");
print(date("Y-M-d", $next_meetup->results['0']->created)."\n");
$smarty->assign("meetupName", $next_meetup->results['0']->name);
$smarty->assign("venueName", $next_meetup->results['0']->venue->name);
$smarty->assign("venueAddress", $next_meetup->results['0']->venue->address_1);
$smarty->assign("meetupYes", $next_meetup->results['0']->yes_rsvp_count);
$smarty->assign("meetupLimit", $next_meetup->results['0']->rsvp_limit);
$smarty->assign("meetupUsers", $next_meetup->results['0']->group->who);
$smarty->assign("meetupURL", $next_meetup->results['0']->event_url);
$smarty->assign("meetupTalk", $description);

print_r($next_meetup->results['0']);
print "</pre>";

switch ($menu) {


    case "home":
        $smarty->display('home.tpl');
		$smarty->display('boxes.tpl');
        break;
    case "about":
        $smarty->display('about.tpl');
		$smarty->display('directors.tpl');
        break;
    case "contact":
        $smarty->display('contact.tpl');
        break;
	default:
		$smarty->display('default.tpl');
        
}
$smarty->display('footer.tpl');
?>
