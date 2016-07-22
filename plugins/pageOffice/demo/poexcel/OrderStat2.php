<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}

	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	
	//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$sheet = $workbook->openSheet("查询表");

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	
	$sql = "SELECT OrderNum,OrderDate,CustName,SalesName,Amount from OrderMaster order by ID desc";
	$rs = $conn->Execute($sql);

	$rowCount = 0;//记录行数
	$salesName = "";
	$date = "";
	$orderNum = "";
	$custName = "";
	$amount = "";
	$totalMoney = 0.00;

	while (!$rs->EOF) {
		$orderNum = (string)($rs->Fields["OrderNum"]->value);
		$date = (string)($rs->Fields["OrderDate"]->value);
		$custName = (string)($rs->Fields["CustName"]->value);
		$salesName = (string)($rs->Fields["SalesName"]->value);
		$amount = (string)($rs->Fields["Amount"]->value);

		$sheet->openCell("B" .(5 + $rowCount))->setValue($orderNum);
		if (isset($date) && !empty($date) && strlen(trim($date))>0) {
			$sheet->openCell("C" .(5 + rowCount))->setValue($date);
		}
		$sheet->openCell("D" .(5 + $rowCount))->setValue($custName);
		$sheet->openCell("E" .(5 + $rowCount))->setValue($salesName);
		$sheet->openCell("F" .(5 + $rowCount))->setValue("￥".sprintf("%.2f", $amount));
		$totalMoney += (double)$amount;

		if ($rowCount % 2 == 0) {
			//设置背景色
			$color = new Java("java.awt.Color",253, 233, 217 );
			$sheet->openTable("B" .(5 + $rowCount) .":F" .(5 + $rowCount))->setBackColor($color);
		}
		$rowCount++;
		$rs->MoveNext();
	}

	//设置前景色
	$color2 = new Java("java.awt.Color",148, 138, 84 );
	$sheet->openTable("B5:F" .($rowCount + 4))->setForeColor($color2);

	//水平方向对齐方式
	$sheet->openTable("B5:F" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignLeft);
	$sheet->openTable("C5:C" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignCenter);
	$sheet->openTable("E5:E" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignCenter);
	$sheet->openTable("F5:F" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignRight);
	//竖直方向对齐方式
	$sheet->openTable("B5:F" .($rowCount + 4))->setVerticalAlignment(
			$xlVAlign->xlVAlignCenter);

	//合计：

	//合并单元格
	$sheet->openTable("B" .($rowCount + 5) .":F" .($rowCount + 5))->merge();
	//行高
	$sheet->openTable("B5:F" .($rowCount + 6))->setRowHeight(18);
	$sheet->openTable("B" .($rowCount + 5) .":F" .($rowCount + 6))
			->setHorizontalAlignment($xlHAlign->xlHAlignLeft);
	$sheet->openTable("B" .($rowCount + 5) .":F" . ($rowCount + 6))
			->setVerticalAlignment($xlVAlign->xlVAlignCenter);
			
	$sheet->openCell("B" .($rowCount + 6))->setValue("合计");
	$sheet->openTable("C" .($rowCount + 6) .":E" .($rowCount + 6))->merge();

	$sheet->openCell("F" .($rowCount + 6))->setValue("￥".sprintf("%.2f", $totalMoney));
	$sheet->openTable("F" .($rowCount + 6) .":F" .($rowCount + 6))
			->setHorizontalAlignment($xlHAlign->xlHAlignRight);
	$sheet->openTable("B" .($rowCount + 6) .":F" .($rowCount + 6))
			->setVerticalAlignment($xlVAlign->xlVAlignCenter);

	//设置字体：大小、名称
	$sheet->openTable("B5:F" .($rowCount + 6))->getFont()->setSize(9);
	$sheet->openTable("B5:F" .($rowCount + 6))->getFont()->setName("宋体");

	//设置Table的边框样式：样式、宽度、颜色(多种边框样式重叠时，需创建Table对象才可实现样式的叠加覆盖)
	$table = $sheet->openTable("B" .($rowCount + 6) .":F".($rowCount + 6));
	$table->getBorder()->setBorderType($xlBorderType->xlTopEdge);
	$table->getBorder()->setWeight($xlBorderWeight->xlThin);
	$color3 = new Java("java.awt.Color", 148, 138, 84);
	$table->getBorder()->setLineColor($color3);

	$table->close();
		
	//禁用右键、双击
	$workbook->setDisableSheetDoubleClick(true);	
	$workbook->setDisableSheetRightClick(true);

	$fileName = "OrderQuery.xls";
	$PageOfficeCtrl->setWriter($workbook);
	// 创建自定义菜单栏
	$PageOfficeCtrl->addCustomToolButton("页面设置", "SetPage()", 3);
	$PageOfficeCtrl->addCustomToolButton("打印", "Print()", 6);
	$PageOfficeCtrl->addCustomToolButton("打印预览", "PreViewShowPrint()", 7);
	$PageOfficeCtrl->addCustomToolButton("另存到本机", "SaveAs()", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏切换", "SetFullScreen()", 4);

	$PageOfficeCtrl->setMenubar(false);//隐藏菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏工具栏
	
	//设置保存页面
	$PageOfficeCtrl->setSaveDataPage("Update.php");

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsReadOnly, "");//此行必须
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>查询表</title>
	</head>
	<body>
		<!--header-->
		<div class="zz-headBox clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="home.html"> <img src="images/logo.png" alt="" />
					</a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
                <li><a target="_blank" href="http://www.zhuozhengsoft.com">卓正网站</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">客户问吧</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">联系我们</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li>
					<font>当前用户：</font><?php echo $userName;?></li>
				<li>
					<font>当前系统日期：</font><?php date_default_timezone_set("Asia/Shanghai"); echo date( "Y-m-d h:i:sa"); ?></li>
				<li>
					<font>当前模块：</font>修改订单
				</li>
			</ul>
		</div>
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<!--left-->
			<div class="zz-contentLeft fl">
				<ul class="left-ul">
					<h2 class="fs-12">
						用户功能区
					</h2>
					<li>
						<a href="OrderList.php">订单列表</a>
					</li>
					<li>
						<a href="NewOrder.php">新建订单</a>
					</li>
					<li>
						<a href="OrderStat.php">统计图表</a>
					</li>
					<li style="background: #d0eaf7; display: block;">
						<a href="OrderStat2.php">查询表</a>
					</li>
					<li class="bo-n">
						<a href="logout.php">退出系统</a>
					</li>
				</ul>
			</div>
			<div class="zz-contentRight fl">
				<div style="width: 860px; height: 750px;">
					<!-- *********************pageoffice组件的使用 **************************-->
					<script language="javascript">
	//另存到本机
	function SaveAs() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(2);
	}
	//页面设置
	function ShowPageSetupDlg() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(5);
	}
	//打印
	function ShowPrintDlg() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(4);
	}
	//打印预览
	function PrintPreView() {
		document.getElementById("PageOfficeCtrl1").PrintPreview();
	}
	//全屏
	function SetFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document
				.getElementById("PageOfficeCtrl1").FullScreen;
	}
</script>
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<!-- *********************pageoffice组件的使用 **************************-->
				</div>
			</div>
			<!--内容区-->
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright 2013 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
