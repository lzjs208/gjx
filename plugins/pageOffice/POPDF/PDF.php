<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	$here=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));//���б���
	$PDFCtrl = new Java("com.zhuozhengsoft.pageoffice.PDFCtrlPHP");//���б���
	$PDFCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//���ñ����ʽ

	// Create custom toolbar
	$PDFCtrl->addCustomToolButton("��ӡ", "Print()", 6);
	$PDFCtrl->addCustomToolButton("����/��ʾ��ǩ", "SetBookmarks()", 0);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	$PDFCtrl->addCustomToolButton("ʵ�ʴ�С", "SetPageReal()", 16);
	$PDFCtrl->addCustomToolButton("�ʺ�ҳ��", "SetPageFit()", 17);
	$PDFCtrl->addCustomToolButton("�ʺϿ��", "SetPageWidth()", 18);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	$PDFCtrl->addCustomToolButton("��ҳ", "FirstPage()", 8);
	$PDFCtrl->addCustomToolButton("��һҳ", "PreviousPage()", 9);
	$PDFCtrl->addCustomToolButton("��һҳ", "NextPage()", 10);
	$PDFCtrl->addCustomToolButton("βҳ", "LastPage()", 11);
	$PDFCtrl->addCustomToolButton("-", "", 0);
	
	//$PDFCtrl->AddCustomToolButton("����", "SaveDocument()", 1);
	//$PDFCtrl->AddCustomToolButton("-", "", 0);
	$PDFCtrl->webOpen("doc/test.pdf");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>���ߴ�PDF�ļ�</title>
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
  <!--**************   ׿�� PageOffice �ͻ��˴��뿪ʼ    ************************-->
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
    <!--**************   ׿�� PageOffice �ͻ��˴������    ************************-->
  <div style="width:auto; height:600px;">
      <?php echo $PDFCtrl->getDocumentView("PDFCtrl1") ?>
  </div>
  </body>
</html>