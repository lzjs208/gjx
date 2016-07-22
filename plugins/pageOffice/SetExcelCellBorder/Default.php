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
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlBorderLineStyle = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderLineStyle");
	$color = new Java("java.awt.Color");
	
	// 设置背景
	$backGroundTable = $sheet->openTable("A1:P200");
	//设置表格边框样式
	$backGroundTable->getBorder()->setLineColor($color->white);

	// 设置单元格边框样式
	$C4Border = $sheet->openTable("C4:C4")->getBorder();
	$C4Border->setWeight($xlBorderWeight->xlThick);
	$C4Border->setLineColor($color->yellow);
	$C4Border->setBorderType($xlBorderType->xlAllEdges);

	// 设置单元格边框样式
	$B6Border = $sheet->openTable("B6:B6")->getBorder();
	$B6Border->setWeight($xlBorderWeight->xlHairline);
	$B6Border->setLineColor($color->magenta);
	$B6Border->setLineStyle($xlBorderLineStyle->xlSlantDashDot);
	$B6Border->setBorderType($xlBorderType->xlAllEdges);

	//设置表格边框样式
	$titleTable = $sheet->openTable("B4:F5");
	$titleTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$titleTable->getBorder()->setLineColor($color->blue);
	$titleTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);

	//设置表格边框样式
	$bodyTable2 = $sheet->openTable("B6:F15");
	$bodyTable2->getBorder()->setWeight($xlBorderWeight->xlThick);
	$bodyTable2->getBorder()->setLineColor($color->blue);
	$bodyTable2->getBorder()->setBorderType($xlBorderType->xlAllEdges);
	
	$PageOfficeCtrl->setWriter($workbook);

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>设置表格线</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

	
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">


				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>
