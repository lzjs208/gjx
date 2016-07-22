<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存","Save",1);
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened()"); 
	//设置保存页面
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张佚名");//编辑模式打开word文档，此行必须
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
    <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("Text1").value = document.getElementById("PageOfficeCtrl1").DataRegionList.GetDataRegionByName("PO_Title").Value;
        }

        function setTitleText() {
            document.getElementById("PageOfficeCtrl1").DataRegionList.GetDataRegionByName("PO_Title").Value = document.getElementById("Text1").value;
        }
    </script>
<p style=" text-indent:10px;" >
        PageOffice 3.0在2.0版本的基础上增加了全新的文件打开方式“PageOfficeLink 方式”，此方式提供了更完美的浏览器兼容性解决方案。
        </p>
        <p style=" text-indent:10px;" >
        <span style=" font-weight:bold;"> PageOfficeLink ：简称POL</span>，是卓正公司为PageOffice在线打开文档的页面专门开发的特殊超链接；
        </p>
        <p style=" text-indent:10px;" >
       
            常规打开文档超链接的代码写法：&lt;a href=&quot;Word.php?id=12&quot;&gt;某某公司公文-12&lt;a&gt;</p>
        <p style=" text-indent:10px;" >
            POL打开文档超链接的代码写法：
       &lt;a href=&quot;<span style=" background-color:#D2E9FF;">&lt;?php echo $pageOfficeLink->openWindow(null, &quot;</span>http://localhost/Samples/PageOfficeLink/Word.php?id=12<span style=" background-color:#D2E9FF;">&quot;,&quot;width=800px;height=800px;&quot;); ?&gt;</span>&quot;&gt;
     
            某某公司公文-12&lt;a&gt;
            &nbsp;</p>
	文档标题：<input id="Text1" type="text" size="50"      />
	<input type="button" value="修改" onclick="setTitleText();" />
    <form id="form1" >
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
