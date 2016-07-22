<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$color = new Java("java.awt.Color");
	//打开数据区域
	$d1 = $doc->openDataRegion("d1");
	//设置字体样式	
    $d1->getFont()->setColor($color->blue);//设置数据区域文本字体颜色
    $d1->getFont()->setSize(16);//设置数据区域文本字体大小
    $d1->getFont()->setName("华文彩云");//设置数据区域文本字体样式	
	$d1->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);//设置数据区域文本对齐方式
	
	$d2 = $doc->openDataRegion("d2");
	//设置字体样式
    $d2->getFont()->setColor($color->orange);//设置数据区域文本字体颜色
    $d2->getFont()->setSize(14);//设置数据区域文本字体大小
    $d2->getFont()->setName("黑体");//设置数据区域文本字体样式	
	$d2->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);//设置数据区域文本对齐方式
	
	$d3 = $doc->openDataRegion("d3");
	//设置字体样式
    $d3->getFont()->setColor($color->magenta);//设置数据区域文本字体颜色
    $d3->getFont()->setSize(12);//设置数据区域文本字体大小
    $d3->getFont()->setName("华文行楷");//设置数据区域文本字体样式	
	$d3->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphRight);//设置数据区域文本对齐方式
	
	$PageOfficeCtrl->setWriter($doc);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>控制数据区域文本的样式</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		<div id="content">
			演示了如果使用程序控制数据区域文本的样式。<a href="Default2.php" target="_blank">点此链接查看原文件</a><br /><br />
			<div id="textcontent" style="width: 1000px; height: 800px;">

				<!--**************   卓正 PageOffice组件 ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>
