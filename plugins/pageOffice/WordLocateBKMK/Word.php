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
	$PageOfficeCtrl->addCustomToolButton("��λ��굽ָ����ǩ","locateBookMark",5);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>��ʾ����λ��굽ָ����ǩ</title>

    <script type="text/javascript">
//        function locateBookMark() {
//            //��ȡ��ǩ����
//            var bkName = document.getElementById("txtBkName").value;
//            //����궨λ����ǩ���ڵ�λ��
//            document.getElementById("PageOfficeCtrl1").Document.Bookmarks(bkName).Select();
//        }
        function locateBookMark() {
            //��ȡ��ǩ����
            var bkName = document.getElementById("txtBkName").value;
            //����궨λ����ǩ���ڵ�λ��
            var mac = "Function myfunc()" + " \r\n"
                    + "  ActiveDocument.Bookmarks(\""+ bkName +"\").Select " + " \r\n"
                    + "End Function " + " \r\n";
            document.getElementById("PageOfficeCtrl1").RunMacro("myfunc", mac);
        }
    </script>

</head>
<body>
    <div style=" font-size:small; color:Red;">
        <label>�ؼ����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js������</label>
        <label>function  locateBookMark()</label>
        <br/>
    <label>����궨λ����ǩǰ���������ı���������Ҫ��λ������ǩ���ƣ��ɵ��Office�������ϵġ����롱������ǩ�������鿴��ǰWord�ĵ������е���ǩ���ƣ���</label><br />
        <label>��ǩ���ƣ�</label><input id="txtBkName" type="text" value="PO_seal" />
    </div>
    <br />
    <form id="form1">
    <div style="width:auto; height:700px;">
        <!--**************   PageOffice �ͻ��˴��뿪ʼ    ************************-->
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?> 
        <!--**************   PageOffice �ͻ��˴������    ************************-->
    </div>
    </form>
</body>
</html>
