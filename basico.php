<?php


require_once ('./include/libs/Smarty.class.php');

$smarty=new Smarty();
$smarty->setTemplateDir('Smarty/templates/');
$smarty->setCompileDir('Smarty/templates_c');
$smarty->setConfigDir('Smarty/configs');
$smarty->setCacheDir('Smarty/cache/');