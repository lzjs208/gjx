<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
	$PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	//����PageOfficeCtrl�ؼ��ı���������
	$PageOfficeCtrl->setCaption("Word�ĵ�������ȡ����ֵ");
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����","Save()",1);
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
       <title>Word�ĵ�������ȡ����ֵ</title>
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
            //document.getElementById("PageOfficeCtrl1").CustomSaveResult��ȡ���Ǳ���ҳ��ķ���ֵ
            document.getElementById("PageOfficeCtrl1").Alert("����ɹ�������ֵΪ��" + document.getElementById("PageOfficeCtrl1").CustomSaveResult);
        }
 
    </script>
</head>
<body>
    <form id="form1">
    <div style=" font-size:small; color:Red;">
        <label>�����룺���Ҽ���ѡ�񡰲鿴Դ�ļ�������js������Save()</label>
        <br />document.getElementById("PageOfficeCtrl1").WebSave()//ִ�б������"
        <br/>document.getElementById("PageOfficeCtrl1").CustomSaveResult//��ȡ����ֵ����ҳ��SaveFile.php����fs.setCustomSaveResult("ok");����ķ���ֵ
        <br />
    </div>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
