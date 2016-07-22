<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	$wdParagraphAlignment = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdParagraphAlignment");
	$wdLineSpacing = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WdLineSpacing");
	$color = new Java("java.awt.Color");
	//�������ݱ���

	//����DataRegion����PO_titleΪ�Զ���ӵ���ǩ����,��ǩ�������ԡ�PO_��Ϊǰ׺������ǩ���Ʋ����ظ�
	//���������ֱ�ΪҪ�²�����ǩ�����ơ�����ǩ�Ĳ���λ�á����������ǩ���ƣ���[home]������Word�ĵ��ĵ�һ��λ�ã�
	$title = $doc->createDataRegion("PO_title",$dataRegionInsertType->After, "[home]");
	//��DataRegion����ֵ
	$title->setValue("C#��Socket���̱߳��ʵ��\n");
	//�������壺��ϸ����С���������ơ��Ƿ���б��
	$title->getFont()->setBold(true);
	$title->getFont()->setSize(20);
	$title->getFont()->setName("����");
	$title->getFont()->setItalic(false);
	//����������
	$titlePara = $title->getParagraphFormat();
	//���ö�����뷽ʽ
	$titlePara->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
	//���ö����м��
	$titlePara->setLineSpacingRule($wdLineSpacing->wdLineSpaceMultiple);
	
	//��������
	//��һ��
	//����DataRegion����PO_bodyΪ�Զ���ӵ���ǩ����
	$body = $doc->createDataRegion("PO_body",$dataRegionInsertType->After, "PO_title");
	//�������壺��ϸ���Ƿ���б�塢��С���������ơ�������ɫ
	$body->getFont()->setBold(false);
	$body->getFont()->setItalic(true);
	$body->getFont()->setSize(10);
	//����������������
	$body->getFont()->setName("����");
	//����Ӣ����������
	$body->getFont()->setName("Times New Roman");
	$body->getFont()->setColor($color->RED);
	//��DataRegion����ֵ
	$body->setValue("��΢������VS.net���Ƴ���һ�����ԡ�����Ϊһ�����˵����ԣ�����C++��ǿ����������VB�ȵ�RAD���ԡ����ң�΢���Ƴ�C#��Ҫ��Ŀ����Ϊ�˶Կ�Sun��˾��Java����Ҷ�֪��Java���Ե�ǿ���ܣ������������̷��档���ǣ�C#�������̷���Ҳ��Ȼ����������ˡ����ľ����ҽ���һ��C#��ʵ���׽��֣�Sockets����̵�һЩ����֪ʶ��������ʹ��ҶԴ��и������˽⡣���ȣ������ҽ���һ���׽��ֵĸ��\n");
	//����ParagraphFormat����
	$bodyPara = $body->getParagraphFormat();
	//���ö�����м�ࡢ���뷽ʽ����������
	$bodyPara->setLineSpacingRule($wdLineSpacing->wdLineSpaceAtLeast);
	$bodyPara->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara->setFirstLineIndent(21);
	
	//�ڶ���
	$body2 = $doc->createDataRegion("PO_body2",$dataRegionInsertType->After, "PO_body");
	$body2->getFont()->setBold(false);
	$body2->getFont()->setSize(12);
	$body2->getFont()->setName("����");
	$body2->setValue("�׽�����ͨ�ŵĻ�ʯ����֧��TCP/IPЭ�������ͨ�ŵĻ���������Ԫ�����Խ��׽��ֿ�����ͬ������Ľ��̽���˫��ͨ�ŵĶ˵㣬�������˵��������ڼ����������ı�̽��档�׽��ִ�����ͨ�����У�ͨ������Ϊ�˴���һ����߳�ͨ���׽���ͨ�Ŷ�������һ�ֳ������׽���ͨ����ͬһ�����е��׽��ֽ������ݣ����ݽ���Ҳ���ܴ�Խ��Ľ��ޣ�����ʱһ��Ҫִ��ĳ�ֽ��ͳ��򣩡����ֽ���ʹ�������ͬ������֮����InternetЭ���������ͨ�š�\n");
	//body2->setValue("[image]../images/logo.jpg[/image]");
	$bodyPara2 = $body2->getParagraphFormat();
	$bodyPara2->setLineSpacingRule($wdLineSpacing->wdLineSpace1pt5);
	$bodyPara2->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara2->setFirstLineIndent(21);
	
	//������
	$body3 = $doc->createDataRegion("PO_body3", $dataRegionInsertType->After, "PO_body2");
	$body3->getFont()->setBold(false);
	$color2 = new Java("java.awt.Color" , 0, 128, 228);
	$body3->getFont()->setColor($color2);
	$body3->getFont()->setSize(14);
	$body3->getFont()->setName("���Ĳ���");
	$body3->setValue("�׽��ֿ��Ը���ͨ�����ʷ��࣬�������ʶ����û��ǿɼ��ġ�Ӧ�ó���һ�����ͬһ����׽��ּ����ͨ�š�����ֻҪ�ײ��ͨ��Э��������ͬ���͵��׽��ּ�Ҳ��������ͨ�š��׽��������ֲ�ͬ�����ͣ����׽��ֺ����ݱ��׽��֡�\n");
	$bodyPara3 = $body3->getParagraphFormat();
	$bodyPara3->setLineSpacingRule($wdLineSpacing->wdLineSpaceDouble);
	$bodyPara3->setAlignment($wdParagraphAlignment->wdAlignParagraphLeft);
	$bodyPara3->setFirstLineIndent(21);

	$body4 = $doc->createDataRegion("PO_body4", $dataRegionInsertType->After, "PO_body3");
	$body4->setValue("[image]../images/logo.png[/image]");
	//body4->setValue("[word]doc/1.doc[/word]");//����Ƕ������Word�ļ�
	$bodyPara4 = $body4->getParagraphFormat();
	$bodyPara4->setAlignment($wdParagraphAlignment->wdAlignParagraphCenter);
	
	
    $PageOfficeCtrl->setWriter($doc);
	
	//����ҳ�汣���ִ�е�JS����
	$PageOfficeCtrl->setJsFunction_AfterDocumentSaved("SaveOK()");

	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	//$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
	//���ñ���ҳ��
	//$PageOfficeCtrl->setSaveFilePage("SaveFile.jsp");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��ȫ�������Word</title>
	</head>
	<body>
		<script type="text/javascript">
	function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
    }
</script>
		<form id="form1">
			<div style="width: auto; height: 700px;">
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
