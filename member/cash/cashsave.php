<?php
require "../login/checksession.php";
include "../../include/mysql.class.php";
include "../../include/function.php";

//******************************
//1：信息输入不完整							**
//2：验证码输入错误							**
//3：余额不足										**
//4：提现金额不能大于今日提现限额	**
//5：提交成功										**
// *****************************

$result = 0;

$bankcard = cn_fstring(trim($_POST["txt"]));
$bankval = cn_fstring(trim($_POST["val"]));
$amount		= fstring($_POST["amount"]);
$code			= fstring(trim($_POST["code"]));
$cny			= fstring(trim($_POST["cny"]));
$cashtype = fstring(trim($_POST["ctype"]));
$cashtime = strtotime("now");

if($bankval=="" || $amount=="" || !is_numeric($amount)){
	$result = 1;
	echo $result;
	exit;
}

if($code=="" || is_null($code) || !is_numeric($code) || !isset($_SESSION["emailcode"]) || $code!=$_SESSION["emailcode"]){
	$result = 2;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();

$cash_total = limit_cash() + $amount;

$cost = $amount * (arg_val(6) / 100);

if($cash_total > arg_val(5)){
	$result = 4;
	echo $result;
	exit;
}

$res = $db->query("INSERT INTO cashes (cashtype,cashtime,cashbank,cashmoney,cashcost,casher,cashstatus) values(".$cashtype.",'".$cashtime."','".$bankcard."',".$amount.",".$cost.",'".$_SESSION["username"]."',1)");
if(!$res){
	$result = 0;
}else{
	$res2 = $db->query("SELECT * FROM salesman WHERE manname='".$_SESSION["username"]."'");
	if(mysql_num_rows($res2)){
		$row = mysql_fetch_array($res2);
		$kycny = $row["kycny"];
		if($amount > $kycny || $amount == 0) {
			$result = 3;
			echo $result;
			exit;
		}
		$res3 = $db->query("UPDATE salesman SET kycny=".floatval($kycny - $amount - $cost)." WHERE manname='".$_SESSION["username"]."'");
		if($res3){
			$result = 5;
			echo $result;
			unset($_SESSION["emailcode"]);
			exit;
		}else{
			$result = 0;
		}
	}else{
		$result = 0;
	}
}

function limit_cash(){
	global $db;
	$res = $db->query("SELECT SUM(cashmoney) as a FROM cashes WHERE casher='".$_SESSION["username"]."' AND FROM_UNIXTIME(cashtime,'%Y-%m-%d')=date(now())");
	if($res){
		$row = mysql_fetch_array($res);
		return $row["a"];
	}else{
		return 0;
	}
}

function arg_val($argtype){
	global $db;
	$res = $db->query("SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC limit 0,1");
	if($res){
		$row = mysql_fetch_array($res);
		return $row["val2"];
	}else{
		return 0;
	}
} 

$db->close();

echo $result;
?>