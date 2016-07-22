<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	//设置打开的Word文档的主题
	$themeType = new Java("com.zhuozhengsoft.pageoffice.ThemeType");//此行必须
	$PageOfficeCtrl->setTheme($themeType->Office2007);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>演示：修改Word文档的主题样式</title>
    <style>
        html, body
        {
            height: 100%;
        }
        .main
        {
            height: 100%;
        }
    </style>
</head>
<body>
    <form id="form1">
    <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        操作：在Html页面添加PageOfficeCtrl控件，再在后台设置PageOfficeCtrl的Theme属性<br />
        关键代码：<span style="background-color:Yellow;">$PageOfficeCtrl->setTheme($themeType->Office2007);//$PageOfficeCtrl为PageOfficeCtrl对象，$themeType为ThemeType对象，ThemeType为枚举类型</span>
    </div>
    <div style="height: 600px; width: auto;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
