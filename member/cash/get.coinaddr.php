<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$id = fstring(trim($_GET["id"]));

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM coinaddress WHERE cointype=".intval($id)." AND coin_man='".$_SESSION["username"]."'");
if(mysql_num_rows($res)){
	$str = "<select id='bank_sel'><option value=''>请选择一个银行卡</option>";
	while($rows = mysql_fetch_object($res)){
		$card = $rows->cny_card;
		$bank = $rows->cny_bank;
		$str .= "<option value=".$rows->id.">".$card."&nbsp;".$bank."</option>";
	}
	$str .= "</select>";
}else{
	$str = "<select id='bank_sel'><option value=''>请选择一个银行卡</option></select>";
}

echo $str;

?>