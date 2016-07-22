<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	// 设置文件打开后执行的js function
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened( "AfterDocumentOpened()");

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>文件打开后触发的事件</title>
</head>
<body>
    <script type="text/javascript">
        function AfterDocumentOpened() {
            // 打开文件的时候，给word中当前光标位置赋值一个文本值
            document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range.Text = "文件打开了";
        }
    </script>
    <form id="form1" >
    Word中的"<span style=" color:Red;"> 文件打开了</span>" 是在文档打开的事件中用程序添加进去的。<br /><br />
    
    <div style=" width:auto; height:700px;">
         <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
