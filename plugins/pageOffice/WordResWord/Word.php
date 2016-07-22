<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = $_SERVER['SERVER_NAME'];//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//先在要插入word文件的位置手动插入书签,书签必须以“PO_”为前缀
	//给DataRegion赋值,值的形式为："[word]word文件路径[/word]、[excel]excel文件路径[/excel]、[image]图片路径[/image]"
	$data1 = $doc->openDataRegion("PO_p1");
	$data1->setValue("[word]doc/1.doc[/word]");
	$data2 = $doc->openDataRegion("PO_p2");
	$data2->setValue("[word]doc/2.doc[/word]");
	$data3 = $doc->openDataRegion("PO_p3");
	$data3->setValue("[word]doc/3.doc[/word]");
    $PageOfficeCtrl->setWriter($doc);
	
	$PageOfficeCtrl->setCaption("演示：后台编程插入Word文件到数据区域");

	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏自定义工具栏
	$PageOfficeCtrl->setCustomToolbar(false);
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>后台编程插入Word文件到数据区域</title>
	</head>
	<body>
		<div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        关键代码：<span style="background-color: Yellow;"> <br />$dataRegion
            = $doc->openDataRegion("PO_开头的书签名称");
            <br />
            $dataRegion->setValue("[word]doc/1.doc[/word]");</span><br />
    </div>
		<br />
		<form id="form1">
			<div style="width: auto; height: 700px;">
				<!--**************   PageOffice 客户端代码开始    ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
				<!--**************   PageOffice 客户端代码结束    ************************-->
			</div>
		</form>
	</body>
</html>