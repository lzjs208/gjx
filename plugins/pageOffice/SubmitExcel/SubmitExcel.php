<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");
	//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$sheet = $workbook->openSheet("Sheet1");
	//����table��������table��������÷�Χ
	$table = $sheet->openTable("B4:F13");
	//����table������ύ���ƣ��Ա㱣��ҳ���ȡ�ύ������
	$table->setSubmitName("Info");
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsSubmitForm, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��򵥵��ύExcel�е�����</title>
		<script type="text/javascript">
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}
</script>
	</head>
	<body>
		<form id="form1">

			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
