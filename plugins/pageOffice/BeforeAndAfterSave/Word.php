<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���	
	
	$PageOfficeCtrl->setJsFunction_BeforeDocumentSaved("BeforeDocumentSaved()");// �����ļ�����֮ǰִ�е��¼�	
	$PageOfficeCtrl->setJsFunction_AfterDocumentSaved("AfterDocumentSaved()");// �����ļ�����֮��ִ�е��¼�

	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");//���ñ���ҳ��
	
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>�ĵ�����ǰ�ͱ����ִ�е��¼�</title>
</head>
<body>
    <script type="text/javascript">
        function BeforeDocumentSaved() {
            document.getElementById("PageOfficeCtrl1").Alert("BeforeDocumentSaved�¼����ļ���Ҫ��ʼ������.");
            return true;
        }
        function AfterDocumentSaved(IsSaved) {
            if (IsSaved) {
                document.getElementById("PageOfficeCtrl1").Alert("AfterDocumentSaved�¼����ļ�����ɹ���.");
            }
        }
    </script>
    <form id="form1" >
    	��ʾ: �ĵ�����ǰ�ͱ����ִ�е��¼���<br /><br />
    
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
