<?php
require "../login/checksession.php";
require "../../include/mysql.class.php";
include "../../include/function.php";
include "../../include/fileUpload.class.php";
  
$up = new fileupload;
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
$up -> set("path", "../../files/uploadfiles/");
$up -> set("maxsize", 200000000000);
$up -> set("allowtype", array("gif", "png", "jpg", "jpeg"));
$up -> set("israndname", true);

$payname		= cn_fstring(trim($_POST["payname"]));
$payamount	= fstring(trim($_POST["payamount"]));
$paytime		= fstring(trim($_POST["paytime"]));
$paytime		= strtotime($paytime);
$memo				= fstring(trim($_POST["memo"]));
$now 		= strtotime('now');

// var_dump($up->upload("pic"));

if($payname=="" || is_null($payname)){
	showPop("信息填写不完整！");
	exit;
}

if($up->upload("pic")){
	$filePath = $up->getFilePath().$up->getFileName();
// 	echo $filePath;
}else{
	showPop("文件上传错误，请重新上传！");
	exit;
}

$db = new ConnectionMYSQL();
$db->query("INSERT INTO pays (paytype,paytime,payer,payname,paymoney,picUrl,memo,paystatus,addtime) values(4,'".$paytime."','".$_SESSION['username']."','".$payname."',".$payamount.",'".$filePath."','".$memo."',1,'".$now."')");

backUrl("汇款充值成功，审核成功后款汇款打打入您的帐户上！","../pay");

$db->close();

?>