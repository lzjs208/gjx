<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("��ȡwordѡ�е�����","getSelectionText",5);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>��ʾ��js��ȡwordѡ�е�����</title>

    <script type="text/javascript">
    function  getSelectionText()
    {
        if (document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range.Text != "") {
            document.getElementById("PageOfficeCtrl1").Alert(document.getElementById("PageOfficeCtrl1").Document.Application.Selection.Range.Text);
	    }
	    else{
	        document.getElementById("PageOfficeCtrl1").Alert("��û��ѡ���κ��ı���");
	    }     
    }
    </script>

</head>
<body>
    <div style="font-size: 12px; line-height: 20px; border-bottom: dotted 1px #ccc; border-top: dotted 1px #ccc;
        padding: 5px;">
        <span style="color: red;">����˵����</span>ѡ��word�ļ��е�һ�����֣�Ȼ��㡰��ȡѡ�����֡���ť��<br />
        �ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js����<span style="background-color: Yellow;">getSelectionText()</span></div>
    
    <input id="Button1" type="button" onclick="getSelectionText();" value="js��ȡwordѡ�е�����" /><br />
    <form id="form1">
    <div style=" width:auto; height:700px;">
        <!--**************   PageOffice �ͻ��˴��뿪ʼ    ************************-->
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        <!--**************   PageOffice �ͻ��˴������    ************************-->
    </div>
    </form>
</body>
</html>

