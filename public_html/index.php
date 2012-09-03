<?php
date_default_timezone_set('Europe/London');
require('../libs/Smarty.class.php');

echo "<!-- orchestra.io test 4.3 -->";

$smarty = new Smarty;

$sys_tmp_dir = sys_get_temp_dir();

if (!is_dir($sys_tmp_dir."/phplondonorg/templates_c")){
	mkdir($sys_tmp_dir."/phplondonorg");
	mkdir($sys_tmp_dir."/phplondonorg/templates_c");
}

$smarty->compile_dir  = $sys_tmp_dir."/phplondonorg/templates_c/";

$menu = strtolower(filter_input(INPUT_GET, 'menu', FILTER_SANITIZE_STRING));
if(empty($menu)) { $menu = "home"; }

$smarty->assign("menu", $menu);

$smarty->force_compile = false;
$smarty->debugging = false;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;

$smarty->display('header.tpl');

switch ($menu) {

    case "home":
        $smarty->display('home.tpl');
		$smarty->display('boxes.tpl');
        break;
    case "about":
        $smarty->display('about.tpl');
		$smarty->display('boxes.tpl');
        break;
    case "contact":
        $smarty->display('contact.tpl');
        break;
	default:
		// TODO: Replace with a proper 404
        $smarty->display('home.tpl');
		$smarty->display('boxes.tpl');
}
$smarty->display('footer.tpl');
?>
