<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：验证码不正确 					**
//2：邮箱格式不正确				**
//3：更新成功							**
// ***********************

$result = 0;

$code		= fstring($_POST["c"]);
$email	= fstring($_POST["e"]);
$uid		= intval(fstring($_POST["id"]));

if($code=="" || is_null($code) || !is_numeric($code) || !isset($_SESSION["emailcode"])){
	$result = 1;
	echo $result;
	exit;
}
if($code!=$_SESSION["emailcode"]){
	$result = 1;
	echo $result;
	exit;
}
if($email=="" || is_null($email) || !validateEmail($email)){
	$result = 2;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$db->query("Update salesman set email='".$email."' WHERE id=".$uid);

unset($_SESSION["emailcode"]);

$db->close();

$result = 3;
echo $result;

?>