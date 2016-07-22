<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM salesman ORDER BY addTime DESC");
if(mysql_num_rows($res)){
	while($rows = mysql_fetch_array($res)){
		$arr[] = $rows;
	}
}else{
	$arr[] = "";
}

// var_dump($arr);
echo json_encode($arr);

?>