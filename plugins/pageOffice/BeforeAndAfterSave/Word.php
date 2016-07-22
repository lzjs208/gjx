<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码	
	
	$PageOfficeCtrl->setJsFunction_BeforeDocumentSaved("BeforeDocumentSaved()");// 设置文件保存之前执行的事件	
	$PageOfficeCtrl->setJsFunction_AfterDocumentSaved("AfterDocumentSaved()");// 设置文件保存之后执行的事件

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");//设置保存页面
	
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//此行必须
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>文档保存前和保存后执行的事件</title>
</head>
<body>
    <script type="text/javascript">
        function BeforeDocumentSaved() {
            document.getElementById("PageOfficeCtrl1").Alert("BeforeDocumentSaved事件：文件就要开始保存了.");
            return true;
        }
        function AfterDocumentSaved(IsSaved) {
            if (IsSaved) {
                document.getElementById("PageOfficeCtrl1").Alert("AfterDocumentSaved事件：文件保存成功了.");
            }
        }
    </script>
    <form id="form1" >
    	演示: 文档保存前和保存后执行的事件。<br /><br />
    
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
