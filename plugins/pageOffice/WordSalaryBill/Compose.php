<?php
	$idlist = $_REQUEST["ids"];
	if ( !isset($idlist) || empty($idlist) || strlen(trim($idlist))==0) {
		return;
	}
	$idlist = trim($idlist);

	//�����ݿ��ж�ȡ����
	$strSql = "select * from Salary where ID in(".$idlist.") order by ID";
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
	$conn->Open($connstr);  
	$rs = $conn->Execute($strSql);  

	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	$i = 0;	
	while (!$rs->EOF) {
		$data = $doc->createDataRegion("reg".$i, $dataRegionInsertType->Before, "[End]");
		$data->setValue("[word]doc/template.doc[/word]");

		$table = $data->openTable(1);
		$table->openCellRC(2, 1)->setValue($rs->Fields["ID"]->value);

		//����Ԫ��ֵ
		$table->openCellRC(2, 2)->setValue($rs->Fields["UserName"]->value);
		$table->openCellRC(2, 3)->setValue($rs->Fields["DeptName"]->value);

		$saltotal = $rs->Fields["SalTotal"]->value;
		if (isset($saltotal) && !empty($saltotal) && strlen(trim($saltotal))>0) {
			$table->openCellRC(2, 4)->setValue("��".$saltotal);
		} else {
			$table->openCellRC(2, 4)->setValue("��0.00");
		}

		$saldeduct = $rs->Fields["SalDeduct"]->value;
		if (isset($saldeduct) && !empty($saldeduct) && strlen(trim($saldeduct))>0) {
			$table->openCellRC(2, 5)->setValue("��".$saldeduct);
		} else {
			$table->openCellRC(2, 5)->setValue("��0.00");
		}
		
		$salcount = $rs->Fields["SalCount"]->value;
		if (isset($salcount) && !empty($salcount) && strlen(trim($salcount))>0) {
			$table->openCellRC(2, 6)->setValue("��".$salcount);
		} else {
			$table->openCellRC(2, 6)->setValue("��0.00");
		}
		
		$datatime = $rs->Fields["DataTime"]->value;
		if (isset($datatime) && !empty($datatime) && strlen(trim($datatime))>0) {
			$table->openCellRC(2, 7)->setValue("��".$datatime);
		} else {
			$table->openCellRC(2, 7)->setValue("");
		}
		$i++;
		$rs->MoveNext();
	}


	$PageOfficeCtrl->setWriter($doc);
	$PageOfficeCtrl->setCaption("���ɹ�����");
	$PageOfficeCtrl->setCustomToolbar(false);
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "somebody");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>���ɹ�����</title>

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
		<div style="width: 1000px; height: 800px;">
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
