<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$wdLineSpacing = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdLineSpacing");
	$color = new Java("java.awt.Color");
	//设置内容标题

	//创建DataRegion对象，PO_title为自动添加的书签名称,书签名称需以“PO_”为前缀，切书签名称不能重复
	//三个参数分别为要新插入书签的名称、新书签的插入位置、相关联的书签名称（“[home]”代表Word文档的第一个位置）
	$title = $doc->createDataRegion("PO_title",$dataRegionInsertType->After, "[home]");
	//给DataRegion对象赋值
	$title->setValue("C#中Socket多线程编程实例\n");
	//设置字体：粗细、大小、字体名称、是否是斜体
	$title->getFont()->setBold(true);
	$title->getFont()->setSize(20);
	$title->getFont()->setName("黑体");
	$title->getFont()->setItalic(false);
	//定义段落对象
	$titlePara = $title->getParagraphFormat();
	//设置段落对齐方式
	$titlePara->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
	//设置段落行间距
	$titlePara->setLineSpacingRule($wdLineSpacing->wdLineSpaceMultiple);
	
	//设置内容
	//第一段
	//创建DataRegion对象，PO_body为自动添加的书签名称
	$body = $doc->createDataRegion("PO_body",$dataRegionInsertType->After, "PO_title");
	//设置字体：粗细、是否是斜体、大小、字体名称、字体颜色
	$body->getFont()->setBold(false);
	$body->getFont()->setItalic(true);
	$body->getFont()->setSize(10);
	//设置中文字体名称
	$body->getFont()->setName("楷体");
	//设置英文字体名称
	$body->getFont()->setName("Times New Roman");
	$body->getFont()->setColor($color->RED);
	//给DataRegion对象赋值
	$body->setValue("是微软随着VS.net新推出的一门语言。它作为一门新兴的语言，有着C++的强健，又有着VB等的RAD特性。而且，微软推出C#主要的目的是为了对抗Sun公司的Java。大家都知道Java语言的强大功能，尤其在网络编程方面。于是，C#在网络编程方面也自然不甘落后于人。本文就向大家介绍一下C#下实现套接字（Sockets）编程的一些基本知识，以期能使大家对此有个大致了解。首先，我向大家介绍一下套接字的概念。\n");
	//创建ParagraphFormat对象
	$bodyPara = $body->getParagraphFormat();
	//设置段落的行间距、对齐方式、首行缩进
	$bodyPara->setLineSpacingRule($wdLineSpacing->wdLineSpaceAtLeast);
	$bodyPara->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara->setFirstLineIndent(21);
	
	//第二段
	$body2 = $doc->createDataRegion("PO_body2",$dataRegionInsertType->After, "PO_body");
	$body2->getFont()->setBold(false);
	$body2->getFont()->setSize(12);
	$body2->getFont()->setName("黑体");
	$body2->setValue("套接字是通信的基石，是支持TCP/IP协议的网络通信的基本操作单元。可以将套接字看作不同主机间的进程进行双向通信的端点，它构成了单个主机内及整个网络间的编程界面。套接字存在于通信域中，通信域是为了处理一般的线程通过套接字通信而引进的一种抽象概念。套接字通常和同一个域中的套接字交换数据（数据交换也可能穿越域的界限，但这时一定要执行某种解释程序）。各种进程使用这个相同的域互相之间用Internet协议簇来进行通信。\n");
	//body2->setValue("[image]../images/logo.jpg[/image]");
	$bodyPara2 = $body2->getParagraphFormat();
	$bodyPara2->setLineSpacingRule($wdLineSpacing->wdLineSpace1pt5);
	$bodyPara2->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara2->setFirstLineIndent(21);
	
	//第三段
	$body3 = $doc->createDataRegion("PO_body3", $dataRegionInsertType->After, "PO_body2");
	$body3->getFont()->setBold(false);
	$color2 = new Java("java.awt.Color" , 0, 128, 228);
	$body3->getFont()->setColor($color2);
	$body3->getFont()->setSize(14);
	$body3->getFont()->setName("华文彩云");
	$body3->setValue("套接字可以根据通信性质分类，这种性质对于用户是可见的。应用程序一般仅在同一类的套接字间进行通信。不过只要底层的通信协议允许，不同类型的套接字间也照样可以通信。套接字有两种不同的类型：流套接字和数据报套接字。\n");
	$bodyPara3 = $body3->getParagraphFormat();
	$bodyPara3->setLineSpacingRule($wdLineSpacing->wdLineSpaceDouble);
	$bodyPara3->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara3->setFirstLineIndent(21);

	$body4 = $doc->createDataRegion("PO_body4", $dataRegionInsertType->After, "PO_body3");
	$body4->setValue("[image]../images/logo.png[/image]");
	//body4->setValue("[word]doc/1.doc[/word]");//还可嵌入其他Word文件
	$bodyPara4 = $body4->getParagraphFormat();
	$bodyPara4->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
	
	
    $PageOfficeCtrl->setWriter($doc);
	
	//设置页面保存后执行的JS函数
	$PageOfficeCtrl->setJsFunction_AfterDocumentSaved("SaveOK()");

	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//添加自定义按钮
	//$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
	//设置保存页面
	//$PageOfficeCtrl->setSaveFilePage("SaveFile.jsp");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>完全编程生成Word</title>
	</head>
	<body>
		<script type="text/javascript">
	function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
    }
</script>
		<form id="form1">
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
