
<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$wb = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$color = new Java("java.awt.Color");
	$color2 = new Java("java.awt.Color", 0, 128, 128);
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlBorderLineStyle = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderLineStyle");
	
	// 设置背景
	$backGroundTable = $wb->openSheet("Sheet1")->openTable("A1:P200");
	$backGroundTable->getBorder()->setLineColor($color->white);

	// 设置标题
	$wb->openSheet("Sheet1")->openTable("A1:H2")->merge();
	$wb->openSheet("Sheet1")->openTable("A1:H2")->setRowHeight(30);
	$A1 = $wb->openSheet("Sheet1")->openCell("A1");
	$A1->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$A1->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$A1->setForeColor($color2);
	$A1->setValue("出差开支预算");
	
	//设置字体
	$wb->openSheet("Sheet1")->openTable("A1:A1")->getFont()->setBold(true);
	$wb->openSheet("Sheet1")->openTable("A1:A1")->getFont()->setSize(25);
	
	// 画表头	
	$C4Border = $wb->openSheet("Sheet1")->openTable("C4:C4")->getBorder();
	$C4Border->setWeight($xlBorderWeight->xlThick);
	$C4Border->setLineColor($color->yellow);
	
	$titleTable = $wb->openSheet("Sheet1")->openTable("B4:H5");
	$titleTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);
	$titleTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$titleTable->getBorder()->setLineColor($color2);
	
	// 画表体
	$bodyTable = $wb->openSheet("Sheet1")->openTable("B6:H15");
	$bodyTable->getBorder()->setLineColor($color->gray);
	$bodyTable->getBorder()->setWeight($xlBorderWeight->xlHairline);
	
	$B7Border = $wb->openSheet("Sheet1")->openTable("B7:B7")->getBorder();
	$B7Border->setLineColor($color->white);

	$B9Border = $wb->openSheet("Sheet1")->openTable("B9:B9")->getBorder();
	$B9Border->setBorderType($xlBorderType->xlBottomEdge);
	$B9Border->setLineColor($color->white);

	$C6C15BorderLeft = $wb->openSheet("Sheet1")->openTable("C6:C15")->getBorder();
	$C6C15BorderLeft->setLineColor($color->white);
	$C6C15BorderLeft->setBorderType($xlBorderType->xlLeftEdge);

	$C6C15BorderRight = $wb->openSheet("Sheet1")->openTable("C6:C15")->getBorder();
	$C6C15BorderRight->setLineColor($color->yellow);
	$C6C15BorderRight->setLineStyle($xlBorderLineStyle->xlDot);
	$C6C15BorderRight->setBorderType($xlBorderType->xlRightEdge);
	
	$E6E15Border = $wb->openSheet("Sheet1")->openTable("E6:E15")->getBorder();
	$E6E15Border->setLineStyle($xlBorderLineStyle->xlDot);
	$E6E15Border->setBorderType($xlBorderType->xlAllEdges);
	$E6E15Border->setLineColor($color->yellow);

	$G6G15BorderRight = $wb->openSheet("Sheet1")->openTable("G6:G15")->getBorder();
	$G6G15BorderRight->setBorderType($xlBorderType->xlRightEdge);
	$G6G15BorderRight->setLineColor($color->white);

	$G6G15BorderLeft = $wb->openSheet("Sheet1")->openTable("G6:G15")->getBorder();
	$G6G15BorderLeft->setLineStyle($xlBorderLineStyle->xlDot);
	$G6G15BorderLeft->setBorderType($xlBorderType->xlLeftEdge);
	$G6G15BorderLeft->setLineColor($color->yellow);

	$bodyTable2 = $wb->openSheet("Sheet1")->openTable("B6:H15");
	$bodyTable2->getBorder()->setWeight($xlBorderWeight->xlThick);
	$bodyTable2->getBorder()->setLineColor($color2);
	$bodyTable2->getBorder()->setBorderType($xlBorderType->xlAllEdges);
	
	// 画表尾
	$H16H17Border = $wb->openSheet("Sheet1")->openTable("H16:H17")->getBorder();
	$color3 = new Java("java.awt.Color", 204, 255, 204);
	$H16H17Border->setLineColor($color3);

	$E16G17Border = $wb->openSheet("Sheet1")->openTable("E16:G17")->getBorder();
	$E16G17Border->setLineColor($color2);

	$footTable = $wb->openSheet("Sheet1")->openTable("B16:H17");
	$footTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$footTable->getBorder()->setLineColor($color2);
	$footTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);

	// 设置行高列宽
	$wb->openSheet("Sheet1")->openTable("A1:A1")->setColumnWidth(1);
	$wb->openSheet("Sheet1")->openTable("B1:B1")->setColumnWidth(20);
	$wb->openSheet("Sheet1")->openTable("C1:C1")->setColumnWidth(15);
	$wb->openSheet("Sheet1")->openTable("D1:D1")->setColumnWidth(10);
	$wb->openSheet("Sheet1")->openTable("E1:E1")->setColumnWidth(8);
	$wb->openSheet("Sheet1")->openTable("F1:F1")->setColumnWidth(3);
	$wb->openSheet("Sheet1")->openTable("G1:G1")->setColumnWidth(12);
	$wb->openSheet("Sheet1")->openTable("H1:H1")->setColumnWidth(20);

	$wb->openSheet("Sheet1")->openTable("A16:A16")->setRowHeight(20);
	$wb->openSheet("Sheet1")->openTable("A17:A17")->setRowHeight(20);

	// 设置表格中字体大小为10
	for ($i = 0; $i < 12; $i++) {//excel表格行号
		for ($j = 0; $j < 7; $j++) {//excel表格列号
			$wb->openSheet("Sheet1")->openCellRC(4 + $i, 2 + $j)->getFont()->setSize(10);
		}
	}

	// 填充单元格背景颜色
	$color4 = new Java("java.awt.Color", 255, 255, 153);
	$temp = 0;
	for ($i = 0; $i < 10; $i++) {
		$temp = 6 + $i;
		$wb->openSheet("Sheet1")->openCell("H".$temp)->setBackColor($color4);
	}

	$wb->openSheet("Sheet1")->openCell("E16")->setBackColor($color2);
	$wb->openSheet("Sheet1")->openCell("F16")->setBackColor($color2);
	$wb->openSheet("Sheet1")->openCell("G16")->setBackColor($color2);
	$wb->openSheet("Sheet1")->openCell("E17")->setBackColor($color2);
	$wb->openSheet("Sheet1")->openCell("F17")->setBackColor($color2);
	$wb->openSheet("Sheet1")->openCell("G17")->setBackColor($color2);
	$color5 = new Java("java.awt.Color", 204, 255, 204);
	$wb->openSheet("Sheet1")->openCell("H16")->setBackColor($color5);
	$wb->openSheet("Sheet1")->openCell("H17")->setBackColor($color5);
	
	//填充单元格文本和公式
	$B4 = $wb->openSheet("Sheet1")->openCell("B4");
	$B4->getFont()->setBold(true);
	$B4->setValue("出差开支预算");
	$H5 = $wb->openSheet("Sheet1")->openCell("H5");
	$H5->getFont()->setBold(true);
	$H5->setValue("总计");
	$H5->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$B6 = $wb->openSheet("Sheet1")->openCell("B6");
	$B6->getFont()->setBold(true);
	$B6->setValue("飞机票价");
	$B9 = $wb->openSheet("Sheet1")->openCell("B9");
	$B9->getFont()->setBold(true);
	$B9->setValue("酒店");
	$B11 = $wb->openSheet("Sheet1")->openCell("B11");
	$B11->getFont()->setBold(true);
	$B11->setValue("餐饮");
	$B12 = $wb->openSheet("Sheet1")->openCell("B12");
	$B12->getFont()->setBold(true);
	$B12->setValue("交通费用");
	$B13 = $wb->openSheet("Sheet1")->openCell("B13");
	$B13->getFont()->setBold(true);
	$B13->setValue("休闲娱乐");
	$B14 = $wb->openSheet("Sheet1")->openCell("B14");
	$B14->getFont()->setBold(true);
	$B14->setValue("礼品");
	$B15 = $wb->openSheet("Sheet1")->openCell("B15");
	$B15->getFont()->setBold(true);
	$B15->getFont()->setSize(10);
	$B15->setValue("其他费用");

	$wb->openSheet("Sheet1")->openCell("C6")->setValue("机票单价（往）");
	$wb->openSheet("Sheet1")->openCell("C7")->setValue("机票单价（返）");
	$wb->openSheet("Sheet1")->openCell("C8")->setValue("其他");
	$wb->openSheet("Sheet1")->openCell("C9")->setValue("每晚费用");
	$wb->openSheet("Sheet1")->openCell("C10")->setValue("其他");
	$wb->openSheet("Sheet1")->openCell("C11")->setValue("每天费用");
	$wb->openSheet("Sheet1")->openCell("C12")->setValue("每天费用");
	$wb->openSheet("Sheet1")->openCell("C13")->setValue("总计");
	$wb->openSheet("Sheet1")->openCell("C14")->setValue("总计");
	$wb->openSheet("Sheet1")->openCell("C15")->setValue("总计");

	$wb->openSheet("Sheet1")->openCell("G6")->setValue("  张");
	$wb->openSheet("Sheet1")->openCell("G7")->setValue("  张");
	$wb->openSheet("Sheet1")->openCell("G9")->setValue("  晚");
	$wb->openSheet("Sheet1")->openCell("G10")->setValue("  晚");
	$wb->openSheet("Sheet1")->openCell("G11")->setValue("  天");
	$wb->openSheet("Sheet1")->openCell("G12")->setValue("  天");

	$wb->openSheet("Sheet1")->openCell("H6")->setFormula("=D6*F6");
	$wb->openSheet("Sheet1")->openCell("H7")->setFormula("=D7*F7");
	$wb->openSheet("Sheet1")->openCell("H8")->setFormula("=D8*F8");
	$wb->openSheet("Sheet1")->openCell("H9")->setFormula("=D9*F9");
	$wb->openSheet("Sheet1")->openCell("H10")->setFormula("=D10*F10");
	$wb->openSheet("Sheet1")->openCell("H11")->setFormula("=D11*F11");
	$wb->openSheet("Sheet1")->openCell("H12")->setFormula("=D12*F12");
	$wb->openSheet("Sheet1")->openCell("H13")->setFormula("=D13*F13");
	$wb->openSheet("Sheet1")->openCell("H14")->setFormula("=D14*F14");
	$wb->openSheet("Sheet1")->openCell("H15")->setFormula("=D15*F15");

	for ($i = 0; $i < 10; $i++) {
		//设置数据以货币形式显示
		$wb->openSheet("Sheet1")->openCell("D".(6 + $i))->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
		$wb->openSheet("Sheet1")->openCell("H".(6 + $i))->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	}

	$E16 = $wb->openSheet("Sheet1")->openCell("E16");
	$E16->getFont()->setBold(true);
	$E16->getFont()->setSize(11);
	$E16->setForeColor($color->white);
	$E16->setValue("出差开支总费用");
	$E16->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$E17 = $wb->openSheet("Sheet1")->openCell("E17");
	$E17->getFont()->setBold(true);
	$E17->getFont()->setSize(11);
	$E17->setForeColor($color->white);
	$E17->setFormula("=IF(C4>H16,\"低于预算\",\"超出预算\")");
	$E17->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$H16 = $wb->openSheet("Sheet1")->openCell("H16");
	$H16->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$H16->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	$H16->getFont()->setName("Arial");
	$H16->getFont()->setSize(11);
	$H16->getFont()->setBold(true);
	$H16->setFormula("=SUM(H6:H15)");
	$H17 = $wb->openSheet("Sheet1")->openCell("H17");
	$H17->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$H17->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	$H17->getFont()->setName("Arial");
	$H17->getFont()->setSize(11);
	$H17->getFont()->setBold(true);
	$H17->setFormula("=(C4-H16)");
	
	// 填充数据
	$C4 = $wb->openSheet("Sheet1")->openCell("C4");
	$C4->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	$C4->setValue("2500");
	$D6 = $wb->openSheet("Sheet1")->openCell("D6");
	$D6->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	$D6->setValue("1200");
	$wb->openSheet("Sheet1")->openCell("F6")->getFont()->setSize(10);
	$wb->openSheet("Sheet1")->openCell("F6")->setValue("1");
	$D7 = $wb->openSheet("Sheet1")->openCell("D7");
	$D7->setNumberFormatLocal("￥#,##0.00;￥-#,##0.00");
	$D7->setValue("875");
	$wb->openSheet("Sheet1")->openCell("F7")->setValue("1");

	$PageOfficeCtrl->setWriter($wb);
	
	//创建自定义菜单栏
	$PageOfficeCtrl->addCustomToolButton("全屏切换", "SetFullScreen()", 4);
	$PageOfficeCtrl->setMenubar(false);//隐藏菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏Office工具栏
	
	//打开Excel文档
	$fileName = "test.xls";
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>完全编程生成Excel</title>
	</head>

	<body>
		<!-- *********************pageoffice组件的使用 **************************-->
		<script language="javascript" type="text/javascript">
			//全屏
			function SetFullScreen() {
				document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
			}
		</script>
		 <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		<!-- *********************pageoffice组件的使用 **************************-->
	</body>
</html>
