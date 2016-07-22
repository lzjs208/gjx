<?php
require "../inc/checksession.php";
include "../../include/mysql.class.php";
include "../../include/function.php";

$result = 0;

$arg = fstring(trim($_POST["arg"]));
$argVal = fstring(trim($_POST["val"]));
$times = strtotime("now");

if($arg=="cny"){ $arg = 1; }
if($arg=="btc"){ $arg = 2; }
if($arg=="ltc"){ $arg = 3; }
if($arg=="up"){ $arg = 4; }
if($arg=="amount"){ $arg = 5; }
if($arg=="cost"){ $arg = 6; }
if($arg=="gc"){ $arg = 7; }

if(($arg != 5) && strlen(intval($argVal)) > 12){
	$result = 1;
	echo $result;
	exit;
}

if(($arg != 5) && (!format_float($argVal) || $argVal=="" || is_null($argVal))){
	$result = 1;
	echo $result;
	exit;
}

if( ($arg == 5 || $arg == 6) && !is_numeric($argVal) || $argVal == 0 ){
	$result = 1;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
if($arg == 5 || $arg == 6){
	$db->query("INSERT INTO args (times,val2,argtype) values($times,$argVal,$arg)");
}else{
	$db->query("INSERT INTO args (times,val,argtype) values($times,$argVal,$arg)");
}

$db->close();

$result = 2;
echo $result;

?>