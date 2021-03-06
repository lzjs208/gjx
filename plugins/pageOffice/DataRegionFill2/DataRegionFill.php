<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//打开数据区域
	$dataRegion1 = $doc->openDataRegion("PO_userName");
	//给数据区域赋值
	$dataRegion1->setValue("张三");
	//设置字体样式
	$color = new Java("java.awt.Color");
    $dataRegion1->getFont()->setColor($color->blue);
    $dataRegion1->getFont()->setSize(24);
    $dataRegion1->getFont()->setName("隶书");
    $dataRegion1->getFont()->setBold(true);

	$dataRegion2 = $doc->openDataRegion("PO_deptName");
	$dataRegion2->setValue("销售部");
	$dataRegion2->getFont()->setColor($color->red);
	
	$PageOfficeCtrl->setWriter($doc);
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏工具栏
	$PageOfficeCtrl->setCustomToolbar(false);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>简单的给Word文档中的数据区域赋值</title>

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
		<div style="width: auto; height: 700px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
