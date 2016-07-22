<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：购买成功 						**
//2：参数不正确 						**
//3：不能购买自己的委托单		**
//4：可用余额不足					**
//5：交易额达到上限				**
// ***********************

$result = 0;

$id = fstring($_GET["id"]);

if($id=="" || !is_numeric($id)){
	$result = 2;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]);
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$kycny = $row["kycny"];
	$kyjf = $row["kyjf"];
}

$res = $db->query("SELECT * FROM trades WHERE id=".intval($id));
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$buynum = $row["sellnum"];
	$buymoney = $row["sellmoney"];
	$tradetime = strtotime("now");
	$seller = $row["seller"];

	if($seller == $_SESSION["username"]){
		$result = 3;
		echo $result;
		exit;
	}else if($kycny < $buymoney){
		$result = 4;
		echo $result;
		exit;
	}else{
		$res2 = $db->query("SELECT * FROM salesman WHERE manname='".$seller."'");
		$row2 = mysql_fetch_array($res2);
		$sell_kycny = $row2["kycny"];
		$db->query("UPDATE trades SET buyer='".$_SESSION["username"]."',buynum=".$buynum.",buymoney=".$buymoney.",traded=".$buynum.",isstatus=1,tradetime='".$tradetime."' WHERE id=".intval($id));
		$db->query("UPDATE salesman SET kycny=".floatval($kycny-$buymoney).",kyjf=".floatval($kyjf+$buynum)." WHERE id=".$_SESSION["id"]);
		$db->query("UPDATE salesman SET kycny=".floatval($sell_kycny+$buymoney)." WHERE manname='".$seller."'");
		$result = 1;
	}
}else{
	$result = 2;
}

$db->close();

echo $result;

?>