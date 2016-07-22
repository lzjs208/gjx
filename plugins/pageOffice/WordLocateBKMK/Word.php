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
	$PageOfficeCtrl->addCustomToolButton("定位光标到指定书签","locateBookMark",5);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>演示：定位光标到指定书签</title>

    <script type="text/javascript">
//        function locateBookMark() {
//            //获取书签名称
//            var bkName = document.getElementById("txtBkName").value;
//            //将光标定位到书签所在的位置
//            document.getElementById("PageOfficeCtrl1").Document.Bookmarks(bkName).Select();
//        }
        function locateBookMark() {
            //获取书签名称
            var bkName = document.getElementById("txtBkName").value;
            //将光标定位到书签所在的位置
            var mac = "Function myfunc()" + " \r\n"
                    + "  ActiveDocument.Bookmarks(\""+ bkName +"\").Select " + " \r\n"
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        }
    </script>

</head>
<body>
    <div style=" font-size:small; color:Red;">
        <label>关键代码：点右键，选择“查看源文件”，看js函数：</label>
        <label>function  locateBookMark()</label>
        <br/>
    <label>将光标定位到书签前，请先在文本框中输入要定位到的书签名称（可点击Office工具栏上的“插入”→“书签”，来查看当前Word文档中所有的书签名称）！</label><br />
        <label>书签名称：</label><input id="txtBkName" type="text" value="PO_seal" />
    </div>
    <br />
    <form id="form1">
    <div style="width:auto; height:700px;">
        <!--**************   PageOffice 客户端代码开始    ************************-->
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?> 
        <!--**************   PageOffice 客户端代码结束    ************************-->
    </div>
    </form>
</body>
</html>
