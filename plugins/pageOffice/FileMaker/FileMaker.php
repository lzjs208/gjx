
<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $FileMakerCtrl = new Java("com.zhuozhengsoft.pageoffice.FileMakerCtrlPHP");//���б���s
    $FileMakerCtrl->setServerPage("http://localhost:8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	//$id = $_GET["id"];
	$id = $_GET["id"];
	
	if ( isset($id) && !empty($id) && strlen($id)>0 )  {
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
		//�����һ��¼�
		$doc->setDisableWindowRightClick(true);
		//����������ֵ������������䵽ģ������Ӧ��λ��
		$doc->openDataRegion("PO_company")->setValue("����׿��־Զ�������޹�˾  ".$id);
		$FileMakerCtrl->setSaveFilePage("SaveMaker.php?id=".$id);
		$FileMakerCtrl->setWriter($doc);
		$FileMakerCtrl->setJsFunction_OnProgressComplete("OnProgressComplete()");
		$FileMakerCtrl->setFileTitle("newfilename.doc");
		$DocumentOpenType = new Java("com.zhuozhengsoft.pageoffice.DocumentOpenType");
		$FileMakerCtrl->fillDocument("doc/template.doc", $DocumentOpenType->Word);
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'FileMaker.jsp' starting page</title>

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
		<div>
			<!--**************   ׿�� PageOffice �ͻ��˴��뿪ʼ    ************************-->

			<script language="javascript" type="text/javascript">
				function OnProgressComplete() {
					
					window.parent.myFunc(); //���ø�ҳ���js����
				}
			</script>
			<!--**************   ׿�� PageOffice �ͻ��˴������    ************************-->
			<?php echo $FileMakerCtrl->getDocumentView("FileMakerCtrl1") ?>
			
		</div>

	</body>
</html>