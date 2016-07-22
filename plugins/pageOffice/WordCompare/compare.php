<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	// Create custom toolbar
	$PageOfficeCtrl->addCustomToolButton("��ʾA�ĵ�", "ShowFile1View()", 0);
	$PageOfficeCtrl->addCustomToolButton("��ʾB�ĵ�", "ShowFile2View()", 0);
	$PageOfficeCtrl->addCustomToolButton("��ʾ�ȽϽ��", "ShowCompareView()", 0);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	//$PageOfficeCtrl->wordCompare("doc/aaa1.doc", "doc/aaa2.doc", $OpenMode->docReadOnly, "����");//���б���
    $PageOfficeCtrl->wordCompare("doc/aaa1.doc", "doc/aaa2.doc", $OpenMode->docAdmin, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Word�ĵ��Ƚ�</title>
    
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
  <script language="javascript" type="text/javascript">
	    function SaveDocument() {
	        document.getElementById("PageOfficeCtrl1").WebSave();
	    }
	    function ShowFile1View() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = false;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 1;
	    }
	    function ShowFile2View() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = false;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 0;
	    }
	    function ShowCompareView() {
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.ShowRevisionsAndComments = true;
	        document.getElementById("PageOfficeCtrl1").Document.ActiveWindow.View.RevisionsView = 0;
	    }
	    function SetFullScreen() {
	        document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
	    }
	</script>
    <div style="width:1000px; height:800px;">
      <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
  	</div>
  </body>
</html>
