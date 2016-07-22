<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM salesman Where id=".$_SESSION['id']);
if(mysql_num_rows($res)){
	$rows = mysql_fetch_array($res);
	$rmb = $rows["kycny"];
	$lockrmb = $rows["buycny"];
	$btc = $rows["kybtc"];
	$lockbtc = $rows["buybtc"];
	$ltc = $rows["kyltc"];
	$lockltc = $rows["buyltc"];
	$gc	= $rows["kyjf"];
	$lockgc = $rows["buyjf"];  
}

$db->close();

$smarty->assign("rmb",$rmb);
$smarty->assign("lockrmb",$lockrmb);
$smarty->assign("btc",$btc);
$smarty->assign("lockbtc",$lockbtc);
$smarty->assign("ltc",$ltc);
$smarty->assign("lockltc",$lockltc);
$smarty->assign("gc",$gc);
$smarty->assign("lockgc",$lockgc);
$smarty->display("index_p.tpl");

?>