<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$PageOfficeCtrl->addCustomToolButton("����", "Save", 1);
    $PageOfficeCtrl->addCustomToolButton("�쵼Ȧ��", "StartHandDraw", 3);
    $PageOfficeCtrl->addCustomToolButton("�ֲ���ʾ��д��ע", "ShowHandDrawDispBar", 7);
    $PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ", "IsFullScreen", 4);
	$PageOfficeCtrl->setSaveFilePage("savefile.php");

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
	$fileName = "test.doc"; // ���������ļ���test.doc
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title></title>
    <link href="images/csstg.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <form id="form2">
    <div id="header">
        <div style="float: left; margin-left: 20px;">
            <img src="images/logo.jpg" height="30" /></div>
        <ul>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com">׿����վ</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">�ͻ��ʰ�</a></li>
            <li><a href="#">���߰���</a></li>
            <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">��ϵ����</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
        <div class="flow4">
					<a href="index.php"> <img alt="����" src="images/return.gif"
							border="0" />�ļ��б�</a>
					<span style="width: 100px;"> </span><strong>�ĵ����⣺</strong>
					<span style="color: Red;">�����ļ�</span>
		</div>
              <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }

        //�쵼Ȧ��ǩ��
        function StartHandDraw() {
            document.getElementById("PageOfficeCtrl1").HandDraw.SetPenWidth(5);
            document.getElementById("PageOfficeCtrl1").HandDraw.Start();
        }

        //�ֲ���ʾ��д��ע
        function ShowHandDrawDispBar() {
            document.getElementById("PageOfficeCtrl1").HandDraw.ShowLayerBar(); ;
        }

        //ȫ��/��ԭ
        function IsFullScreen() {
            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
        }

    </script>
            <!--**************   ׿�� PageOffice��� ************************-->
             <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 ����׿��־Զ�������޹�˾</div>
    </div>
    </form>
</body>
</html>