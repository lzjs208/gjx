<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//���б���
    $fs->load(file_get_contents("php://input"));//���б���
	
	java_set_file_encoding("GBK");//���ñ����ʽ    
	$id = $_GET["id"];
	$err = "";
	if ( isset($id) && !empty($id) && strlen($id)>0 )  {
		$fileName = "\\maker".$id.$fs->getFileExtName();
		$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
		$fs->saveToFile($filepath."\\doc\\".$fileName);//�����ļ�
	}else{
		$err = "<script>alert('δ����ļ�����');</script>";
	}
	
    echo $fs->close();//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>


		<title>My JSP 'SaveMaker.php' starting page</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

	</head>

	<body>
		<?php echo $err;?>
	</body>
</html>
