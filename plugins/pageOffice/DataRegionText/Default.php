<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$color = new Java("java.awt.Color");
	//����������
	$d1 = $doc->openDataRegion("d1");
	//����������ʽ	
    $d1->getFont()->setColor($color->blue);//�������������ı�������ɫ
    $d1->getFont()->setSize(16);//�������������ı������С
    $d1->getFont()->setName("���Ĳ���");//�������������ı�������ʽ	
	$d1->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);//�������������ı����뷽ʽ
	
	$d2 = $doc->openDataRegion("d2");
	//����������ʽ
    $d2->getFont()->setColor($color->orange);//�������������ı�������ɫ
    $d2->getFont()->setSize(14);//�������������ı������С
    $d2->getFont()->setName("����");//�������������ı�������ʽ	
	$d2->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);//�������������ı����뷽ʽ
	
	$d3 = $doc->openDataRegion("d3");
	//����������ʽ
    $d3->getFont()->setColor($color->magenta);//�������������ı�������ɫ
    $d3->getFont()->setSize(12);//�������������ı������С
    $d3->getFont()->setName("�����п�");//�������������ı�������ʽ	
	$d3->getParagraphFormat()->setAlignment($wdParagraphAlignment->wdAlignParagraphRight);//�������������ı����뷽ʽ
	
	$PageOfficeCtrl->setWriter($doc);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>�������������ı�����ʽ</title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>

		<div id="content">
			��ʾ�����ʹ�ó���������������ı�����ʽ��<a href="Default2.php" target="_blank">������Ӳ鿴ԭ�ļ�</a><br /><br />
			<div id="textcontent" style="width: 1000px; height: 800px;">

				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>
