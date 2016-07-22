<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：设置成功		 					**
//2：会员处于登陆状态			**
//0：设置不成功						**
// ***********************

$id = fstring(trim($_GET["id"]));

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM admuser WHERE id=".intval($id));
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	if(intval($_SESSION["admid"])==intval($id)){
		$result = 2;
		echo $result;
		exit;
	}
	$isallow = $row["isallow"];
	if($isallow==0){
		$db->query("UPDATE admuser SET isallow=1 WHERE id=".intval($id));
		$result = 1;
	}elseif($isallow==1){
		$db->query("UPDATE admuser SET isallow=0 WHERE id=".intval($id));
		$result = 1;
	}
}else{
	$result = 0;
	echo $result;
	exit;
}

$db->close();

echo $result;
?>