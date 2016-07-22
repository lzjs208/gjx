<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$wb = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");	
	$sheet = $wb->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$color = new Java("java.awt.Color");
	
	$cC3 = $sheet->openCell("C3");
	//���õ�Ԫ�񱳾���ʽ
	$cC3->setBackColor($color->LIGHT_GRAY);
	$cC3->setValue( "һ��");
	$cC3->setForeColor($color->white);
	$cC3->setHorizontalAlignment($xlHAlign->xlHAlignCenter);

	$cD3 = $sheet->openCell("D3");
	//���õ�Ԫ�񱳾���ʽ
	$cD3->setBackColor( $color->lightGray);
	$cD3->setValue( "����");
	$cD3->setForeColor($color->white);
	$cD3->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cE3 = $sheet->openCell("E3");
	//���õ�Ԫ�񱳾���ʽ
	$cE3->setBackColor( $color->lightGray);
	$cE3->setValue( "����");
	$cE3->setForeColor($color->white);
	$cE3->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB4 = $sheet->openCell("B4");
	//���õ�Ԫ�񱳾���ʽ
	$color2 = new Java("java.awt.Color", 10,254,254);
	$cB4->setBackColor( $color2);
	$cB4->setValue( "ס��");
	$color3 = new Java("java.awt.Color", 10,150,150);
	$cB4->setForeColor( $color3);
	$cB4->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB5 = $sheet->openCell("B5");
	//���õ�Ԫ�񱳾���ʽ
	$cB5->setBackColor( $color3);
	$cB5->setValue( "����");
	$color4 = new Java("java.awt.Color", 10,100,250);
	$cB5->setForeColor( $color4);
	$cB5->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB6 = $sheet->openCell("B6");
	//���õ�Ԫ�񱳾���ʽ
	$color5 = new Java("java.awt.Color", 200,200,100);
	$cB6->setBackColor($color5);
	$cB6->setValue( "����");
	$cB6->setForeColor($color3);
	$cB6->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	$cB7 = $sheet->openCell("B7");
	//���õ�Ԫ�񱳾���ʽ
	$color6 = new Java("java.awt.Color", 80,50,80);
	$cB7->setBackColor($color6);
	$cB7->setValue( "ͨѶ");
	$cB7->setForeColor( $color3);
	$cB7->setHorizontalAlignment( $xlHAlign->xlHAlignCenter);

	//���Ʊ����
	$titleTable = $sheet->openTable("B3:E10");
	$titleTable->getBorder()->setWeight($xlBorderWeight->xlThick);
	$color7 = new Java("java.awt.Color", 0, 128, 128);
	$titleTable->getBorder()->setLineColor($color7);
	$titleTable->getBorder()->setBorderType($xlBorderType->xlAllEdges);

	$sheet->openTable("B1:E2")->merge();//�ϲ���Ԫ��
	$sheet->openTable("B1:E2")->setRowHeight( 30);//�����и�
	$B1 = $sheet->openCell("B1");
	//���õ�Ԫ���ı���ʽ
	$B1->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$B1->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	$B1->setForeColor( $color7);
	$B1->setValue( "���֧Ԥ��");
	$B1->getFont()->setBold(true);
	$B1->getFont()->setSize(25);
	
	$PageOfficeCtrl->setWriter($wb);

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.xls", $OpenMode->xlsNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��������ͱ���ɫ</title>
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
