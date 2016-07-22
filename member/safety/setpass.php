<?php
require "../login/checksession.php";
include "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：验证码错误						**
//2：新密码为空						**
//3：新密码和确认新密码不同	**
//4：修改成功							**
// ***********************

$result = 0;

$pass		= fstring($_POST["pass"]);
$pass2	= fstring($_POST["pass2"]);
$code		= fstring($_POST["c"]);
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

if($pass=="" || is_null($pass)){
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
$db->query("Update salesman set pws='".md5($pass)."' WHERE id=".$uid);

unset($_SESSION["emailcode"]);

$db->close();

$result = 4;
echo $result;

?>