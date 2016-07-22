<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����������
	$dTitle = $doc->openDataRegion("PO_title");
	//����������ֵ
	$dTitle->setValue("ĳ��˾�ڶ����Ȳ�������");
	//������������ɱ༭��
	$dTitle->setEditing(false);//�������򲻿ɱ༭

	$dA1 = $doc->openDataRegion("PO_A_pro1");
	$dA2 = $doc->openDataRegion("PO_A_pro2");
	$dB1 = $doc->openDataRegion("PO_B_pro1");
	$dB2 = $doc->openDataRegion("PO_B_pro2");

	$userName = $_REQUEST["userName"];
	//���ݵ�¼�û���������������ɱ༭��
	//A���ž����¼��
	if (strcasecmp($userName,"zhangsan")==0) {
		$userName = "A���ž���";
		$dA1->setEditing(true);
		$dA2->setEditing(true);
		$dB1->setEditing(false);
		$dB2->setEditing(false);
	}
	//B���ž����¼��
	else {
		$userName = "B���ž���";
		$dB1->setEditing(true);
		$dB2->setEditing(true);
		$dA1->setEditing(false);
		$dA2->setEditing(false);
	}
	$PageOfficeCtrl->setWriter($doc);

	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
	//���ñ���ҳ
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, $userName);//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title></title>
		<link href="images/csstg.css" rel="stylesheet" type="text/css" />
	</head>
	<body>


		<div id="content">
			<div id="textcontent" style="width: 1000px; height: 800px;">
				<div class="flow4">
					<a href="Default.php"> ���ص�¼ҳ</a>
					<strong>��ǰ�û���</strong>
					<span style="color: Red;"><?php echo $userName;?></span>
				</div>

				<script type="text/javascript">
	//����ҳ��
	function Save() {
		document.getElementById("PageOfficeCtrl1").WebSave();
	}

	//ȫ��/��ԭ
	function IsFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document
				.getElementById("PageOfficeCtrl1").FullScreen;
	}
</script>

				<!--**************   ׿�� PageOffice��� ************************-->
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</div>

	</body>
</html>

