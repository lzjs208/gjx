<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	// ���һ���Զ��幤�����ϵİ�ť��AddCustomToolButton�Ĳ���˵���������������
	$PageOfficeCtrl->addCustomToolButton("���԰�ť","myTest",0);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>���Զ��幤������Ӱ�ť</title>
</head>
<body>
    <script type="text/javascript">
        function myTest() {
            document.getElementById("PageOfficeCtrl1").Alert("���Գɹ���");
        }
    </script>
    <form id="form1" >
    ����Զ��幤�����еġ����԰�ť���鿴Ч����<br />
    <img src="img/addbutton.jpg" />
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>

