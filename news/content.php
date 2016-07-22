<?php
require "../include/config.php";
require "../include/mysql.class.php";
require "../include/function.php";
include "../include/smarty.php";

$id = fstring($_GET["id"]);

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM article left join art_body ON article.id=art_body.artid WHERE article.id=".$id." AND isexam=1");

if($res){
  $row = mysql_fetch_array($res);
  $jumpurl = $row["jumpurl"];
}else{
  header("Location ../");
  exit;
}

$click = art_click($id);

if($jumpurl){
  header("Location: $jumpurl");
  exit;
}

$artarr = art_hotlist("click desc");

//==================================================================

function art_click($artId){
  global $db;
  $res = $db->query("SELECT click FROM article WHERE id=".$artId);
  if($res){
    $row = mysql_fetch_array($res);
    $click = $row["click"];
    $res = $db->query("UPDATE article set click=".intval($click + 1)." WHERE id=".$artId);
  }else{
    $click = 0;
  }
  return $click;
}

function art_hotlist($orderby='click',$num=5){
  global $db;
  $res = $db->query("SELECT id,title,click FROM article ORDER BY ".$orderby." limit 0,".$num);
  if($res){
    while($rows = mysql_fetch_array($res)){
      $arr[] = $rows;
    }
  }else{
    $arr = array();
  }
  return $arr;
}

$smarty->assign("result",$row);
$smarty->assign("arrlist",$artarr);
$smarty->display("content.tpl");

?>