<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = gethostbyname($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");	
	$sheet = $workbook->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	
	//����Cell����
	$cellB4 = $sheet->openCell("B4");
	//����Ԫ��ֵ
	$cellB4->setValue("1��");

	$cellC4 = $sheet->openCell("C4");
	$cellC4->setValue("300");

	$cellD4 = $sheet->openCell("D4");
	$cellD4->setValue("270");

	$cellE4 = $sheet->openCell("E4");
	$cellE4->setValue("270");

	$cellF4 = $sheet->openCell("F4");
	$cellF4->setValue(round( 270.00 / 300*100, 2)."%");
	
	$PageOfficeCtrl->setWriter($workbook);
	
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//���ع�����
	$PageOfficeCtrl->setCustomToolbar(false); 

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>���Excel���</title>

		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

	</head>

	<body>
		<div style="width: auto; height: 700px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
