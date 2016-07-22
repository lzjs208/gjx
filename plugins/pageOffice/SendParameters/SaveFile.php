<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//此行必须
    $fs->load(file_get_contents("php://input"));//此行必须
	
	java_set_file_encoding("GBK");//设置编码格式    
	
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
    $fs->saveToFile($filepath."\\doc\\".$fs->getFileName()); //保存文件
	
	$id = 0;
	$userName = "";
	$age = 0;
	$sex = "";

	//获取通过Url传递过来的值
	$id = $_REQUEST["id"];

	//获取通过网页标签控件传递过来的参数值，注意$fs->getFormField("参数名")方法中的参数名是值标签的“name”属性而不是Id

	//获取通过文本框<input type="text" />标签传递过来的值
	$userName = java_values($fs->getFormField("userName"));

	//获取通过隐藏域传递过来的值
	$age = java_values($fs->getFormField("age"));

	//获取通过<select>标签传递过来的值
	$sex = java_values($fs->getFormField("selSex"));
	
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("doc/demo_param.mdb");
	$conn->Open($connstr);  
   
	$query = "Update Users set UserName = '".$userName."', age = ".$age.",sex = '".$sex."' where id = ".$id;
	$result = $conn->Execute($query);  
   
	if($result)  
		echo   "更新数据成功";  
	else
	echo   "更新数据失败";  

	$fs->showPage(300, 200);
    echo $fs->close();//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'SaveFile.jsp' starting page</title>

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
<div>
    传递的参数为：<br />
    id:<?php echo $id;?><br />
    userName:<?php echo $userName;?><br />
    age:<?php echo $age;?><br />
    sex:<?php echo $sex;?><br />
    </div>
	</body>
</html>
