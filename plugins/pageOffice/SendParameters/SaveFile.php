<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	$fs = new Java("com.zhuozhengsoft.pageoffice.FileSaverPHP");//���б���
    $fs->load(file_get_contents("php://input"));//���б���
	
	java_set_file_encoding("GBK");//���ñ����ʽ    
	
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
    $fs->saveToFile($filepath."\\doc\\".$fs->getFileName()); //�����ļ�
	
	$id = 0;
	$userName = "";
	$age = 0;
	$sex = "";

	//��ȡͨ��Url���ݹ�����ֵ
	$id = $_REQUEST["id"];

	//��ȡͨ����ҳ��ǩ�ؼ����ݹ����Ĳ���ֵ��ע��$fs->getFormField("������")�����еĲ�������ֵ��ǩ�ġ�name�����Զ�����Id

	//��ȡͨ���ı���<input type="text" />��ǩ���ݹ�����ֵ
	$userName = java_values($fs->getFormField("userName"));

	//��ȡͨ�������򴫵ݹ�����ֵ
	$age = java_values($fs->getFormField("age"));

	//��ȡͨ��<select>��ǩ���ݹ�����ֵ
	$sex = java_values($fs->getFormField("selSex"));
	
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("doc/demo_param.mdb");
	$conn->Open($connstr);  
   
	$query = "Update Users set UserName = '".$userName."', age = ".$age.",sex = '".$sex."' where id = ".$id;
	$result = $conn->Execute($query);  
   
	if($result)  
		echo   "�������ݳɹ�";  
	else
	echo   "��������ʧ��";  

	$fs->showPage(300, 200);
    echo $fs->close();//���б���
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
    ���ݵĲ���Ϊ��<br />
    id:<?php echo $id;?><br />
    userName:<?php echo $userName;?><br />
    age:<?php echo $age;?><br />
    sex:<?php echo $sex;?><br />
    </div>
	</body>
</html>
