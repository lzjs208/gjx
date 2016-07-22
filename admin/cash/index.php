<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
require "../../include/pageClass.php";
include "../inc/smarty.php";


$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM cashes WHERE cashtype=4 ORDER BY cashtime DESC");
$arr = array();
if(mysql_num_rows($res)){
	$showrow = 15;
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM cashes WHERE cashtype=4 ORDER BY cashtime DESC";
	if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
	$curpage = ceil($total / $showrow); //当前页数大于最后页数，取最后一页
	$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
	$query = mysql_query($sql);
	
	while($rows = mysql_fetch_array($query)){
		$arr[] = $rows;
	}
}else{
	$arr[] = "";
}

$db->close();

$page = new page($total, $showrow, $curpage, $url, 2);

$smarty->assign("pager",$page->myde_write());
$smarty->assign("arrCny",$arr);
$smarty->display("index_c.tpl");

?>