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
$res = $db->query("SELECT * FROM cashes WHERE id=".$id);
if($res){
	$row = mysql_fetch_array($res);
	$casher = $row["casher"];
	$cashmoney = $row["cashmoney"];
	$db->query("UPDATE cashes SET cashstatus=2 WHERE id=".$id);
	$res2 = $db->query("SELECT * FROM salesman WHERE manname='".$casher."'");
	if($res2){
		$row2 = mysql_fetch_array($res2);
		$kycny = $row2["kycny"];
		$db->query("UPDATE salesman SET kycny=".(floatval($kycny)-floatval($cashmoney))." WHERE manname='$casher'");
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