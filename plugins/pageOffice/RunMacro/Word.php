<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面

	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//隐藏自定义工具栏
	$PageOfficeCtrl->setCustomToolbar(false);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>执行宏命令</title>

    <script language="javascript" type="text/javascript">
// <!CDATA[

        function Button1_onclick() {
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", document.getElementById("textarea1").value);
        }

// ]]>
    </script>
</head>
<body>
    <form id="form1">
    <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        注意：<span style="background-color: Yellow;">执行“执行宏myfunc”按钮之前需先设置好MS Word的关于执行宏命令的设置。
        <br />设置步骤如下：打开一个Word文档，点击“文件”→“选项”→“信任中心”→“信任中心设置”→“宏设置”→勾选上“信任对VBA工程对象模型的访问（V）”</span>
    </div>
    <textarea id="textarea1" name="textarea1" style=" height:87px; width:486px;" rows="" cols="" >
sub myfunc()  
    msgbox "123" 
end sub
    </textarea>
    <input id="Button1" type="button" value="执行宏myfunc" onclick="return Button1_onclick()" />
    <div style=" height:800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>

