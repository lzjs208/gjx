<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����","Save",1);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//��excel�ĵ�
	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]))."\\doc\\test.doc";
	echo $filepath;
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen($filepath, $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    
    <title>My JSP 'index.jsp' starting page</title>
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
    	�򿪷�������ָ������·���µ��ļ�<br/>
    	
    <script type="text/javascript">
			function Save() {
				document.getElementById("PageOfficeCtrl1").WebSave();
			}
	</script>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
  </body>
</html>
