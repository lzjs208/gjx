<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
require "../../include/pageClass.php";
require "../inc/smarty.php";

$db = new ConnectionMYSQL();

$total = 0;
$showrow = 15;
$curpage = 0;
$url = "?page={page}";

$res = $db->query("SELECT * FROM trades WHERE tradetype=1 ORDER BY selltime DESC");
if(mysql_num_rows($res)){
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$sql = "SELECT * FROM trades WHERE tradetype=1 ORDER BY selltime DESC";
	if(!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
	$curpage = ceil($total / $showrow);
	$sql .= " LIMIT ". ($curpage - 1) * $showrow . ",$showrow;";
	$query = mysql_query($sql);
	
	while($rows = mysql_fetch_array($query)){
		$arr[] = $rows;
	}
}else{
	$arr = array();
}

$page = new page($total, $showrow, $curpage, $url, 2);

$smarty->assign("pager",$page->myde_write());
$smarty->assign("cnyTrade",$arr);
$smarty->display("index_t.tpl");

?>