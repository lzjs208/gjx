<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����������
	$d1 = $doc->openDataRegion("PO_com1");
	$d2 = $doc->openDataRegion("PO_com2");
	//����������ֵ
	$d1->setValue("[word]doc/content1.doc[/word]");
	$d2->setValue("[word]doc/content2.doc[/word]");

	//��Ҫ�������������ݴ����ļ��У�������������ԡ�setSubmitAsFile��ֵΪtrue
	$d1->setSubmitAsFile(true);
	$d2->setSubmitAsFile(true);

	$userName = $_REQUEST["userName"];
	//���ݵ�¼�û���������������ɱ༭��
	//�׿ͻ���zhangsan��¼��
	if (strcasecmp($userName,"zhangsan")==0) {
		$d1->setEditing(true);
		$d2->setEditing(false);
	}
	//�ҿͻ���lisi��¼��
	else {
		$d1->setEditing(false);
		$d2->setEditing(true);
	}
	$PageOfficeCtrl->setWriter($doc);

	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
	//���ñ���ҳ
	$PageOfficeCtrl->setSaveDataPage("SaveData.php?userName=".$userName);
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

