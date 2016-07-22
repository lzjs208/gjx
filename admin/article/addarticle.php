<?php
require "../inc/checksession.php";
include "../../include/function.php";
include "../inc/smarty.php";


$editor = $_SESSION["realname"];

$smarty->assign("pubdate",date('Y-m-d H:i:s',time()));
$smarty->assign("editor",$editor);
$smarty->display("addarticle.tpl");

?>