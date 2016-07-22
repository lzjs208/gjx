<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/pageClass.php";

$id = empty($_GET["id"]) ? 4 : $_GET["id"];

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM pays WHERE paytype=".intval($id)." AND payer='".$_SESSION["username"]."' ORDER BY paytime DESC");
if(mysql_num_rows($res)){
	$shownum = 2;
	$total = mysql_num_rows($res);
	$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
	$url = "?page={page}";
	$sql = "SELECT * FROM pays WHERE paytype=".intval($id)." AND payer='".$_SESSION['username']."' ORDER BY paytime DESC";
	if(!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $shownum))
	$curpage = ceil($total / $shownum);
	$sql .= " LIMIT ". ($curpage - 1) * $shownum . "$shownum";
	$query = mysql_query($sql);
	$totalPages = ceil($total / $shownum);
	
	while($rows = mysql_fetch_object($query)){
		$id = $rows->id;
		$payer = $rows->payer;
		$payname = $rows->payname;
		$paymoney = $rows->paymoney;
		$picUrl	= $rows->picUrl;
		$transfer = $rows->transfer;
		$paytime = date("Y-m-d",$rows->paytime);
		$paytime2 = date("Y-m-d H:i:s",$rows->paytime);
		if($rows->paystatus==1){
			$status = "充值中";
		}elseif($rows->paystatus==2){
			$status = "充值成功";
		}
		$arr['list'] = array("id"=>$id,"payer"=>$payer,"transfer"=>$transfer,"payname"=>$payname,"paymoney"=>$paymoney,"picurl"=>$picUrl,"paytime"=>$paytime,"paytime2"=>$paytime2,"status"=>$status);
	}
}else{
	$shownum = 15;
	$total = 0;
	$curpage = 1;
	$url = "?page={page}";
	$arr['list'] = array();
}

$page['page'] = array("totalpage"=>$totalPages);

$arrMerge = array_merge($arr,$page);

$result = json_encode($arrMerge);

echo $result;

?>