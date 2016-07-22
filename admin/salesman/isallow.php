<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

//************************
//1：设置成功 						**
//0：设置不成功						**
// ***********************

$id = fstring(trim($_GET["id"]));

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM salesman WHERE id=".intval($id));
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$isallow = $row["isallow"];
	if($isallow==0){
		$db->query("UPDATE salesman SET isallow=1 WHERE id=".intval($id));
		$result = 1;
	}elseif($isallow==1){
		$db->query("UPDATE salesman SET isallow=0 WHERE id=".intval($id));
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