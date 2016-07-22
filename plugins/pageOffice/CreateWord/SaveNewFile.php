<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//此行必须
    $fs->load(file_get_contents("php://input"));//此行必须	
	java_set_file_encoding("GBK");//设置编码格式 

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("doc/demo_creword.mdb");
	$conn->Open($connstr);  
   
	$query = "select Max(ID) from word";
	$result = $conn->Execute($query);  
	$newID = 1;
	if(!$result->EOF)
	{
		$newID = (int)($result->Fields(0)->value) + 1;
	}

	
	$FileSubject = trim(java_values($fs->getFormField("FileSubject")));
	$fileName = "aabb".$newID.".doc"; 
	$getFile = $_REQUEST["FileSubject"];
	if (isset($getFile) && !empty($getFile) && strlen(trim($getFile))>0){
		$FileSubject = $getFile;
		//print($FileSubject);
	}
	$strsql = "Insert into word(ID,FileName,Subject,SubmitTime) values("
			.$newID
			.",'"
			.$fileName
			."','"
			.$FileSubject
			."','"
			.date("Y-m-d h:i:sa")."')";
	
	$result = $conn->Execute($strsql);  
    //操作执行成功
	if($result){ 
		//保存文件
		$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
		$fs->saveToFile($filepath."\\doc\\".$fileName); //保存文件
		//设置保存结果
		$fs->setCustomSaveResult("ok"); 
	}
	else{
		echo "保存失败"; 
	}	

	//$fs->showPage(300,300);
    echo $fs->close();//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'SaveNewFile.jsp' starting page</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">

	</head>

	<body>
		<br>
	</body>
</html>
