
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
	
	//-----------  PageOffice �������˱�̿�ʼ  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
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
	$drTip->setValue("��ʾ��������ɫ��������ֻ��ͨ��ѡ�����ã�[]�е������ǿ���¼��༭�ġ�");
	
	// ����PageOffice�������ҳ��
	$doc->getWaterMark()->setText("PageOfficeƽ̨");

	// ���ý�����ʽ
	$PageOfficeCtrl->setCaption("�û���д�����");
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	// ����Զ��幤������ť
	$PageOfficeCtrl->addCustomToolButton("����", "poSave()", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "poSetFullScreen()", 4);
	//���ع�����
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setMenubar(false);

	$PageOfficeCtrl->setJsFunction_OnWordDataRegionClick("OnWordDataRegionClick()");
	// ���ñ����ĵ��ķ�����ҳ��
	$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=" . $id);
	////��ȡ���ݶ���
	$PageOfficeCtrl->setWriter($doc);
	
	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docSubmitForm, "Tom");//���б���
	//-----------  PageOffice �������˱�̽���  -------------------//
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<title>�û���д�����</title>
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

			<!-- *********************pageoffice�����ʹ�� **************************-->
			<script type="text/javascript">
				//����
				function poSave() {
					document.getElementById("PageOfficeCtrl1").WebSave();
				}
				//ȫ��
				function poSetFullScreen() {
					document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
				}
			</script>
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			<!-- *********************pageoffice�����ʹ�� **************************-->

		</form>
	</body>
</HTML>
