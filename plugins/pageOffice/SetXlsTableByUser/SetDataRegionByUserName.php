<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$sheet = $workbook->openSheet("Sheet1");//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$tableA = $sheet->openTable("C4:D6");
    $tableB = $sheet->openTable("C7:D9");

    $tableA->setSubmitName("tableA");
    $tableB->setSubmitName("tableB");
		
		
    //根据登录用户名设置数据区域可编辑性
    $strInfo = "";
    $userName = $_REQUEST["userName"];    
    //A部门经理登录后
    if (strcasecmp($userName, "zhangsan")==0)
    {
        $strInfo = "A部门经理，所以只能编辑A部门的产品数据";
        $tableA->setReadOnly(false);
        $tableB->setReadOnly(true);
    }
    //B部门经理登录后
    else
    {
        $strInfo = "B部门经理，所以只能编辑B部门的产品数据";
        $tableA->setReadOnly(true);
        $tableB->setReadOnly(false);
    }
	
	$PageOfficeCtrl->setWriter($workbook);
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原", "IsFullScreen", 4);
	//设置保存页
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");//保存文件
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsSubmitForm, $userName);//此行必须
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
					<span style="color: Red;"><?php echo $strInfo;?></span>
				</div>

				<script type="text/javascript">
	                //保存页面
	                function Save() {
	                    document.getElementById("PageOfficeCtrl1").WebSave();
	                }
	
	            </script>

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>