<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	//打开数据区域，openDataRegion方法的参数代表Word文档中的书签名称
	$dataRegion1 = $doc->openDataRegion("PO_userName");
	//设置DataRegion的可编辑性
	$dataRegion1->setEditing(true);
	//为DataRegion赋值,此处的值可在页面中打开Word文档后自己进行修改
	$dataRegion1->setValue("");

	$dataRegion2 = $doc->openDataRegion("PO_deptName");
	$dataRegion2->setEditing(true);
	$dataRegion2->setValue("");
	
	$PageOfficeCtrl->setWriter($doc);
	
	//添加自定义按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "Save", 1);
	//设置保存页面
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>最简单的提交Word中的数据</title>
		<script type="text/javascript">
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}
</script>
	</head>
	<body>
		<form id="form1">
			<div>
				<span style="color: Red; font-size: 14px;">请输入公司名称、年龄、部门等信息后，单击工具栏上的保存按钮</span>
				<br />
				<span style="color: Red; font-size: 14px;">请输入公司名称：</span>
				<input id="txtName" name="txtCompany" type="text" />
				<br />
			</div>
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
