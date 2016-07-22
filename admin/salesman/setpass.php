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
$pass = fstring($_POST['pass']);
$pass2 = fstring($_POST['pass2']);

if(!isset($id) || empty($id) || !isset($pass) || empty($pass)){
	$result = 2;
	echo $result;
	exit;
}

if($pass!=$pass2){
	$result = 3;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();

$res = $db->query("UPDATE salesman SET pws='".md5($pass)."' WHERE id=".intval($id)."");
if($res){
	$result = 1;
}else{
	$result = 0;
}

echo $result;
?>