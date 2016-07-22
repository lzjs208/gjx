<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//此行必须
    $fs->load(file_get_contents("php://input"));//此行必须
	
	java_set_file_encoding("GBK");//设置编码格式    
	
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
    $fs->saveToFile($filepath."\\doc\\".$fs->getFileName()); //保存文件
	
    echo $fs->close();//此行必须
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
