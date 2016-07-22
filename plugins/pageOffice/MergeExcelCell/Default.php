<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$PageOfficeCtrl->setCaption("简单的给Excel赋值");	
	$sheet = $workbook->openSheet("Sheet1");//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$color = new Java("java.awt.Color");
	
	//合并单元格
	$sheet->openTable("B2:F2")->merge();
	$cB2 = $sheet->openCell("B2");
	$cB2->setValue("北京某公司产品销售情况");
	//设置水平对齐方式
	$cB2->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$cB2->setForeColor($color->red);
	$cB2->getFont()->setSize(16);

	$sheet->openTable("B4:B6")->merge();
	$cB4 = $sheet->openCell("B4");
	$cB4->setValue("A产品");
	//设置水平对齐方式
	$cB4->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	//设置垂直对齐方式
	$cB4->setVerticalAlignment($xlVAlign->xlVAlignCenter);

	$sheet->openTable("B7:B9")->merge();
	$cB7 = $sheet->openCell("B7");
	$cB7->setValue("B产品");
	$cB7->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$cB7->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	
	$PageOfficeCtrl->setWriter($workbook);
	
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
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>合并Excel的单元格并设置格式和赋值</title>
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
