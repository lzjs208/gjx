<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	java_set_file_encoding("GBK");

	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));

    $bytes = null;
	$filePath = "";
	$userName = $_REQUEST["userName"];
	if (isset($userName) && !empty($userName) && strcasecmp($userName, "zhangsan")==0) {
		$bytes = $doc->openDataRegion("PO_com1")->getFileBytes();
		$filePath = "content1.doc";
	} else {
		$bytes = $doc->openDataRegion("PO_com2")->getFileBytes();
		$filePath = "content2.doc";
	}
	
	//$doc->showPage(600, 300);
	echo $doc->close();
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]))."\\doc\\".$filePath;
	//echo "filePath====".$filepath;
	$outputStream = new Java("java.io.FileOutputStream", $filepath);
	//echo strlen($bytes);
	$outputStream->write($bytes);
	$outputStream->flush();
	$outputStream->close();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>登录页面</title>
	</head>
	<body>

	</body>

</html>
