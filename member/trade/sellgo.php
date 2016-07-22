<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//**********************************
//success：购买成功 								**
//failure：提交不成功								**
//1：信息填写不完整或格式不正确				**
//2：卖出数量不能为0，不能超出可用GC		**
//3：交易额达到上限									**
// *********************************

$sellprice	= fstring(trim($_POST["p"]));
$sellnum		= fstring(trim($_POST["n"]));
$cny				= fstring(trim($_POST["cny"]));
$sellmoney	= $sellprice * $sellnum;
$seller			= $_SESSION["username"];
$selltime		= strtotime("now");

if($sellprice=="" || !is_numeric($sellprice) || $sellnum=="" || !is_numeric($sellnum)){
	$result = 1;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]);
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$kyjf = $row["kyjf"];
	if(floatval($sellnum) == 0 || floatval($sellnum) > floatval($kyjf)){
		$result = 2;
		echo $result;
		exit;
	}
}

if( curdayTrade() + $sellnum > arg_val(7) ){
	$result = 3;
	echo $result;
	exit;
}

$res2 = $db->query("INSERT INTO trades (tradetype,sellprice,sellnum,sellmoney,seller,isstatus,selltime) values(1,'".$sellprice."',$sellnum,'".$sellmoney."','".$seller."',0,'".$selltime."')");

if($res2){
	$res3 = $db->query("UPDATE salesman SET kyjf=".floatval($kyjf - $sellnum)." WHERE id=".$_SESSION["id"]);
	if($res3){
		$result = "success";
	}else{
		$result = "failure";
	}
}else{
	$result = "failure";
}

$db->close();


//================================================================================================

//返回当天交易额
function curdayTrade(){
	global $db;
	$res = $db->query("SELECT sum(sellnum) as a FROM trades WHERE isstatus=0 AND FROM_UNIXTIME(selltime,'%Y-%m-%d')=date(now())");
	if($res){
		$row = mysql_fetch_array($res);
		if(!is_null($row['a'])){
			return $row["a"];
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}

//返回GC交易总额
function arg_val($argtype){
	global $db;
	$res = $db->query("SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC limit 0,1");
	if($res){
		$row = mysql_fetch_array($res);
		return $row["val"];
	}else{
		return 0;
	}
}

echo $result;

?>