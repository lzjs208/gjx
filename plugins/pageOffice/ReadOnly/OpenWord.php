<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	$PageOfficeCtrl->setAllowCopy(false);//��ֹ����
	$PageOfficeCtrl->setMenubar(false);//���ز˵���
	$PageOfficeCtrl->setOfficeToolbars(false);//����Office������
	$PageOfficeCtrl->setCustomToolbar(false);//�����Զ��幤����
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened");
	//����ҳ�����ʾ����
	$PageOfficeCtrl->setCaption("��ʾ���ļ����߰�ȫ���");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docReadOnly, "������");//ֻ��ģʽ��word�ĵ������б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>   
    <title>��ʾ���ļ����߰�ȫ���</title>
    
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
  <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(4, false); //��ֹ���
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(5, false); //��ֹ��ӡ
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(6, false); //��ֹҳ������
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(8, false); //��ֹ��ӡԤ��
        }
    </script>
    <div style=" width:auto; height:700px;">
		<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
  </body>
</html>
