<?php
require "../../include/mysql.class.php";
include "../inc/config.php";
include "../../include /function.php";

//************************
//1：验证成功
//2：信息不完整						**
//3：验证码不正确 					**
//4：用户名或密码不正确		**
//5：用户禁用							**
// ***********************

$result = 0;

$user = $pass = $code = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$user = fstring(trim($_POST["u"]));
	$pass = fstring(trim($_POST["p"]));
	$code = fstring(trim($_POST["c"]));
}

if(is_null($user) || $user=="" || is_null($pass) || $pass==""){
	$result = 2;
	echo $result;
	exit;
}

if(!isset($_SESSION["code"]) || is_null($code) || strtolower($_SESSION["code"])!=$code){
	$result = 3;
	echo $result;
	exit;
}

$arg_cny= "0.00000000";
$arg_btc= "0.00000000";
$arg_ltc= "0.00000000";
 
$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM args GROUP BY argtype ORDER BY times DESC");
if(mysql_num_rows($res)){
	while($row = mysql_fetch_array($res)){
		if($row["argtype"]==1){
			$arg_cny = $row["val"];
		}else if($row["argtype"]==2){
			$arg_btc = $row["val"];
		}else if($row["argtype"]==3){
			$arg_ltc = $row["val"];
		}
	}
}

$query = "SELECT * FROM admuser WHERE username='".$user."'";
$res = $db->query($query);
if(!mysql_num_rows($res)){
	$result = 4;
}
while($row = mysql_fetch_array($res)){
	if($row["pws"]==md5($pass)){
		if($row["isallow"]==1){
			$result = 5;
			echo $result;
			exit;
		}else{
			$_SESSION["admid"]		= $row["id"];
			$_SESSION["admuser"]	= $row["username"];
			$_SESSION["realname"] = $row["realname"];
			$db->query("UPDATE admuser set logintime='".strtotime("now")."',loginIP='".$_SESSION['admuser']."' WHERE username='".$user."'");
			unset($_SESSION["code"]);
			$result = 1;
		}
	}else{
		$result = 4;
	}
}

$db->close();

echo $result;
?>