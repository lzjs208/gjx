<?php
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/config.php";

//************************
//1：信息不完整						**
//2：登陆密码确认密码不相同 **
//3：验证码不正确 					**
//4：会员重复							**
//5：验证成功							**
// ***********************

$result = 0;
$user = $pass = $pass2 = $email = $phone = $code = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$user		= fstring(trim($_POST["u"]));
	$pass		= fstring(trim($_POST["pass"]));
	$pass2	= fstring(trim($_POST["pass2"]));
	$email	= fstring(trim($_POST["e"]));
	$phone	= fstring(trim($_POST["p"]));
	$code		= fstring(trim($_POST["c"]));
}

if(!is_RepeatName($user)){
	$result = 4;
	echo $result;
	exit;
}

if(is_null($user) || $user=="" || is_null($pass) || $pass=="" || is_null($email) || $email=="" || is_null($phone) || $phone=="" || is_null($code) || $code==""){
	$result = 1;
	echo $result;
	exit;
}
if($pass!=$pass2){
	$result = 2;
	echo $result;
	exit;
}
if(!isset($_SESSION["emailcode"]) || !is_numeric($code) || $code!=$_SESSION["emailcode"]){
	$result = 3;
	echo $result;
	exit;
}

if ($result==0){
	$btc	= crypt($user,general_num(2))."".crypt($code,general_num(2))."".crypt(strtotime(date('Y-m-d H:i:s',time())),general_num(2));
	$btc	= string_replace($btc, 32);
	$ltc	= crypt($user,general_num(2))."".crypt($code,general_num(2))."".crypt(strtotime(date('Y-m-d H:i:s',time())),general_num(2));
	$ltc	= string_replace($ltc, 32);
	$gc		= crypt($user,general_num(2))."".crypt($code,general_num(2))."".crypt(strtotime(date('Y-m-d H:i:s',time())),general_num(2));
	$gc		= string_replace($gc, 32);
	$db = new ConnectionMYSQL();
	$db->fn_insert("salesman", "manname,pws,email,phone,BTCaddress,LTCaddress,GCaddress,addtime", "'$user','".md5($pass)."','$email','$phone','$btc','$ltc','$gc','".strtotime(date('Y-m-d H:i:s',time()))."'");
	$result = 5;
}

unset($_SESSION["emailcode"]);
$db->close();

echo $result;

//===============================================
function is_RepeatName($str){
	global $db;
	$db = new ConnectionMYSQL();
	$query = "SELECT manname FROM salesman where manname='".$str."'";
	$res = mysql_query($query);
	if(mysql_num_rows($res)){
		$flag = false;
	}else{
		$flag = true;
	}
	 return $flag;
}
?>