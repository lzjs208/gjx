<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//0：未知错误							**
//1：重置成功							**
//2：密码或参数为空				**
//3：密码和确认密码不同		**
// ***********************

$result = 0;

$id = fstring($_POST['id']);
$safepass = fstring($_POST['safepass']);
$safepass2 = fstring($_POST['safepass2']);

if(!isset($id) || empty($id) || !isset($safepass) || empty($safepass)){
	$result = 2;
	echo $result;
	exit;
}

if($safepass!=$safepass2){
	$result = 3;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();

$res = $db->query("UPDATE salesman SET safepws='".md5($safepass)."' WHERE id=".intval($id)."");
if($res){
	$result = 1;
}else{
	$result = 0;
}

echo $result;
?>