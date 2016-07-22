<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$id = fstring(trim($_GET["id"]));

$result = 0;

if(!isset($id) || $id==""){
	$result = 1;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM pays WHERE id=".$id);
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$payer = $row["payer"];
	$paymoney = $row["paymoney"];
	$db->query("UPDATE pays SET paystatus=2 WHERE id=".$id);
	$res2 = $db->query("SELECT * FROM salesman WHERE manname='$payer'");
	if(mysql_num_rows($res2)){
		$row2 = mysql_fetch_array($res2);
		$kycny = $row2["kycny"];
		$db->query("UPDATE salesman SET kycny=".(floatval($kycny) + floatval($paymoney))." WHERE manname='$payer'");
		$result = 2;
	}else{
		$result = 1;
		echo $result;
		exit;
	}
}else{
	$result = 1;
	echo $result;
	exit;
}

$db->close();

echo $result;

?>