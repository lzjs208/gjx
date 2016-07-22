<?php
require "../inc/checksession.php";
include "../../include/mysql.class.php";
include "../../include/function.php";

$result = 0;

$id = fstring($_GET["id"]);

if(!isset($id) || $id==""){
	$result = 1;
	echo $result;
	exit;
}
$id = intval($id);

$db = new ConnectionMYSQL();
$db->query("DELETE FROM args WHERE id=".$id);

$db->close();

$result = 2;

echo $result;
?>