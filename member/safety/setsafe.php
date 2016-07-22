<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：密码未输入						**
//2：新密码与确认密码不同		**
//3：更新成功							**
// ***********************

$result = 0;

$pass		= fstring($_POST["pass"]);
$pass2	= fstring($_POST["pass2"]);
$uid		= intval(fstring($_POST["id"]));

if($pass=="" || is_null($pass)){
	$result = 1;
	echo $result;
	exit;
}
if($pass!=$pass2){
	$result = 2;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$db->query("Update salesman set safepws='".md5($pass)."' WHERE id=".$uid);

$db->close();

$result = 3;
echo $result;

?>