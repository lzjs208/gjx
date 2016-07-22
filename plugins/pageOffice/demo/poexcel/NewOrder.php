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
	$wb = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$sheet = $wb->openSheet("销售订单");

	$sheet->openCell("D5")->setSubmitName("CustName");
	$sheet->openCell("I5")->setSubmitName("OrderNum");
	date_default_timezone_set("Asia/Shanghai");
	$sheet->openCell("I6")->setValue(date("Y/m/d"));
	$sheet->openCell("I6")->setReadOnly(true);
	$sheet->openCell("I6")->setSubmitName("OrderDate");
	$sheet->openCell("D6")->setSubmitName("CustDistrict");
	$sheet->openCell("D18")->setValue($userName);
	$sheet->openCell("H18")->setSubmitName("SalesName");
	$sheet->openCell("I16")->setSubmitName("Amount");
	$sheet->openCell("I16")->setReadOnly(true);

	$table = $sheet->openTable("C9:H15");
	$table->setSubmitName("OrderDetail");
	$sheet->openTable("D9:D15")->setReadOnly(true);
	
	//禁用右键、双击
	$wb->setDisableSheetDoubleClick(true);
	$wb->setDisableSheetRightClick(true);
	
	$fileName = "OrderForm.xls";
	$PageOfficeCtrl->setWriter($wb);
	// 创建自定义菜单栏
	$PageOfficeCtrl->addCustomToolButton("保存", "SaveDocument()", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏切换", "SetFullScreen()", 4);

	$PageOfficeCtrl->setMenubar(false);//隐藏菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏工具栏
	
	//设置保存页面
	$PageOfficeCtrl->setSaveDataPage("Update.php");

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsSubmitForm, "");//此行必须
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
		<title>登录列表</title>
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
					<li style="background: #d0eaf7; display: block;">
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
					<!-- ****************************pageoffice组件使用****************************** -->
					<script type="text/javascript">
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
					<!-- ****************************pageoffice组件使用****************************** -->
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