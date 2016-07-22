<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	$PageOfficeCtrl->setMenubar(false); //隐藏菜单栏
	$PageOfficeCtrl->addCustomToolButton("保存","Save()",1);
	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$_GET['filename'], $OpenMode->docNormalEdit, "张三");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <link href="../images/csstg.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
            //alert('保存成功！');
        }
    </script>

</head>
<body>
    <form id="form2">
    <div id="header">
        <div style="float: left; margin-left: 20px;">
            <img src="../images/logo.jpg" height="30" /></div>
        <ul>
            <li><a href="#">卓正网站</a></li>
            <li><a href="#">客户问吧</a></li>
            <li><a href="#">在线帮助</a></li>
            <li><a href="#">联系我们</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
            <div class="flow4">
                <a href="word-lists.php">
                    <img alt="返回" src="../images/return.gif" border="0" />文件列表</a>&nbsp;&nbsp;<strong>文档主题：</strong> <span style="color: Red;">
                        <?php echo $_REQUEST["subject"];?></span> <span style="width: 100px;">
                        </span>
            </div>
			<!-- ****************************PageOffice 组件客户端编程************************************* -->
		   <script type="text/javascript">
		   		function Save(){
		   			document.getElementById("PageOfficeCtrl1").WebSave();
		   		}
		   </script>
		   <!-- ****************************PageOffice 组件客户端编程结束************************************* -->
		   <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 北京卓正志远软件有限公司</div>
    </div>
    </form>
</body>
</html>
