<?php
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("PRC");

define( "APP_PATH",str_replace("\\", "/",realpath(dirname(__FILE__)."/")) );
define( "APP_ADM",dirname(__FILE__)."/../admin");

session_save_path( str_replace("\\","/",APP_PATH."/../session") );
start_session(3600);

function start_session($expire = 0){
	if($expire == 0){
		$expire = ini_get("session.gc_maxlifetime");
	}else{
		ini_set("session.gc_maxlifetime", $expire);
	}
	if(empty($_COOKIE["PHPSESSID"])){
		session_set_cookie_params($expire);
		session_start();
	}else{
		session_start();
		setcookie("PHPSESSID", session_id(), time() + $expire);
	}
}

function getArgs(){
	$db = new ConnectionMYSQL();
	$res = $db->query("SELECT * FROM (SELECT * FROM args order by times desc) as a GROUP BY argtype ORDER BY times DESC");
	if(mysql_num_rows($res)){
		while($rows = mysql_fetch_object($res)){
			$arrArg[] = $rows;
		}
	}else{
		$arrArg[] = array();
	}
	return $arrArg;
}
?>