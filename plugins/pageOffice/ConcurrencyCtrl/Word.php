<?php
	$userName = "somebody";
	$userId = $_GET['userid'];
	if (strcasecmp($userId, "1") == 0)
	{
		$userName = "����";
	}
	else
	{
		$userName = "����";
	}
	
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//���ñ����ʽ 
	
	$PageOfficeCtrl->addCustomToolButton("����","Save",1);
	$PageOfficeCtrl->setSaveFilePage("SaveFile.php");
	//���ò�������ʱ��(��λ������)
	$PageOfficeCtrl->setTimeSlice(20);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docRevisionOnly, $userName);//���б���
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
   <title>��򵥵Ĵ򿪱���Word�ļ�</title>
</head>
<body>
    <script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
    <form id="form1" >
    ��ǰ�û��� <?php echo $userName; ?>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>
