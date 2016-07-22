<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$PageOfficeCtrl->setCaption("�򵥵ĸ�Excel��ֵ");	
	$sheet = $workbook->openSheet("Sheet1");//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$color = new Java("java.awt.Color");
	
	//�ϲ���Ԫ��
	$sheet->openTable("B2:F2")->merge();
	$cB2 = $sheet->openCell("B2");
	$cB2->setValue("����ĳ��˾��Ʒ�������");
	//����ˮƽ���뷽ʽ
	$cB2->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$cB2->setForeColor($color->red);
	$cB2->getFont()->setSize(16);

	$sheet->openTable("B4:B6")->merge();
	$cB4 = $sheet->openCell("B4");
	$cB4->setValue("A��Ʒ");
	//����ˮƽ���뷽ʽ
	$cB4->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	//���ô�ֱ���뷽ʽ
	$cB4->setVerticalAlignment($xlVAlign->xlVAlignCenter);

	$sheet->openTable("B7:B9")->merge();
	$cB7 = $sheet->openCell("B7");
	$cB7->setValue("B��Ʒ");
	$cB7->setHorizontalAlignment($xlHAlign->xlHAlignCenter);
	$cB7->setVerticalAlignment($xlVAlign->xlVAlignCenter);
	
	$PageOfficeCtrl->setWriter($workbook);
	
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
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>�ϲ�Excel�ĵ�Ԫ�����ø�ʽ�͸�ֵ</title>
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
