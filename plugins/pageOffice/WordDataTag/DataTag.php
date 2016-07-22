<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$color = new Java("java.awt.Color");
	//定义DataTag对象
	$deptTag = $doc->openDataTag("{部门名}");
	//给DataTag对象赋值
	$deptTag->setValue("B部门");
	$deptTag->getFont()->setColor($color->GREEN);
	
	$userTag = $doc->openDataTag("{姓名}");
	$userTag->setValue("李四");
	$userTag->getFont()->setColor($color->GREEN);
	
	$dateTag = $doc->openDataTag("【时间】");
	date_default_timezone_set("Asia/Shanghai");
	$dateTag->setValue(date("Y-m-d h:i:s")."");
	$dateTag->getFont()->setColor($color->BLUE);
	
    $PageOfficeCtrl->setWriter($doc);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test2.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>

    <title>My JSP 'DataTag.jsp' starting page</title>
    
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
    <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
  </body>
</html>
