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
	
	//����Table����
	$table = $sheet->openTable("B4:F13");
    for($i=0; $i < 50; $i++)
    { 
        $table->getDataFields()->get(0)->setValue("��Ʒ ".$i);
        $table->getDataFields()->get(1)->setValue("100");
        $table->getDataFields()->get(2)->setValue((string)(100+$i));
        $table->nextRow();
    }
    $table->close();
	
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
		<title>ʹ��OpenTable������excel�������</title>

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
		�˱���е�������ʹ�ú�̨��������ȥ�ģ���鿴Table.php�Ĵ��룬ʹ�õ�OpenTable�ķ���������ʵ����������������ѭ��ʹ��ԭģ��Table����B4:F13����Ԫ����ʽ��
		<div style="width: 1000px; height: 700px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
