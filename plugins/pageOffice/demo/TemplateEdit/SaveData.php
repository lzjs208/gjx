<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	java_set_file_encoding("GBK");
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	//��ȡ�ύ����ֵ
    try{
        $poName = $doc->openDataRegion("PO_Name");
        echo "��̨��ȡ PO_Name��ֵ��".$poName->getValue();
    }
    catch(Exception $e){
        print "�ͻ����ύ������������û�а�������Ϊ PO_Name ����������";
    }

	$doc->showPage(400, 300);
	echo $doc->close();
?>
