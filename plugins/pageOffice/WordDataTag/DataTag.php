<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$color = new Java("java.awt.Color");
	//����DataTag����
	$deptTag = $doc->openDataTag("{������}");
	//��DataTag����ֵ
	$deptTag->setValue("B����");
	$deptTag->getFont()->setColor($color->GREEN);
	
	$userTag = $doc->openDataTag("{����}");
	$userTag->setValue("����");
	$userTag->getFont()->setColor($color->GREEN);
	
	$dateTag = $doc->openDataTag("��ʱ�䡿");
	date_default_timezone_set("Asia/Shanghai");
	$dateTag->setValue(date("Y-m-d h:i:s")."");
	$dateTag->getFont()->setColor($color->BLUE);
	
    $PageOfficeCtrl->setWriter($doc);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test2.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>

    <title>My JSP 'DataTag.jsp' starting page</title>
    
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
    <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
  </body>
</html>
