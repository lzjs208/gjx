<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("显示/隐藏标尺","Hidden",3);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>显示/隐藏标尺</title>
    
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
   <div style=" width:1200px; height:700px;">
   <!-- *********************************PageOffice组件的使用************************************ -->
   <script type="text/javascript" language="javascript">
           //显示/隐藏标尺
            function Hidden() {
                document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.ActivePane.DisplayRulers = 
                !document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.ActivePane.DisplayRulers;
            } 
 
    </script>
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
     <!-- *********************************PageOffice组件的使用************************************ -->
    </div>
  </body>
</html>
