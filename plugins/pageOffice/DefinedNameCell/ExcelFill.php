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
	$sheet->openCellByDefinedName("testA1")->setValue("Tom");
	$sheet->openCellByDefinedName("testB1")->setValue("John");
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	
	$PageOfficeCtrl->setSaveDataPage("SaveData.php");
	$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);   

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��Excel�ĵ��ж������Ƶĵ�Ԫ��ֵ</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->
	<script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
	</head>

	<body>
	A1��B1��Ԫ���������ʹ�ú�̨��������ȥ�ģ���鿴ExcelFill.php�Ĵ���
		<div style="width: 1000px; height: 800px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
