<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$db = new ConnectionMYSQL();

$res = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION['id']);
if(mysql_num_rows($res)){
	$row = mysql_fetch_array($res);
	$kygc = $row["kyjf"];
	$kycny = $row["kycny"];
}

$res = $db->query("SELECT * FROM trades WHERE isstatus=0 ORDER BY selltime DESC");
if(mysql_num_rows($res)){
	while($rows = mysql_fetch_array($res)){
		$arr[] = $rows;
	}
}else{
	$arr = array();
}

$res2 = $db->query("SELECT * FROM trades WHERE seller='".$_SESSION["username"]."' AND isstatus=0 ORDER BY selltime DESC");  
if(mysql_num_rows($res2)){
	while($rows = mysql_fetch_array($res2)){
		$arr2[] = $rows;
	}
}else{
	$arr2 = array();
}

$res3 = $db->query("SELECT * FROM trades WHERE (seller='".$_SESSION["username"]."' OR buyer='".$_SESSION["username"]."') AND isstatus=1 ORDER BY selltime DESC");
if(mysql_num_rows($res3)){
	while($rows = mysql_fetch_array($res3)){
		$arr3[] = $rows;
	}
}else{
	$arr3 = array();	
}

$args = getArgs();

$argCny = "0.00000000"; $argBtc = "0.00000000"; $argLtc = "0.00000000"; $argGc = "0.00000000";

foreach($args as $v){
	if($v->argtype==1){
		$argCny = $v->val;
	}else if($v->argtype==2){
		$argBtc = $v->val;
	}else if($v->argtype==3){
		$argLtc = $v->val;
	}else if($v->argtype==4){
		$argGc = $v->val;
	}
}

//获限参数值
function arg_val($argtype){
	global $db;
	$res = $db->query("SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC limit 0,1");
	if($res){
		$row = mysql_fetch_array($res);
		return $row["val"];
	}else{
		return 0;
	}
}

//返回当天已成交GC余额
function curdayTrade(){
	global $db;
	$res = $db->query("SELECT sum(sellnum) as a FROM trades WHERE isstatus=0 AND FROM_UNIXTIME(selltime,'%Y-%m-%d')=date(now())");
	if($res){
		$row = mysql_fetch_array($res);
		if(!is_null($row["a"])){
			return $row["a"];
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}

$leftGC = arg_val(7) - curdayTrade();

$db->close();

$smarty->assign("kygc",$kygc);
$smarty->assign("kycny",$kycny);
$smarty->assign("argcny",$argCny);
$smarty->assign("sellist",$arr);
$smarty->assign("mysell",$arr2);
$smarty->assign("record",$arr3);
$smarty->assign("leftGC",$leftGC);

$smarty->display("index_t.tpl");

?>