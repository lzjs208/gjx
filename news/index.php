<?php
require "../include/config.php";
require "../include/mysql.class.php";
require "../include/function.php";
include "../include/smarty.php";

$db = new ConnectionMYSQL();
$res = $db->query("SELECT id,title,titlepic,isexam,pubdate,jumpurl,sortContent FROM article WHERE isexam=1 ORDER BY pubdate DESC");
if($res){
  while($rows = mysql_fetch_array($res)){
    $arr[] = $rows;
  }
}else{
  $arr = array();
}


$picstr = artTitlepic();

function artTitlepic(){
  global $db;
  $res = $db->query("SELECT id,title,titlepic,isexam,pubdate,jumpurl,sortContent FROM article WHERE titlepic!='' AND isexam=1 ORDER BY pubdate DESC");
  if($res){
    while($rows = mysql_fetch_array($res)){
      $arrStr[] = $rows;
    }
  }else{
    $arrStr = array();
  }
  return $arrStr;
}

$db->close();

$smarty->assign("piclist",$picstr);
$smarty->assign("artlist",$arr);
$smarty->display("index_article.tpl");