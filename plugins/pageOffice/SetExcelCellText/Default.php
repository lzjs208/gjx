<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$wb = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$PageOfficeCtrl->setCaption("简单的给Excel赋值");	
	$sheet = $wb->openSheet("Sheet1");//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$color = new Java("java.awt.Color");
	
	$cC3 = $sheet->openCell("C3");
	//设置单元格背景样式
	$cC3->setBackColor($color->LIGHT_GRAY);
	$cC3->setValue( "一月");
	$cC3->setForeColor($color->white);
	$cC3->setHorizontalAlignment($xlHAlign->xlHAlignCenter);

	$cD3 = $sheet->openCell("D3");
	//设置单元格背景样式
	$cD3->setBackColor( $color->lightGray);
	$cD3->setValue( "二月");
	$cD3->setForeColor($color->white);
	$cD3->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cE3 = $sheet->openCell("E3");
	//设置单元格背景样式
	$cE3->setBackColor( $color->lightGray);
	$cE3->setValue( "三月");
	$cE3->setForeColor($color->white);
	$cE3->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB4 = $sheet->openCell("B4");
	//设置单元格背景样式
	$color2 = new Java("java.awt.Color", 10,254,254);
	$cB4->setBackColor( $color2);
	$cB4->setValue( "住房");
	$color3 = new Java("java.awt.Color", 10,150,150);
	$cB4->setForeColor( $color3);
	$cB4->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB5 = $sheet->openCell("B5");
	//设置单元格背景样式
	$cB5->setBackColor( $color3);
	$cB5->setValue( "三餐");
	$color4 = new Java("java.awt.Color", 10,100,250);
	$cB5->setForeColor( $color4);
	$cB5->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB6 = $sheet->openCell("B6");
	//设置单元格背景样式
	$color5 = new Java("java.awt.Color", 200,200,100);
	$cB6->setBackColor($color5);
	$cB6->setValue( "车费");
	$cB6->setForeColor($color3);
	$cB6->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB7 = $sheet->openCell("B7");
	//设置单元格背景样式
	$color6 = new Java("java.awt.Color", 80,50,80);
	$cB7->setBackColor($color6);
	$cB7->setValue( "通讯");
	$cB7->setForeColor( $color3);
	$cB7->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	//绘制表格线
	$titleTable = $sheet->openTable("B3:E10");
	$titleTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$color7 = new Java("java.awt.Color", 0, 128, 128);
	$titleTable->getBorder()->setLineColor($color7);
	$titleTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);

	$sheet->openTable("B1:E2")->merge();//合并单元格
	$sheet->openTable("B1:E2")->setRowHeight( 30);//设置行高
	$B1 = $sheet->openCell("B1");
	//设置单元格文本样式
	$B1->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$B1->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$B1->setForeColor( $color7);
	$B1->setValue( "出差开支预算");
	$B1->getFont()->setBold(true);
	$B1->getFont()->setSize(25);
	
	$PageOfficeCtrl->setWriter($wb);

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>设置字体和背景色</title>
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
