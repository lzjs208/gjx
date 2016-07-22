<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";

$id = fstring($_GET["id"]);

if(!isset($id) || $id==""){
	$result = "failure";
	echo $result;
	exit;
}

$db = new ConnectionMYSQL();
$res = $db->query("DELETE FROM coinAddress WHERE id=".$id);
if($res){
	$result = "success";
}else{
	$result = "failure";
}

$db->close();

echo $result;

?>