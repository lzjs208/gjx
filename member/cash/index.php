<?php
require "../login/checksession.php"; 
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$db = new ConnectionMYSQL();

$arg_cost		= arg_val(6,2);
$arg_amount = arg_val(5,2);
$arg_gc			= arg_val(4,1);
$arg_ltc		= arg_val(3,1);
$arg_btc		= arg_val(2,1);
$arg_cny		= arg_val(1,1);


$res2 = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]);
if(mysql_num_rows($res2)){
	$row2 = mysql_fetch_array($res2);
	$kycny = $row2["kycny"];
	$email = $row2["email"];
}

$res3 = $db->query("SELECT * FROM cashes WHERE casher='".$_SESSION["username"]."' AND cashtype=4 ORDER BY cashtime DESC");
$cnylist = array();
if(mysql_num_rows($res3)){
	while($rows3 = mysql_fetch_array($res3)){
		$cnylist[] = $rows3;
	}
}else{
	$cnylist = array();
}

if(!isset($arg_gc)){
	$arg_gc = 0;
}
if(!isset($arg_btc)){
	$arg_btc = 0;
}
if(!isset($arg_ltc)){
	$arg_ltc = 0;
}
if(!isset($arg_cny)){
	$arg_cny = 0;
}

$cash_cny = floatval($arg_gc * $arg_cny);
$cash_btc = floatval($arg_gc * $arg_btc);
$cash_ltc = floatval($arg_gc * $arg_ltc);

$db->close();

$smarty->assign("cash_cny",$cash_cny);
$smarty->assign("cash_btc",$cash_btc);
$smarty->assign("cash_ltc",$cash_ltc);
$smarty->assign("cash_amount",$arg_amount);		//提现总额
$smarty->assign("cash_gc",$arg_gc);						//单日提现GC
$smarty->assign("cash_cost",$arg_cost);				//提现手续费
$smarty->assign("email",$email);
$smarty->assign("kycny",$kycny);
$smarty->assign("cnylist",$cnylist);
$smarty->display("index_c.tpl");


//===============================================================

function arg_val($argtype,$v){
	global $db;
	$res = $db->query("SELECT * FROM args WHERE argtype=$argtype ORDER BY times DESC limit 0,1");
	if($res){
		$row = mysql_fetch_array($res);
		if($v == 1 && !is_null($row["val"])){
			return $row["val"];
		}elseif($v == 2 && !is_null($row["val"])){
			return $row["val2"];
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}

?>