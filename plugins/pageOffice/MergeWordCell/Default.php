<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//打开数据区域
	$dataReg = $doc->openDataRegion("PO_table");
	$table = $dataReg->openTable(1);
	//合并table中的单元格
	$table->openCellRC(1, 1)->mergeTo(1, 4);
	//给合并后的单元格赋值
	$table->openCellRC(1, 1)->setValue("销售情况表");
	//设置单元格文本样式
	$color = new Java("java.awt.Color");
	$table->openCellRC(1, 1)->getFont()->setColor($color->red);
	$table->openCellRC(1, 1)->getFont()->setSize(24);
	$table->openCellRC(1, 1)->getFont()->setName("楷体");
	$WdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$table->openCellRC(1, 1)->getParagraphFormat()->setAlignment($WdParagraphAlignment->wdAlignParagraphCenter);			
	
	$PageOfficeCtrl->setWriter($doc);
	//隐藏工具栏
	$PageOfficeCtrl->setCustomToolbar(false);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>合并word单元格</title>
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