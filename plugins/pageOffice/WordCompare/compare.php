<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	// Create custom toolbar
	$PageOfficeCtrl->addCustomToolButton("显示A文档", "ShowFile1View()", 0);
	$PageOfficeCtrl->addCustomToolButton("显示B文档", "ShowFile2View()", 0);
	$PageOfficeCtrl->addCustomToolButton("显示比较结果", "ShowCompareView()", 0);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	//$PageOfficeCtrl->wordCompare("doc/aaa1.doc", "doc/aaa2.doc", $OpenMode->docReadOnly, "张三");//此行必须
    $PageOfficeCtrl->wordCompare("doc/aaa1.doc", "doc/aaa2.doc", $OpenMode->docAdmin, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Word文档比较</title>
    
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
  <script language="javascript" type="text/javascript">
	    function SaveDocument() {
	        document.getElementById("PageOfficeCtrl1").WebSave();
	    }
	    function ShowFile1View() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = false;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 1;
	    }
	    function ShowFile2View() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = false;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 0;
	    }
	    function ShowCompareView() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = true;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 0;
	    }
	    function SetFullScreen() {
	        document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	    }
	</script>
    <div style="width:1000px; height:800px;">
      <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
  	</div>
  </body>
</html>
