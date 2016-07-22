
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

	//-----------  PageOffice �������˱�̿�ʼ  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
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
	
	// ���ý�����ʽ
	$PageOfficeCtrl->setCaption("�û���д�����");
	$PageOfficeCtrl->setBorderStyle($borderStyleType->BorderThin);
	// ����Զ��幤������ť
	$PageOfficeCtrl->addCustomToolButton("��ӡ", "poPrint", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "poSetFullScreen", 4);
	//���ع�����
	$PageOfficeCtrl->setOfficeToolbars(false);
	$PageOfficeCtrl->setMenubar(false);
	
	// ���ñ����ĵ��ķ�����ҳ��
	$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=" . $id);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docReadOnly, "Tom");//���б���
	//-----------  PageOffice �������˱�̽���  -------------------//
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

