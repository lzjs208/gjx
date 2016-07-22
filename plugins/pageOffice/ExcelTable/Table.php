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
	
	//定义Table对象
	$table = $sheet->openTable("B4:F13");
    for($i=0; $i < 50; $i++)
    { 
        $table->getDataFields()->get(0)->setValue("产品 ".$i);
        $table->getDataFields()->get(1)->setValue("100");
        $table->getDataFields()->get(2)->setValue((string)(100+$i));
        $table->nextRow();
    }
    $table->close();
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
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
		<title>使用OpenTable方法给excel填充数据</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

	</head>

	<body>
		此表格中的数据是使用后台程序填充进去的，请查看Table.php的代码，使用的OpenTable的方法，可以实现行增长，还可以循环使用原模板Table区域（B4:F13）单元格样式。
		<div style="width: 1000px; height: 700px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
