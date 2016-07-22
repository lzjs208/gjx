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
	$PageOfficeCtrl->addCustomToolButton("在当前光标处用js插入超链接","addHyperLink",5);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>演示：在当前光标处用js插入超链接</title>
    <style>
        html,body{height:100%; }
        .main{height:700px; width:auto; }
    </style>
</head>
<body>
    <script type="text/javascript">
//    function  addHyperLink()
//    {
//        var docObj = document.getElementById("PageOfficeCtrl1").Document;
//        docObj.Application.ActiveWindow.View.ShowFieldCodes = false; //不要以域代码的形式显示超链接
//	    docObj.Hyperlinks.Add(docObj.Application.Selection.Range, "http://www.zhuozhengsoft.com/", "", "", "卓正");
//	}

    function  addHyperLink()
    {
        var text = "卓正志远";
        var url = "http://www.zhuozhengsoft.com/";
        
        var mac = "Function myfunc()" + " \r\n"
                    + "  Application.ActiveWindow.View.ShowFieldCodes = False " + " \r\n"
                    + "  ActiveDocument.Hyperlinks.Add Anchor:=Selection.Range, Address:= _" + " \r\n"
                    + "   \"" + url + "\", SubAddress:=\"\", ScreenTip:=\"\", _ " + " \r\n" 
                    + "   TextToDisplay:=\""+text+"\" " + " \r\n" 
                    + "End Function " + " \r\n";
        document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
	}    
    </script>
    <div style="font-size:12px; line-height:20px; border-bottom:dotted 1px #ccc;border-top:dotted 1px #ccc; padding:5px;">
     <span style="color:red;">操作说明：</span>定位word文件中的光标到想插入超链接的位置，然后点“插入超链”按钮。<br />
   
    关键代码：点右键，选择“查看源文件”，看js函数<span style="background-color:Yellow;">addHyperLink()</span></div><br />
    <form id="form1" style="height:100%;">
    <div class="main">
    <!--**************   PageOffice 客户端代码开始    ************************-->
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?> 
    <!--**************   PageOffice 客户端代码结束    ************************-->
    </div>
    </form>
</body>
</html>
