<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$db = new ConnectionMYSQL();

$arr = array();
$res = $db->query("SELECT * FROM pays WHERE paytype=4 AND payer='".$_SESSION["username"]."' ORDER BY id DESC");
if(mysql_num_rows($res)){
	while($rows = mysql_fetch_array($res)){
		$arr[] = $rows;
	}
}

$arr2 = array();
$res2 = $db->query("SELECT * FROM pays WHERE paytype=3 AND payer='".$_SESSION["username"]."' ORDER BY id DESC");
if(mysql_num_rows($res2)){
	while($rows2 = mysql_fetch_array($res2)){
		$arr2[] = $rows2;
	}
}

$res3 = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]."");
if(mysql_num_rows($res3)){
	$row3 = mysql_fetch_array($res3);
	$btcAddr = $row3["BTCaddress"];
	$ltcAddr	= $row3["LTCaddress"];
	$gcAddr	= $row3["GCaddress"];
}

$db->close();

$smarty->assign("btcaddr",$btcAddr);
$smarty->assign("ltcaddr",$ltcAddr);
$smarty->assign("gcaddr",$gcAddr);
$smarty->assign("arrCny",$arr);
$smarty->assign("arrGc",$arr2);
$smarty->display("index_pay.tpl");

?>