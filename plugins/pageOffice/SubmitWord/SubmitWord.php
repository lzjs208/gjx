<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����������openDataRegion�����Ĳ�������Word�ĵ��е���ǩ����
	$dataRegion1 = $doc->openDataRegion("PO_userName");
	//����DataRegion�Ŀɱ༭��
	$dataRegion1->setEditing(true);
	//ΪDataRegion��ֵ,�˴���ֵ����ҳ���д�Word�ĵ����Լ������޸�
	$dataRegion1->setValue("");

	$dataRegion2 = $doc->openDataRegion("PO_deptName");
	$dataRegion2->setEditing(true);
	$dataRegion2->setValue("");
	
	$PageOfficeCtrl->setWriter($doc);
	
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��򵥵��ύWord�е�����</title>
		<script type="text/javascript">
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}
</script>
	</head>
	<body>
		<form id="form1">
			<div>
				<span style="color: Red; font-size: 14px;">�����빫˾���ơ����䡢���ŵ���Ϣ�󣬵����������ϵı��水ť</span>
				<br />
				<span style="color: Red; font-size: 14px;">�����빫˾���ƣ�</span>
				<input id="txtName" name="txtCompany" type="text" />
				<br />
			</div>
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
