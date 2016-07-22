
<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$id = $_REQUEST["ID"];
	$query = "select * from leaveRecord where ID = " . $id;
	$rs = $conn->Execute($query); 

	$docSubject = ""; $docName = ""; $docDept = ""; $docCause = ""; $docNum = ""; $docFile = ""; $docDate = "";
	
	if (!$rs->EOF) {
		$docFile = $rs->Fields["FileName"]->value;
		$docSubject = $rs->Fields["Subject"]->value;
		$docName = $rs->Fields["Name"]->value;
		$docDept = $rs->Fields["Dept"]->value;
		$docCause = $rs->Fields["Cause"]->value;
		$docNum = $rs->Fields["Num"]->value;
		$docDate = $rs->Fields["SubmitTime"]->value;
	}
	
	//-----------  PageOffice 服务器端编程开始  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$borderStyleType = new Java("com.zhuozhengsoft.pageoffice.BorderStyleType");
	$color = new Java("java.awt.Color");
	
	$drName = $doc->openDataRegion("PO_name");
	$drName->setValue($docName);
	$drName->setEditing(true);
	$drDept = $doc->openDataRegion("PO_dept");
	$drDept->setValue($docDept);
	$drDept->getShading()->setBackgroundPatternColor($color->GRAY); 
	$drCause = $doc->openDataRegion("PO_cause");
	$drCause->setValue($docCause);
	$drCause->setEditing(true);
	$drNum = $doc->openDataRegion("PO_num");
	$drNum->setValue($docNum);
	$drNum->setEditing(true);
	$drDate = $doc->openDataRegion("PO_date");
	date_default_timezone_set("Asia/Shanghai");
	$drDate->setValue(date("Y-m-d", strtotime($docDate)));
	$drDate->getShading()->setBackgroundPatternColor($color->pink);
	$drTip = $doc->openDataRegion("PO_tip");
	$drTip->getFont()->setItalic(true);
	$drTip->setValue("提示：带背景色的文字是只能通过选择设置，[]中的文字是可以录入编辑的。");
	
	// 设置PageOffice组件服务页面
	$doc->getWaterMark()->setText("PageOffice平台");

	// 设置界面样式
	$PageOfficeCtrl->setCaption("用户填写请假条");
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	// 添加自定义工具条按钮
	$PageOfficeCtrl->addCustomToolButton("保存", "poSave()", 1);
	$PageOfficeCtrl->addCustomToolButton("全屏/还原", "poSetFullScreen()", 4);
	//隐藏工具栏
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setMenubar(false);

	$PageOfficeCtrl->setJsFunction_OnWordDataRegionClick("OnWordDataRegionClick()");
	// 设置保存文档的服务器页面
	$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=" . $id);
	////获取数据对象
	$PageOfficeCtrl->setWriter($doc);
	
	//打开excel文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docSubmitForm, "Tom");//此行必须
	//-----------  PageOffice 服务器端编程结束  -------------------//
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<title>用户填写请假条</title>
		<meta name="GENERATOR" Content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" Content="C#">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema"
			content="http://schemas.microsoft.com/intellisense/ie5">
	</HEAD>
	<body>
		<script language="JavaScript">
	function OnWordDataRegionClick(Name, Value, Left, Bottom) {
		if (Name == "PO_date") {
	                var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("datetimer.htm", Value, "left=" + Left + "px;top=" + Bottom + "px;width=260px;height=260px;frame=no;");
	                if (strRet != "") {
	                    return (strRet);
	                }
	                else {
	                    if ((Value == undefined) || (Value == ""))
	                        return " ";
	                    else
	                        return Value;
	                }
	            }
	            if (Name == "PO_dept") {

	                var strRet = document.getElementById("PageOfficeCtrl1").ShowHtmlModalDialog("selectDept.htm", Value, "left=" + Left + "px;top=" + Bottom + "px;width=260px;height=260px;frame=no;");
	                if (strRet != "") {
	                    return (strRet);
	                }
	                else {
	                    if ((Value == undefined) || (Value == ""))
	                        return " ";
	                    else
	                        return Value;
	                }
	            }
	}
</script>
		<form id="Form1" method="post">

			<!-- *********************pageoffice组件的使用 **************************-->
			<script type="text/javascript">
				//保存
				function poSave() {
					document.getElementById("PageOfficeCtrl1").WebSave();
				}
				//全屏
				function poSetFullScreen() {
					document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
				}
			</script>
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			<!-- *********************pageoffice组件的使用 **************************-->

		</form>
	</body>
</HTML>
