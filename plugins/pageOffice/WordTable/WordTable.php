<?php
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$table1 = $doc->openDataRegion("PO_T001")->openTable(1);
 
    $table1->openCellRC(1,1)->setValue("PageOffice���");
	$dataRowCount = 5;//��Ҫ�������ݵ�����
	$oldRowCount = 3;//�����ԭ�е�����
	// ������
    for ($j = 0; $j < $dataRowCount - $oldRowCount; $j++)
    {
        $table1->insertRowAfter($table1->openCellRC(2, 5));  //�ڵ�2�е����һ����Ԫ���²�������
    }
	// �������
    $i = 1;
    while ($i <= $dataRowCount)
    {   
        $table1->openCellRC($i, 2)->setValue("AA".$i);
        $table1->openCellRC($i, 3)->setValue("BB".$i);
        $table1->openCellRC($i, 4)->setValue("CC".$i);
        $table1->openCellRC($i, 5)->setValue("DD".$i);
        $i++;
    }
		
    $PageOfficeCtrl->setWriter($doc);

	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test_table.doc", $OpenMode->docNormalEdit, "����");//���б���
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>Word�е�Table���������</title>
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
		<div style="width: auto; height: 600px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
