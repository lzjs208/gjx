<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	//创建数据区域，createDataRegion 方法中的三个参数分别代表“新建的数据区域名称”，“数据区域将要插入的位置”，
	//“与新建的数据区域相关联的数据区域名称”，若当前Word文档中尚无数据区域（书签）或者想在文档的最开头创建时，那么第三个参数为“[home]”
	//若想在文档的结尾处创建数据区域则第三个参数为“[end]”
	$dataRegion1 =  $doc->createDataRegion("reg1",$dataRegionInsertType->After,"[home]");
	//设置创建的数据区域的可编辑性
	$dataRegion1->setEditing(true);
	//给数据区域赋值
	$dataRegion1->setValue("第一个数据区域\r\n");
	
	$dataRegion2 = $doc->createDataRegion("reg2",$dataRegionInsertType->After,"reg1");
	$dataRegion2->setEditing(true);
	$dataRegion2->setValue("第二个数据区域");
	
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
		<title>新建数据区域</title>

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
