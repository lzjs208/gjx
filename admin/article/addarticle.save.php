<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$title  = cn_fstring($_POST['title']);
$catId    = fstring($_POST['catId']);
$content = $_POST['content'];

if(!isset($title) || empty($title)){
  show_back('标题不能为空！');
  exit;
}

if(!isset($catId) || empty($catId)){
  show_back('请选择文章所属栏目');
  exit;
}

if(!isset($content) || empty($content) || $content == '文章内容'){
  show_back('请输入文章内容！');
  exit;
}

$shorttit = cn_fstring($_POST['shorttit']);
$jumpurl  = cn_fstring($_POST['jumpurl']);
$tuijian  = fstring($_POST['tuijian']);
$titlepic = fstring($_POST['titlepic']);
$keyword  = cn_fstring($_POST['keyword']);
$pubdate  = strtotime(fstring($_POST['pubdate']));
$tpl      = fstring($_POST['tplfile']);
$editor   = fstring($_POST['editor']);
$source   = fstring($_POST['source']);
$sortContent  = cn_fstring($_POST['sortContent']);
$wapContent = cn_fstring($_POST['wap_content']);
$wapContent = str_replace('wap文章内容','',$wapContent);
$thumbs = fstring($_POST['thumbs']);

$db = new ConnectionMYSQL();

$field  = "catid,parentid,title,shorttit,editor,source,titlepic,keywords,jumpurl,isexam,tuijian,pubdate,sortContent,tpl";
$values = "$catId,0,'$title','$shorttit','$editor','$source','$titlepic','$keyword','$jumpurl',1,0,$pubdate,'$sortContent','$tpl'";
$db->fn_insert('article',$field,$values);

$artId = mysql_insert_id();
add_artContent($artId,$content,$wapContent,$thumbs);
show_backUrl('添加成功！','addarticle.php');

$db->close();

function add_artContent($artId,$artContent,$wapContent,$thumbs){
  global $db;
  $db->fn_insert("art_body","artId,content,wapcontent,thumbs","$artId,'".$artContent."','".$wapContent."','".$thumbs."'");
}

?>