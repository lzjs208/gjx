<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $FileMakerCtrl = new Java("com.zhuozhengsoft.pageoffice.FileMakerCtrlPHP");//���б���
    $FileMakerCtrl->setServerPage("http://localhost:8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
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
	
	$FileMakerCtrl->setSaveFilePage("SaveFile.php");
	$FileMakerCtrl->setWriter($doc);
	$FileMakerCtrl->setJsFunction_OnProgressComplete("OnProgressComplete()");
	$FileMakerCtrl->setFileTitle("newfilename.doc");
	$DocumentOpenType = new Java("com.zhuozhengsoft.pageoffice.DocumentOpenType");
	$FileMakerCtrl->fillDocumentAs("doc/test.doc", $DocumentOpenType->Word, "filemaker.doc");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title></title>
	 <script type="text/javascript">
        function OnProgressComplete() {
            window.parent.hideGif();// ����Defaultҳ�е�loadingͼƬ
            document.getElementById("FileMakerCtrl1").Alert("�ļ�������ϡ�\r\n ��� doc �ļ��У��鿴���ɵ�filemaker.doc�ļ���");
        }

    </script>

</head>
<body>
    <form action="">
    <div>
        <?php echo $FileMakerCtrl->getDocumentView("FileMakerCtrl1") ?>
    </div>
    </form>
</body>
</html>