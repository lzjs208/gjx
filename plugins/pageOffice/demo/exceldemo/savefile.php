<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//���б���
    $fs->load(file_get_contents("php://input"));//���б���
	
	java_set_file_encoding("GBK");//���ñ����ʽ    
	
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
    $fs->saveToFile($filepath."\\doc\\".$fs->getFileName()); //�����ļ�
	
    echo $fs->close();//���б���
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
	</head>
	<body>
		<form id="form1">
			<div>

			</div>
		</form>
	</body>
</html>
