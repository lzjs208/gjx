<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//定义Workbook对象
	$PageOfficeCtrl->setCaption("简单的给Excel赋值");
	//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
	$sheet = $workbook->openSheet("Sheet1");
	$sheet->openCellByDefinedName("testA1")->setValue("Tom");
	$sheet->openCellByDefinedName("testB1")->setValue("John");
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");
	$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);   

	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>给Excel文档中定义名称的单元格赋值</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->
	<script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
	</head>

	<body>
	A1、B1单元格的数据是使用后台程序填充进去的，请查看ExcelFill.php的代码
		<div style="width: 1000px; height: 800px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
