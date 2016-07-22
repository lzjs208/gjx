<?php
require "../inc/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
require "../../include/pageClass.php";
include "../inc/smarty.php";

$db = new ConnectionMYSQL();

$arr = array();
$res = $db->query("SELECT * FROM article ORDER BY pubdate DESC");
if($res){
	$showrow = 15;
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM article ORDER BY pubdate DESC";
	if(!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
	$curpage = ceil($total / $showrow);
	$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
	$query = mysql_query($sql);

	while($rows = mysql_fetch_array($query)){
		$arr[] = $rows;
	}
}else{
	$arr = array();
}

$page = new Page($total, $showrow, $curpage, $url, 2);

$db->close();

$smarty->assign("pager",$page->myde_write());
$smarty->assign("artlist",$arr);
$smarty->display("index_article.tpl");

?>