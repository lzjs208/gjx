<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	//����������
	$dataRegion = $doc->openDataRegion("PO_regTable");
	//��table��openTable(index)�����е�index����Word�ĵ���tableλ�õ���������1��ʼ
	$table = $dataRegion->openTable(1);
	
	//��table�еĵ�Ԫ��ֵ�� openCellRC(int,int)�еĲ����ֱ����ڼ��С��ڼ��У���1��ʼ
	$table->openCellRC(3, 1)->setValue("A��˾");
	$table->openCellRC(3, 2)->setValue("������");
	$table->openCellRC(3, 3)->setValue("����");
	
	//����һ�У�insertRowAfter�����еĲ����������ĸ���Ԫ���������һ������
	$table->insertRowAfter($table->openCellRC(3, 3));
	
	$table->openCellRC(4, 1)->setValue("B��˾");
	$table->openCellRC(4, 2)->setValue("���۲�");
	$table->openCellRC(4, 3)->setValue("����");
	
	$PageOfficeCtrl->setWriter($doc);
	
	//���ز˵���
	$PageOfficeCtrl->setMenubar(false);
	//�����Զ��幤����
	$PageOfficeCtrl->setCustomToolbar(false);    

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>�򵥵ĸ�Word�ĵ��е�Table��ֵ</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

  </head>
  
  <body>
    <div style=" width:auto; height:700px;">
        <?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
    </div>
  </body>
</html>
