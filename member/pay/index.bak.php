<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";
include "../../include/pageClass.php";

echo $_GET["argtype"];

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM pays WHERE paytype=4 AND payer='".$_SESSION["username"]."' ORDER BY paytime DESC");
if(mysql_num_rows($res)){
	$shownum = 15;
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM pays WHERE paytype=4 AND payer='".$_SESSION['username']."' ORDER BY paytime DESC";
	if(!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $shownum))
	$curpage = ceil($total / $shownum);
	$sql .= " LIMIT ". ($curpage - 1) * $shownum . "$shownum";
	$query = mysql_query($sql);
	
	while($rows = mysql_fetch_array($query)){
		$arr[] = $rows;
	}
}else{
	$arr[] = "";
}


$res2 = $db->query("SELECT * FROM pays WHERE paytype=3 AND payer='".$_SESSION["username"]."' ORDER BY paytime DESC");
if(mysql_num_rows($res2)){
	while($rows2 = mysql_fetch_array($res2)){
		$arr2[] = $rows2;
	}
}else{
	$arr2[] = "";
}
	
$res3 = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]."");
if(mysql_num_rows($res3)){
	$row = mysql_fetch_array($res3);
	$btcAddr = $row["BTCaddress"];
	$ltcAddr	= $row["LTCaddress"];
	$gcAddr	= $row["GCaddress"];
}

$db->close();

$page = new Page($total, $shownum, $curpage, $url, 2);

$smarty->assign("pager",$page->myde_write());
$smarty->assign("btcaddr",$btcAddr);
$smarty->assign("ltcaddr",$ltcAddr);
$smarty->assign("gcaddr",$gcAddr);
$smarty->assign("arrCny",$arr);
$smarty->assign("arrGC",$arr2);
$smarty->display("index_pay.tpl");

?>