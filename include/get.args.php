<?php
require "mysql.class.php";
include "function.php";

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM args WHERE argtype=".$_GET['id']." ORDER by times");
if(mysql_num_rows($res)){
	while($rows = mysql_fetch_object($res)){
		$val = $rows->val;
		$times = $rows->times;
		$arrArg[] = array(floatval($times*1000),floatval($val));
	}
}else{
	$arrArg[] = array();
}

$result = json_encode($arrArg);
echo $result;

?>