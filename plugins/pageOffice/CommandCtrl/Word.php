<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	$PageOfficeCtrl->setCustomToolbar(false);//�����Զ��幤����
	$PageOfficeCtrl->setOfficeToolbars(false);//����Office������
	$PageOfficeCtrl->setAllowCopy(false);//��ֹ����	
	
    $PageOfficeCtrl->setJsFunction_AfterDocumentOpened("AfterDocumentOpened");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docReadOnly, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>��򵥵Ĵ򿪱���Word�ļ�</title>
</head>
<body>
    <script type="text/javascript">
        function AfterDocumentOpened() {
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(3, false); // ��ֹ����
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(4, false); // ��ֹ���
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(5, false); //��ֹ��ӡ
            document.getElementById("PageOfficeCtrl1").SetEnableFileCommand(6, false); // ��ֹҳ������
        }
    </script>
    <form id="form1" >
    <p>������ļ����˵������Կ��������桱�������Ϊ������ҳ�����á�������ӡ���˵����Ѿ���ҡ�����˵������ң�Ctrl+SҲ�����á�</p>
    <div style=" width:auto; height:700px;">
         <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
