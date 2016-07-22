
<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$id = $_REQUEST["ID"];
	$query = "select * from leaveRecord where ID = " . $id;
	$rs = $conn->Execute($query); 

	$docSubject = ""; $docName = ""; $docDept = ""; $docCause = ""; $docNum = ""; $docFile = ""; $docSubmitTime = "";
	if (!$rs->EOF) {
		$docFile = $rs->Fields["FileName"]->value;
		$docName = $rs->Fields["Name"]->value;
		$docDept = $rs->Fields["Dept"]->value;
		$docCause = $rs->Fields["Cause"]->value;
		$docNum = $rs->Fields["Num"]->value;
		$docSubmitTime = $rs->Fields["SubmitTime"]->value;
	}

	//-----------  PageOffice 服务器端编程开始  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$borderStyleType = new Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
	$doc->setDisableWindowRightClick(true);
	$doc->openDataRegion("PO_name")->setValue($docName);
	$doc->openDataRegion("PO_dept")->setValue($docDept);
	$doc->openDataRegion("PO_cause")->setValue($docCause);
	$doc->openDataRegion("PO_num")->setValue($docNum);
	date_default_timezone_set("Asia/Shanghai");
	$doc->openDataRegion("PO_date")->setValue(date("Y-m-d", strtotime($docSubmitTime)));
	$doc->openDataRegion("PO_tip")->setValue("");
    $PageOfficeCtrl->setWriter($doc);
	
	// 设置界面样式
	$PageOfficeCtrl->setCaption("用户填写请假条");
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	// 添加自定义工具条按钮
	$PageOfficeCtrl->addCustomToolButton("打印", "poPrint", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原", "poSetFullScreen", 4);
	//隐藏工具栏
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setMenubar(false);
	
	// 设置保存文档的服务器页面
	$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=" . $id);

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docReadOnly, "Tom");//此行必须
	//-----------  PageOffice 服务器端编程结束  -------------------//
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD>
		<title>GenDoc</title>
		<meta name="GENERATOR" Content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" Content="C#">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema"
			content="http://schemas.microsoft.com/intellisense/ie5">
	</HEAD>
	<body>
		<script type="text/javascript">
			function poPrint() {
				document.getElementById("PageOfficeCtrl1").ShowDialog(4);
			}
			function poSetFullScreen() {
				document.getElementById("PageOfficeCtrl1").FullScreen = !document
						.getElementById("PageOfficeCtrl1").FullScreen;
			}
		</script>
		<form id="Form1" method="post">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</form>
	</body>
</HTML>

