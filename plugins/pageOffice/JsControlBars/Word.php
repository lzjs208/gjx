<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "������");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>��js���ƹ���������ʾ������</title>
</head>
<body>
    <script type="text/javascript">
        function mySave() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
        
        // ����/��ʾ ������
        function Button1_onclick() {
            var bVisible = document.getElementById("PageOfficeCtrl1").Titlebar;
            document.getElementById("PageOfficeCtrl1").Titlebar = !bVisible;
        }
        
        // ����/��ʾ �˵���
        function Button2_onclick() {
            var bVisible = document.getElementById("PageOfficeCtrl1").Menubar;
            document.getElementById("PageOfficeCtrl1").Menubar = !bVisible;
        }


        // ����/��ʾ �Զ��幤����
        function Button3_onclick() {
            var bVisible = document.getElementById("PageOfficeCtrl1").CustomToolbar;
            document.getElementById("PageOfficeCtrl1").CustomToolbar = !bVisible;
        }
        // ����/��ʾ Office������
        function Button4_onclick() {
            var bVisible = document.getElementById("PageOfficeCtrl1").OfficeToolbars;
            document.getElementById("PageOfficeCtrl1").OfficeToolbars = !bVisible;
        }

    </script>
    <form id="form1" >
    <input id="Button1" type="button" value="����/��ʾ ������"  onclick="return Button1_onclick()" />
    <input id="Button2" type="button" value="����/��ʾ �˵���" onclick="return Button2_onclick()" />
    <input id="Button3" type="button" value="����/��ʾ �Զ��幤����"  onclick="return Button3_onclick()" />
    <input id="Button4" type="button" value="����/��ʾ Office������"  onclick="return Button4_onclick()" />
    <br /><br />
    <div style=" width:auto; height:700px;">
       <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
