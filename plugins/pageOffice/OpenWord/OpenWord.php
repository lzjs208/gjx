<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//����Office������
	$PageOfficeCtrl->setOfficeToolbars(false);
	//�����Զ��幤����
	$PageOfficeCtrl->setCustomToolbar(false);
	//����ҳ�����ʾ����
	$PageOfficeCtrl->setCaption("��ʾ����򵥵���ֻ��ģʽ��Word�ĵ�");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    //$PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "������");//�༭ģʽ��word�ĵ������б���
	$PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docReadOnly, "������");//ֻ��ģʽ��word�ĵ������б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>   
    <title>��򵥵���ֻ��ģʽ��Word�ĵ�</title>
    
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
    <div style=" width:auto; height:700px;">
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
  </body>
</html>
