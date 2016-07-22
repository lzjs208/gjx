<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	$PageOfficeCtrl->setCustomToolbar(false);//隐藏自定义工具栏
	$PageOfficeCtrl->setOfficeToolbars(false);//隐藏Office工具栏
	$PageOfficeCtrl->setAllowCopy(false);//禁止拷贝	
	
    $PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docReadOnly, "张佚名");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>最简单的打开保存Word文件</title>
</head>
<body>
    <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(3, false); // 禁止保存
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(4, false); // 禁止另存
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(5, false); //禁止打印
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(6, false); // 禁止页面设置
        }
    </script>
    <form id="form1" >
    <p>点击“文件”菜单，可以看到“保存”、“另存为”、“页面设置”、“打印”菜单项已经变灰。保存菜单项不仅变灰，Ctrl+S也被禁用。</p>
    <div style=" width:auto; height:700px;">
         <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
