<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	$here=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));//此行必须
	$PDFCtrl = new Java("com.zhuozhengsoft.pageoffice.PDFCtrlPHP");//此行必须
	$PDFCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置编码格式

	// Create custom toolbar
	$PDFCtrl->addCustomToolButton("打印", "Print()", 6);
	$PDFCtrl->addCustomToolButton("隐藏/显示书签", "SetBookmarks()", 0);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	$PDFCtrl->addCustomToolButton("实际大小", "SetPageReal()", 16);
	$PDFCtrl->addCustomToolButton("适合页面", "SetPageFit()", 17);
	$PDFCtrl->addCustomToolButton("适合宽度", "SetPageWidth()", 18);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	$PDFCtrl->addCustomToolButton("首页", "FirstPage()", 8);
	$PDFCtrl->addCustomToolButton("上一页", "PreviousPage()", 9);
	$PDFCtrl->addCustomToolButton("下一页", "NextPage()", 10);
	$PDFCtrl->addCustomToolButton("尾页", "LastPage()", 11);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	
	//$PDFCtrl->AddCustomToolButton("保存", "SaveDocument()", 1);
	//$PDFCtrl->AddCustomToolButton("-", "", 0);
	$PDFCtrl->webOpen("doc/test.pdf");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>在线打开PDF文件</title>
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
  <!--**************   卓正 PageOffice 客户端代码开始    ************************-->
	<script language="javascript" type="text/javascript">
	    function AfterDocumentOpened() {
	        //alert(document.getElementById("PDFCtrl1").Caption);
	    }
	    function SetBookmarks() {
	        document.getElementById("PDFCtrl1").BookmarksVisible = !document.getElementById("PDFCtrl1").BookmarksVisible;
	    }
	    
	    function Print() {
	        document.getElementById("PDFCtrl1").ShowDialog(4);
	    }
	    function SwitchFullScreen() {
	        document.getElementById("PDFCtrl1").FullScreen = !document.getElementById("PDFCtrl1").FullScreen;
	    }
	    function SetPageReal() {
	        document.getElementById("PDFCtrl1").SetPageFit(1);
	    }
	    function SetPageFit() {
	        document.getElementById("PDFCtrl1").SetPageFit(2);
	    }
	    function SetPageWidth() {
	        document.getElementById("PDFCtrl1").SetPageFit(3);
	    }
	    function ZoomIn() {
	        document.getElementById("PDFCtrl1").ZoomIn();
	    }
	    function ZoomOut() {
	        document.getElementById("PDFCtrl1").ZoomOut();
	    }
	    function FirstPage() {
	        document.getElementById("PDFCtrl1").GoToFirstPage();
	    }
	    function PreviousPage() {
	        document.getElementById("PDFCtrl1").GoToPreviousPage();
	    }
	    function NextPage() {
	        document.getElementById("PDFCtrl1").GoToNextPage();
	    }
	    function LastPage() {
	        document.getElementById("PDFCtrl1").GoToLastPage();
	    }
	    function RotateRight() {
	        document.getElementById("PDFCtrl1").RotateRight();
	    }
	    function RotateLeft() {
	        document.getElementById("PDFCtrl1").RotateLeft();
	    }
	</script>
    <!--**************   卓正 PageOffice 客户端代码结束    ************************-->
  <div style="width:auto; height:600px;">
      <?php echo $PDFCtrl->getDocumentView("PDFCtrl1") ?>
  </div>
  </body>
</html>