<?php
date_default_timezone_set('Europe/London');
require('../libs/Smarty.class.php');

class EvaledFileResource extends Smarty_Internal_Resource_File { 
    public function populate(Smarty_Template_Source $source, Smarty_Internal_Template $_template=null) { 
        parent::populate($source, $_template); 
        $source->recompiled = true; 
    } 
}

echo "<!-- orchestra.io test 2 -->";

$smarty = new Smarty;

$smarty 
    ->setTemplateDir('./templates') 
    ->registerResource('file', new EvaledFileResource()); 

$menu = strtolower(filter_input(INPUT_GET, 'menu', FILTER_SANITIZE_STRING));
if(empty($menu)) { $menu = "home"; }

$smarty->assign("menu", $menu);

$smarty->force_compile = false;
$smarty->debugging = false;
$smarty->caching = false;
//marty->cache_lifetime = 120;

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
