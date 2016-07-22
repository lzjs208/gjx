<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	$PageOfficeCtrl->setAllowCopy(false);//禁止拷贝
	$PageOfficeCtrl->setMenubar(false);//隐藏菜单栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏Office工具条
	$PageOfficeCtrl->setCustomToolbar(false);//隐藏自定义工具栏
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened");
	//设置页面的显示标题
	$PageOfficeCtrl->setCaption("演示：文件在线安全浏览");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docReadOnly, "张佚名");//只读模式打开word文档，此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>   
    <title>演示：文件在线安全浏览</title>
    
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
  <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(4, false); //禁止另存
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(5, false); //禁止打印
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(6, false); //禁止页面设置
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(8, false); //禁止打印预览
        }
    </script>
    <div style=" width:auto; height:700px;">
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
  </body>
</html>
