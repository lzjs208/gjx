<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("另存MHT","saveAsMHT",1);
	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//编辑模式打开word文档，此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>Word文件另存为MHT</title>
</head>
<body>
    <script type="text/javascript">
        function saveAsMHT() {
            document.getElementById("PageOfficeCtrl1").WebSaveAsMHT();
            document.getElementById("PageOfficeCtrl1").Alert("MHT格式的文件已经保存到服务器上。");
            window.open("doc/test.mht" + "?r=" + Math.random());
        }
    </script>
    <form id="form1" >
    <div style=" width:1000px; height:800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
