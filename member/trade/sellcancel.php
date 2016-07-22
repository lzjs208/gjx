<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$id = fstring($_GET["id"]);

$result = 0;

if($id=="" || !is_numeric($id)){
	$result = 1;
	echo $result;
	exit;	
}

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM trades WHERE id=".intval($id));
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$seller = $row["seller"];
	$sellnum = $row["sellnum"];
	$db->query("DELETE FROM trades WHERE id=".intval($id));
}else{
	$result = 1;
	echo $result;
	exit;
}

$res2 = $db->query("SELECT * FROM salesman WHERE manname='".$seller."'");
if(mysql_num_rows($res2)){
	$row2 = mysql_fetch_array($res2);
	$kyjf = $row2["kyjf"];
	$db->query("UPDATE salesman SET kyjf=".floatval($kyjf + $sellnum)." WHERE manname='".$seller."'");
	$result = 2;
}else{
	$result = 1;
	echo $result;
	exit;
}

$db->close();

echo $result;

?>
