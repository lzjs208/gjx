<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����������
	$dataReg = $doc->openDataRegion("PO_table");
	$table = $dataReg->openTable(1);
	//�ϲ�table�еĵ�Ԫ��
	$table->openCellRC(1, 1)->mergeTo(1, 4);
	//���ϲ���ĵ�Ԫ��ֵ
	$table->openCellRC(1, 1)->setValue("���������");
	//���õ�Ԫ���ı���ʽ
	$color = new Java("java.awt.Color");
	$table->openCellRC(1, 1)->getFont()->setColor($color->red);
	$table->openCellRC(1, 1)->getFont()->setSize(24);
	$table->openCellRC(1, 1)->getFont()->setName("����");
	$WdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$table->openCellRC(1, 1)->getParagraphFormat()->setAlignment($WdParagraphAlignment->wdAlignParagraphCenter);			
	
	$PageOfficeCtrl->setWriter($doc);
	//���ع�����
	$PageOfficeCtrl->setCustomToolbar(false);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>�ϲ�word��Ԫ��</title>
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