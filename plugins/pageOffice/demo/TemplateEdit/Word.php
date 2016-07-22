<?php
	$type = $_REQUEST["type"];
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$doc->setEnableAllDataRegionsEditing(true); // 此属性可以设置在提交模式（docSubmitForm）下，所有的数据区域可以编辑
	$doc->openDataRegion("Name")->setValue("张三");        
	$doc->openDataRegion("Address")->setValue("北京市丰台区南四环西路xxx号");  
	$doc->openDataRegion("Tel")->setValue("010-88882222");  
	$doc->openDataRegion("Phone")->setValue("13822225555");  
	$doc->openDataRegion("Sex")->setValue("男");  
	$doc->openDataRegion("Age")->setValue("21");  

	$doc->openDataTag("{ 甲方公司名称 }")->setValue("微软中国总部"); 
	$doc->openDataTag("{ 乙方公司名称 }")->setValue( "北京幻想科技公司"); 
	$doc->openDataTag("【 合同日期 】")->setValue("2014年08月01日"); 
	$doc->openDataTag("【 合同编号 】")->setValue("201408010001"); 
	
    $PageOfficeCtrl->setWriter($doc);
	
    //打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");	
	$type = $_REQUEST["type"];		
	if (strcasecmp("1", $type) == 0)
	{
		$PageOfficeCtrl->addCustomToolButton("保存", "Save2()", 1);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "zhangsan");//此行必须
	}
	else if (strcasecmp("2", $type) == 0)
	{
		$PageOfficeCtrl->setMenubar(true);
		$PageOfficeCtrl->setCustomToolbar(false);
		$PageOfficeCtrl->setOfficeToolbars(false);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docReadOnly, "zhangsan");//此行必须
	}
	else if (strcasecmp("3", $type) == 0)
	{
		$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
		$PageOfficeCtrl->setSaveDataPage("SaveData.php");
		$PageOfficeCtrl->setOfficeToolbars(false);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "zhangsan");//此行必须
	}	

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
	 <script type="text/javascript">
        function Save2() {
            document.getElementById("PageOfficeCtrl1").Alert("此效果只是演示编辑模式生成文件，没有做保存功能。");
        }
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>

</head>
<body>
    <form action="">
    <div style="width: 1000px; height: 800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>