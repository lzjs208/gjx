<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：验证码不正确 					**
//2：手机号不正确					**
//3：更新成功							**
// ***********************

$result = 0;

$code		= fstring($_POST["c"]);
$phone	= fstring($_POST["p"]);
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
if($phone=="" || is_null($phone) || !is_numeric($phone)){
	$result = 2;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$db->query("Update salesman set phone='".$phone."' WHERE id=".$uid);

unset($_SESSION["emailcode"]);

$db->close();

$result = 3;
echo $result;

?>