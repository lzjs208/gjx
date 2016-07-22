<?php 
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/smarty.php";

$user = $_SESSION["username"];

$db = new ConnectionMYSQL();
$res = $db->query("SELECT * FROM salesman WHERE id=".$_SESSION["id"]);
if(mysql_num_fields($res)){
	$row = mysql_fetch_array($res);
	if($row["safepws"]=="" || is_null($row["safepws"])){ $safepass="<p>未设置</p>"; $safemodi="<button data-toggle=modal data-target=#setsafe class=nomodi>设置</button>"; } else { $safepass="<p class=ready>已设置</p>"; $safemodi="<button data-toggle=modal data-target=#setsafe>修改</button>"; }
	if($row["phone"]=="" || is_null($row["phone"])){ $phone="<p>未设置</p>"; $phonemodi="<button data-toggle=modal data-target=#setphone class=nomodi>设置</button>"; } else { $phone="<p class=ready>已设置</p>"; $phonemodi="<button data-toggle=modal data-target=#setphone>修改</button>"; }
	if($row["email"]=="" || is_null($row["email"])){ $email="<p>未设置</p>"; $emailmodi="<button data-toggle=modal data-target=#setemail class=nomodi>设置</button>"; } else { $email="<p class=ready>已设置</p>"; $emailmodi="<button data-toggle=modal data-target=#setemail>修改</button>"; }
	if($row["pws"]=="" || is_null($row["pws"])){ $pass="<p>未设置</p>"; $passmodi="<button data-toggle=modal data-target=#setpws class=nomodi>设置</button>"; } else { $pass="<p class=ready>已设置</p>"; $passmodi="<button data-toggle=modal data-target=#setpws>修改</button>"; }
	$myemail = $row["email"];
}

$db->close();

$smarty->assign("user",$user);
$smarty->assign("safepass",$safepass);
$smarty->assign("phone",$phone);
$smarty->assign("email",$email);
$smarty->assign("pass",$pass);
$smarty->assign("safem",$safemodi);
$smarty->assign("phonem",$phonemodi);
$smarty->assign("emailm",$emailmodi);
$smarty->assign("passm",$passmodi);
$smarty->assign("myemail",$myemail);
$smarty->assign("userid",$_SESSION["id"]);

$smarty->display("index_s.tpl");

?>