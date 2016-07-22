<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
require "../../include/pageClass.php";
include "../inc/smarty.php";

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM pays WHERE paytype=4 ORDER BY id DESC");
$arr = array();
if(mysql_num_rows($res)){
	$showrow = 15;
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM pays WHERE paytype=4 ORDER BY id DESC";
	if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
	$curpage = ceil($total / $showrow);
	$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
	$query = mysql_query($sql);
	
	while($rows = mysql_fetch_array($query)){
		$arr[] = $rows;
	}
}

$res2 = $db->query("SELECT * FROM pays WHERE paytype=3 ORDER BY id DESC");
$arr2 = array();
if(mysql_num_rows($res2)){
	$showrow = 15;
	$total2 = mysql_num_rows($res2);
	$curpage2 = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM pays WHERE paytype=3 ORDER BY id DESC";
	if(!empty($_GET['page']) && $total2 != $curpage2 > ceil($total2 / $showrow))
	$curpage2 = ceil($total2 / $showrow);
	$sql .=  " LIMIT " . ($curpage2 - 1) * $showrow . ",$showrow;";
	$query = mysql_query($sql);
	
	while($rows2 = mysql_fetch_array($query)){
		$arr2[] = $rows2;
	}
}

$db->close();

$page = new page($total, $showrow, $curpage, $url, 2);

$smarty->assign("pager",$page->myde_write());
$smarty->assign("arrCny",$arr);
$smarty->assign("arrGc",$arr2);
$smarty->display("index_pay.tpl");

?>