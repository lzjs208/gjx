<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}
	$id = $_REQUEST["ID"];
	if (!isset($id) || empty($id) || strlen(trim($id))==0) {
		header("Location:OrderList.php");
	}
		//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$sheet = $workbook->openSheet("销售订单");

	//避免单元格内公式被覆盖，将其设为只读
	$cI6 = $sheet->openCell("I6");
	$cI6->setReadOnly(true);
	$cI16 = $sheet->openCell("I16");
	$cI16->setReadOnly(true);
	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);	   
		$query = "select * from OrderMaster where ID=".$id;
		$rs = $conn->Execute($query); 

		if (!$rs->EOF) {
			$sheet->openCell("D5")->setValue($rs->Fields["CustName"]->value);
			$sheet->openCell("D5")->setSubmitName("CustName");
			$sheet->openCell("I5")->setValue($rs->Fields["OrderNum"]->value);
			$sheet->openCell("I5")->setSubmitName("OrderNum");
			$sheet->openCell("D6")->setValue($rs->Fields["CustDistrict"]->value);
			$sheet->openCell("D6")->setSubmitName("CustDistrict");
			//date_default_timezone_set("Asia/Shanghai"); 
			$cI6->setValue((string)$rs->Fields["OrderDate"]->value);
			$cI6->setSubmitName("OrderDate");
			$sheet->openCell("D18")->setValue($rs->Fields["MakerName"]->value);
			$sheet->openCell("H18")->setValue($rs->Fields["SalesName"]->value);
			$sheet->openCell("H18")->setSubmitName("SalesName");
			$cI16->setSubmitName("Amount");

			$orderId = $rs->Fields["ID"]->value;
			
			$rs = $conn->Execute("select * from OrderDetail where OrderID=".$orderId); 
			$table = $sheet->openTable("C9:H15");
			$table2 = $sheet->openTable("D9:D15");
			$table2->setReadOnly(true);//避免单元格内公式被覆盖，将其设为只读
			$table->setSubmitName("OrderDetail");

			$proCode = "";
			$type = "";
			$unit = "";
			$quantity = "";
			$price = "";

			while (!$rs->EOF) {
				$proCode = $rs->Fields["ProductCode"]->value;
				$type = $rs->Fields["ProductType"]->value;
				$unit = $rs->Fields["Unit"]->value;
				$quantity = $rs->Fields["Quantity"]->value;
				$price = $rs->Fields["Price"]->value;

				$table->getDataFields()->get(0)->setValue($proCode);
				$table->getDataFields()->get(2)->setValue($type);
				$table->getDataFields()->get(3)->setValue($unit);
				$table->getDataFields()->get(4)->setValue($quantity);
				$table->getDataFields()->get(5)->setValue((float)$price);
				//循环下一行
				$table->nextRow();
				
				$rs->MoveNext();
			}
			$table->close();
		}		
	}
	$workbook->setDisableSheetRightClick(true);	

	$fileName = "OrderForm.xls";
	$PageOfficeCtrl->setWriter($workbook);
	// 创建自定义菜单栏
	$PageOfficeCtrl->addCustomToolButton("保存", "SaveDocument()", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏切换", "SetFullScreen()", 4);

	$PageOfficeCtrl->setMenubar(false);//隐藏菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏工具栏
	
	//设置保存页面
	$PageOfficeCtrl->setSaveDataPage("Update.php?ID=" . $id. "&r=".rand());

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsSubmitForm, "");//此行必须
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li'); 
</script>
<![endif]-->
		<title>销售订单</title>
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
					<li><a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li class="pd-left">
					销售订单管理系统示例
				</li>
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
					<li>
						<a href="OrderStat2.php">查询表</a>
					</li>
					<li class="bo-n">
						<a href="logout.php">退出系统</a>
					</li>
				</ul>
			</div>
			<div class="zz-contentRight fl">
				<!--表格内容-->
				<div style="width: 860px; height: 750px;">
					<!-- *********************pageoffice组件的使用 **************************-->
					<script language="javascript">
						function SaveDocument(data) {
							document.getElementById("PageOfficeCtrl1").WebSave();
							if (document.getElementById("PageOfficeCtrl1").CustomSaveResult != "error") {
								document.getElementById("PageOfficeCtrl1").Alert('保存成功！');
								location.href = "OrderList.php";
							}
						}
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
			Copyright 2012 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
