<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	$PageOfficeCtrl->setMenubar(false); //���ز˵���
	$PageOfficeCtrl->addCustomToolButton("����","Save()",1);
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$_GET['filename'], $OpenMode->docNormalEdit, "����");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
    <link href="../images/csstg.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
            //alert('����ɹ���');
        }
    </script>

</head>
<body>
    <form id="form2">
    <div id="header">
        <div style="float: left; margin-left: 20px;">
            <img src="../images/logo.jpg" height="30" /></div>
        <ul>
            <li><a href="#">׿����վ</a></li>
            <li><a href="#">�ͻ��ʰ�</a></li>
            <li><a href="#">���߰���</a></li>
            <li><a href="#">��ϵ����</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="textcontent" style="width: 1000px; height: 800px;">
            <div class="flow4">
                <a href="word-lists.php">
                    <img alt="����" src="../images/return.gif" border="0" />�ļ��б�</a>&nbsp;&nbsp;<strong>�ĵ����⣺</strong> <span style="color: Red;">
                        <?php echo $_REQUEST["subject"];?></span> <span style="width: 100px;">
                        </span>
            </div>
			<!-- ****************************PageOffice ����ͻ��˱��************************************* -->
		   <script type="text/javascript">
		   		function Save(){
		   			document.getElementById("PageOfficeCtrl1").WebSave();
		   		}
		   </script>
		   <!-- ****************************PageOffice ����ͻ��˱�̽���************************************* -->
		   <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
        </div>
    </div>
    <div id="footer">
        <hr width="1000" />
        <div>
            Copyright (c) 2012 ����׿��־Զ������޹�˾</div>
    </div>
    </form>
</body>
</html>
