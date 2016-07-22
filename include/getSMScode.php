<?php
require "config.php";
include "function.php";

$email = fstring(trim($_GET["email"]));

// session_start();

$code = general_num(6);

require("class.phpmailer.php");

$_SESSION["emailcode"] = $code;

if ($_SESSION["emailcode"] == "" || !isset($_SESSION["emailcode"])){
	$result = "failure";
	echo $result;
	die;
}

postEmail($email,"","天合积分","找回密码：验证码",$code);

//===========================================================
function postEmail($to, $toName="", $from="", $subject="", $body=""){
	$mail = new PHPMailer(); //建立邮件发送类
// 	$address = "154671642@qq.com";
	$mail->IsSMTP(); // 使用SMTP方式发送
	$mail->CharSet="UTF-8";// 设置邮件的字符编码
	$mail->Host = "smtp.vip.163.com";
	$mail->SMTPAuth = true; // 启用SMTP验证功能
	$mail->Port = "25";
	$mail->Username = "tianheb@vip.163.com";
	$mail->Password = "usoyiwyhnozvquca"; // 邮局密码
	$mail->From = "tianheb@vip.163.com"; //邮件发送者email地址
	$mail->FromName = $from;
	$mail->AddAddress($to, $toName);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
// 	$mail->AddReplyTo("", "");
// 	$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
// 	$mail->IsHTML(true); // set esmail format to HTML //是否使用HTML格式
	$mail->Subject = $subject;
	$mail->Body = $body;
// 	$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
	if(!$mail->Send())
	{
// 		echo "邮件发送失败. <p>";
// 		echo "错误原因: " . $mail->ErrorInfo;
		$result = "failure";
	}else{
		$result = "success";
// 	echo "邮件发送成功";
	}

	return $result;
}
?>