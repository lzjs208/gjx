<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
require "../../include/pageClass.php";
include "../inc/smarty.php";

$arg = empty($_GET['arg']) ? "" : $_GET['arg'];

$url = "?page={page}&arg=".$arg;

function getArglist($argtype=0){
	$showrow = 15;
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$db = new ConnectionMYSQL();
	$res = $db->query("SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC");
	if(mysql_num_rows($res)){
		$total = mysql_num_rows($res);
		$sql = "SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC";
		if(!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow));
		$curpage = ceil($total / $showrow);
		$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
		$query = mysql_query($sql);

		while($rows = mysql_fetch_array($res)){
			$arr[] = $rows;
		}
	}else{
		$arr = array();
	}
	return $arr;
	$db->close();
}

//$page = new page($total, $showrow, $curpage, $url, 2);
//$smarty->assign("pager",$page->myde_write());

$smarty->assign("cny",getArglist(1));
$smarty->assign("btc",getArglist(2));
$smarty->assign("ltc",getArglist(3));
$smarty->assign("up",getArglist(4));
$smarty->assign("amount",getArglist(5));
$smarty->assign("cost",getArglist(6));
$smarty->assign("gc",getArglist(7));
		
$smarty->display("index_a.tpl");

?>