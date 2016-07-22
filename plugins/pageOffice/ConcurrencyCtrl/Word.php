<?php
	$userName = "somebody";
	$userId = $_GET['userid'];
	if (strcasecmp($userId, "1") == 0)
	{
		$userName = "张三";
	}
	else
	{
		$userName = "李四";
	}
	
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置编码格式 
	
	$PageOfficeCtrl->addCustomToolButton("保存","Save",1);
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//设置并发控制时间(单位：分钟)
	$PageOfficeCtrl->setTimeSlice(20);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docRevisionOnly, $userName);//此行必须
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>最简单的打开保存Word文件</title>
</head>
<body>
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
    <form id="form1" >
    当前用户： <?php echo $userName; ?>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
