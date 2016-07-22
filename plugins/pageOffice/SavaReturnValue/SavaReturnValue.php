<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
	$PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	//设置PageOfficeCtrl控件的标题栏名称
	$PageOfficeCtrl->setCaption("Word文档保存后获取返回值");
	//隐藏菜单栏
	$PageOfficeCtrl->setMenubar(false);
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存","Save()",1);
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
       <title>Word文档保存后获取返回值</title>
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
            //document.getElementById("PageOfficeCtrl1").CustomSaveResult获取的是保存页面的返回值
            document.getElementById("PageOfficeCtrl1").Alert("保存成功，返回值为：" + document.getElementById("PageOfficeCtrl1").CustomSaveResult);
        }
 
    </script>
</head>
<body>
    <form id="form1">
    <div style=" font-size:small; color:Red;">
        <label>键代码：点右键，选择“查看源文件”，看js函数“Save()</label>
        <br />document.getElementById("PageOfficeCtrl1").WebSave()//执行保存操作"
        <br/>document.getElementById("PageOfficeCtrl1").CustomSaveResult//获取返回值保存页面SaveFile.php代码fs.setCustomSaveResult("ok");定义的返回值
        <br />
    </div>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
