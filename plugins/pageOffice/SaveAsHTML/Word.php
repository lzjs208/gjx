<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���

	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("���HTML","saveAsHTML",1);
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>Word�ļ����ΪHTML</title>
</head>
<body>
    <script type="text/javascript">
        function saveAsHTML() {
            document.getElementById("PageOfficeCtrl1").WebSaveAsHTML();
            document.getElementById("PageOfficeCtrl1").Alert("HTML��ʽ���ļ��Ѿ����浽�������ϡ�");
            window.open("doc/test.htm" + "?r=" + Math.random());
        }
    </script>
    <form id="form1" >
    <div style=" width:1000px; height:800px;">
       <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
