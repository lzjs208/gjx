<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");	
	$sheet = $workbook->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlBorderLineStyle = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderLineStyle");
	$color = new Java("java.awt.Color");
	
	// ���ñ���
	$backGroundTable = $sheet->openTable("A1:P200");
	//���ñ��߿���ʽ
	$backGroundTable->getBorder()->setLineColor($color->white);

	// ���õ�Ԫ��߿���ʽ
	$C4Border = $sheet->openTable("C4:C4")->getBorder();
	$C4Border->setWeight($xlBorderWeight->xlThick);
	$C4Border->setLineColor($color->yellow);
	$C4Border->setBorderType($xlBorderType->xlAllEdges);

	// ���õ�Ԫ��߿���ʽ
	$B6Border = $sheet->openTable("B6:B6")->getBorder();
	$B6Border->setWeight($xlBorderWeight->xlHairline);
	$B6Border->setLineColor($color->magenta);
	$B6Border->setLineStyle($xlBorderLineStyle->xlSlantDashDot);
	$B6Border->setBorderType($xlBorderType->xlAllEdges);

	//���ñ��߿���ʽ
	$titleTable = $sheet->openTable("B4:F5");
	$titleTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$titleTable->getBorder()->setLineColor($color->blue);
	$titleTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);

	//���ñ��߿���ʽ
	$bodyTable2 = $sheet->openTable("B6:F15");
	$bodyTable2->getBorder()->setWeight($xlBorderWeight->xlThick);
	$bodyTable2->getBorder()->setLineColor($color->blue);
	$bodyTable2->getBorder()->setBorderType($xlBorderType->xlAllEdges);
	
	$PageOfficeCtrl->setWriter($workbook);

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>���ñ����</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

	
		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">


				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>


	</body>
</html>
