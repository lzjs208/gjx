<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	// �����ļ��򿪺�ִ�е�js function
	$PageOfficeCtrl->setJsFunction_AfterDocumentOpened( "AfterDocumentOpened()");

    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>�ļ��򿪺󴥷����¼�</title>
</head>
<body>
    <script type="text/javascript">
        function AfterDocumentOpened() {
            // ���ļ���ʱ�򣬸�word�е�ǰ���λ�ø�ֵһ���ı�ֵ
            document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range.Text = "�ļ�����";
        }
    </script>
    <form id="form1" >
    Word�е�"<span style=" color:Red;"> �ļ�����</span>" �����ĵ��򿪵��¼����ó�����ӽ�ȥ�ġ�<br /><br />
    
    <div style=" width:auto; height:700px;">
         <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
