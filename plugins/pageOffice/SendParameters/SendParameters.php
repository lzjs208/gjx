<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	//����Զ��尴ť
	$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ��", "SetFullScreen()", 4);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php?id=1");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>���ݲ���</title>

    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        function SetFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }
    </script>

</head>
<body>
    <form id="form1">
    <div style="font-size: 14px;">
        <span style="color: Red;">������Ա��Ϣ��</span><br />
        <input id="Hidden1" name="age" type="hidden" value="25" />
        <span style="color: Red;">������</span><input id="Text1" name="userName" type="text" value="����" /><br />
        <span style="color: Red;">�Ա�</span><select id="Select1" name="selSex">
            <option value="��">��</option>
            <option value="Ů">Ů</option>
        </select>
    </div>
    <div style="width: auto; height: 700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
