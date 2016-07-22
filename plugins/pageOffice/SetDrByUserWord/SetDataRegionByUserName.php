<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//打开数据区域
	$dTitle = $doc->openDataRegion("PO_title");
	//给数据区域赋值
	$dTitle->setValue("某公司第二季度产量报表");
	//设置数据区域可编辑性
	$dTitle->setEditing(false);//数据区域不可编辑

	$dA1 = $doc->openDataRegion("PO_A_pro1");
	$dA2 = $doc->openDataRegion("PO_A_pro2");
	$dB1 = $doc->openDataRegion("PO_B_pro1");
	$dB2 = $doc->openDataRegion("PO_B_pro2");

	$userName = $_REQUEST["userName"];
	//根据登录用户名设置数据区域可编辑性
	//A部门经理登录后
	if (strcasecmp($userName,"zhangsan")==0) {
		$userName = "A部门经理";
		$dA1->setEditing(true);
		$dA2->setEditing(true);
		$dB1->setEditing(false);
		$dB2->setEditing(false);
	}
	//B部门经理登录后
	else {
		$userName = "B部门经理";
		$dB1->setEditing(true);
		$dB2->setEditing(true);
		$dA1->setEditing(false);
		$dA2->setEditing(false);
	}
	$PageOfficeCtrl->setWriter($doc);

	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
	//设置保存页
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, $userName);//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>


		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="Default.php"> 返回登录页</a>
					<strong>当前用户：</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
				</div>

				<script type="text/javascript">
	//保存页面
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}

	//全屏/还原
	function IsFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document
				.getElementById("PageOfficeCtrl1").FullScreen;
	}
</script>

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>

