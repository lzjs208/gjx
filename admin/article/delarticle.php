<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

/**
 *$result:1 删除成功
 *$result:0 删除不成功
 */

$db = new ConnectionMYSQL();

$arcId = intval(fstring($_GET['arcId']));

if(!isset($arcId) || empty($arcId)){
  $result = 0;
  echo $result;
  exit;
}

$res = $db->fn_delete("article",$arcId);

if($res){
  $result = 1;
}else{
  $result = 0;
  echo $result;
  exit;
}

echo $result;

?>