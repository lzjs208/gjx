<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM coinAddress WHERE cointype=4 AND coin_man='".$_SESSION["username"]."'");
$arr = array();
if(mysql_num_rows($res)){
	while($rows = mysql_fetch_array($res)){
		$arr[] = $rows;
	}
}

// var_dump($arr);

$db->close();

$smarty->assign("cny",$arr);
$smarty->display("index_coin.tpl");

?>