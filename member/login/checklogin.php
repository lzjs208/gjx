<?php

require "../../include/mysql.class.php";
include "../../include/config.php";
include "../../include/function.php";

//************************
//1：验证成功							**
//2：信息不完整						**
//3：验证码不正确 					**
//4：用户名或密码不正确		**
//5：用户被禁用						**
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

$db = new ConnectionMYSQL();

$query = "SELECT * FROM salesman WHERE manname='".$user."'";

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
			$_SESSION["id"]				= $row["id"];
			$_SESSION["username"] = $row["manname"];
			$_SESSION["manlevel"] = $row["manlevel"];
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