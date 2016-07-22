<?php
require "../inc/checksession.php";
include "../../include/function.php";
include "../../include/mysql.class.php";
include "../inc/smarty.php";

$artId = fstring($_GET['id']);

if(!isset($artId) || empty($artId) || $artId == 'undefined'){
  show_back("无效的参数，请重新选择!");
  exit;
}
$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM article as a LEFT JOIN (SELECT artid,content,wapcontent FROM art_body) as b ON a.id=b.artid WHERE a.id=".$artId);

if($res){
  $arr = mysql_fetch_array($res);
}else{
  show_back("没有任何有效的数据！");
  exit;
}

$smarty->assign("result",$arr);
$smarty->display("editarticle.tpl");


?>