<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$PageOfficeCtrl->setCaption("简单的给Excel赋值");	
	$sheet = $workbook->openSheet("Sheet1");//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$color = new Java("java.awt.Color");
	
	//定义Cell对象
	$cellB4 = $sheet->openCell("B4");
	//给单元格赋值
	$cellB4->setValue("1月");
	//设置字体颜色
	$cellB4->setForeColor($color->red);

	$cellC4 = $sheet->openCell("C4");
	$cellC4->setValue("300");
	$cellC4->setForeColor($color->blue);

	$cellD4 = $sheet->openCell("D4");
	$cellD4->setValue("270");
	$cellD4->setForeColor($color->orange);

	$cellE4 = $sheet->openCell("E4");
	$cellE4->setValue("270");
	$cellE4->setForeColor($color->green);

	$cellF4 = $sheet->openCell("F4");
	$cellF4->setValue(round( 270.00 / 300*100, 2)."%");
	$cellF4->setForeColor($color->gray);
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏工具栏
	$PageOfficeCtrl->setCustomToolbar(false); 

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>填出Excel表格</title>

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
