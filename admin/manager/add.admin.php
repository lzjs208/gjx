<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：添加成功		 					**
//2：信息填写不完整				**
//3：会员名重复						**
//0：添加不成功						**
// ***********************

$result = 0;
$user = $pass = $realname = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$user			= fstring(trim($_POST["u"]));
	$pass			= fstring(trim($_POST["p"]));
	$realname = cn_fstring(trim($_POST["name"]));
}

if(!isset($user) || empty($user) || !isset($pass) || empty($pass)){
	$result = 2;
	echo $result;
	exit;
}

if(!is_RepeatName($user)){
	$result = 3;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$db->fn_insert("admuser", "username,pws,realname,addtime", "'".$user."','".md5($pass)."','".$realname."','".strtotime(date("Y-m-d H:i:s",time()))."'");
$result = 1;

$db->close();

echo $result;


//===============================================
function is_RepeatName($str){
	global $db;
	$db = new ConnectionMYSQL();
	$query = "SELECT username FROM admuser where username='".$str."'";
	$res = mysql_query($query);
	
	if(mysql_num_rows($res)){
		$flag = false;
	}else{
		$flag = true;
	}
	 return $flag;
}

?>