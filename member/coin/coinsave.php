<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$addname	= cn_fstring(trim($_POST["name"]));
$addcard	= fstring(trim($_POST["card"]));
$addbank	= cn_fstring(trim($_POST["bank"]));
$bankaddr = cn_fstring(trim($_POST["addr"]));
$ctype		= fstring(trim($_POST["ctype"]));
$memo 		= cn_fstring(trim($_POST["memo"]));
$addtime	= strtotime("now");

if(!isset($addname) || $addname=="" || !isset($addcard) || $addcard=="" || !isset($addbank) || $addbank=="" || !isset($bankaddr) || $bankaddr==""){
	$result = 1;
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$res = $db->query("INSERT INTO coinAddress (cointype,coin_man,cny_addname,cny_card,cny_bank,cny_bankaddress,memo,addtime) values(".$ctype.",'".$_SESSION["username"]."','".$addname."','".$addcard."','".$addbank."','".$bankaddr."','".$memo."','".$addtime."')");

$db->close();

$result = 2;

echo $result;

?>