<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏", "SetFullScreen()", 4);
	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php?id=1");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>传递参数</title>

    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function SetFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }
    </script>

</head>
<body>
    <form id="form1">
    <div style="font-size: 14px;">
        <span style="color: Red;">更新人员信息：</span><br />
        <input id="Hidden1" name="age" type="hidden" value="25" />
        <span style="color: Red;">姓名：</span><input id="Text1" name="userName" type="text" value="张三" /><br />
        <span style="color: Red;">性别：</span><select id="Select1" name="selSex">
            <option value="男">男</option>
            <option value="女">女</option>
        </select>
    </div>
    <div style="width: auto; height: 700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
