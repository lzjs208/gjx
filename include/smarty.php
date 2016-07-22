<?php
include (APP_PATH . "/../plugins/smarty/libs/Smarty.class.php");

$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 60;
$smarty->setTemplateDir(APP_PATH . "/../templates");
$smarty->setCompileDir(APP_PATH . "/../templates_c");
$smarty->setCacheDir(APP_PATH . "/../templates_cache");
$smarty->left_delimiter = "<{";
$smarty->right_delimiter = "}>";

$smarty->assign("title","天合积分交易平台");
?>