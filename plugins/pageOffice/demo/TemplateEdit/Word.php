<?php
	$type = $_REQUEST["type"];
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$doc->setEnableAllDataRegionsEditing(true); // �����Կ����������ύģʽ��docSubmitForm���£����е�����������Ա༭
	$doc->openDataRegion("Name")->setValue("����");        
	$doc->openDataRegion("Address")->setValue("�����з�̨�����Ļ���·xxx��");  
	$doc->openDataRegion("Tel")->setValue("010-88882222");  
	$doc->openDataRegion("Phone")->setValue("13822225555");  
	$doc->openDataRegion("Sex")->setValue("��");  
	$doc->openDataRegion("Age")->setValue("21");  

	$doc->openDataTag("{ �׷���˾���� }")->setValue("΢���й��ܲ�"); 
	$doc->openDataTag("{ �ҷ���˾���� }")->setValue( "��������Ƽ���˾"); 
	$doc->openDataTag("�� ��ͬ���� ��")->setValue("2014��08��01��"); 
	$doc->openDataTag("�� ��ͬ��� ��")->setValue("201408010001"); 
	
    $PageOfficeCtrl->setWriter($doc);
	
    //��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");	
	$type = $_REQUEST["type"];		
	if (strcasecmp("1", $type) == 0)
	{
		$PageOfficeCtrl->addCustomToolButton("����", "Save2()", 1);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "zhangsan");//���б���
	}
	else if (strcasecmp("2", $type) == 0)
	{
		$PageOfficeCtrl->setMenubar(true);
		$PageOfficeCtrl->setCustomToolbar(false);
		$PageOfficeCtrl->setOfficeToolbars(false);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docReadOnly, "zhangsan");//���б���
	}
	else if (strcasecmp("3", $type) == 0)
	{
		$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
		$PageOfficeCtrl->setSaveDataPage("SaveData.php");
		$PageOfficeCtrl->setOfficeToolbars(false);
		$PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docSubmitForm, "zhangsan");//���б���
	}	

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
	 <script type="text/javascript">
        function Save2() {
            document.getElementById("PageOfficeCtrl1").Alert("��Ч��ֻ����ʾ�༭ģʽ�����ļ���û�������湦�ܡ�");
        }
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>

</head>
<body>
    <form action="">
    <div style="width: 1000px; height: 800px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
    </form>
</body>
</html>