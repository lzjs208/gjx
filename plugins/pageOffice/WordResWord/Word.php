<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = $_SERVER['SERVER_NAME'];//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����Ҫ����word�ļ���λ���ֶ�������ǩ,��ǩ�����ԡ�PO_��Ϊǰ׺
	//��DataRegion��ֵ,ֵ����ʽΪ��"[word]word�ļ�·��[/word]��[excel]excel�ļ�·��[/excel]��[image]ͼƬ·��[/image]"
	$data1 = $doc->openDataRegion("PO_p1");
	$data1->setValue("[word]doc/1.doc[/word]");
	$data2 = $doc->openDataRegion("PO_p2");
	$data2->setValue("[word]doc/2.doc[/word]");
	$data3 = $doc->openDataRegion("PO_p3");
	$data3->setValue("[word]doc/3.doc[/word]");
    $PageOfficeCtrl->setWriter($doc);
	
	$PageOfficeCtrl->setCaption("��ʾ����̨��̲���Word�ļ�����������");

	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//�����Զ��幤����
	$PageOfficeCtrl->setCustomToolbar(false);
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��̨��̲���Word�ļ�����������</title>
	</head>
	<body>
		<div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        �ؼ����룺<span style="background-color: Yellow;"> <br />$dataRegion
            = $doc->openDataRegion("PO_��ͷ����ǩ����");
            <br />
            $dataRegion->setValue("[word]doc/1.doc[/word]");</span><br />
    </div>
		<br />
		<form id="form1">
			<div style="width: auto; height: 700px;">
				<!--**************   PageOffice �ͻ��˴��뿪ʼ    ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
				<!--**************   PageOffice �ͻ��˴������    ************************-->
			</div>
		</form>
	</body>
</html>