<?php
	$err = "";
	$id = trim($_REQUEST["ID"]);
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	$PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//����WordDocument����
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	
	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$strSql = "select * from Salary where id =" . $id . " order by ID";		
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
		$conn->Open($connstr);  
		$rs = $conn->Execute($strSql);  

		//����������
		$datareg = $doc->openDataRegion("PO_table");

		if (!$rs->EOF) {
			//����������ֵ
			$doc->openDataRegion("PO_ID")->setValue($id);
			$doc->openDataRegion("PO_UserName")->setValue($rs->Fields["UserName"]->value);
			$doc->openDataRegion("PO_DeptName")->setValue($rs->Fields["DeptName"]->value);

			$saltotal = $rs->Fields["SalTotal"]->value;
			if (isset($saltotal) && !empty($saltotal) && strlen(trim($saltotal))>0) {
				$doc->openDataRegion("SalTotal")->setValue("��".sprintf("%.2f", $saltotal));
			} else {
				$doc->openDataRegion("SalTotal")->setValue("��0.00");
			}

			$saldeduct = $rs->Fields["SalDeduct"]->value;
			if (isset($saldeduct) && !empty($saldeduct) && strlen(trim($saldeduct))>0) {
				$doc->openDataRegion("SalDeduct")->setValue("��".sprintf("%.2f", $saldeduct));
			} else {
				$doc->openDataRegion("SalDeduct")->setValue("��0.00");
			}
			
			$salcount = $rs->Fields["SalCount"]->value;
			if (isset($salcount) && !empty($salcount) && strlen(trim($salcount))>0) {
				$doc->openDataRegion("SalCount")->setValue("��".sprintf("%.2f", $salcount));
			} else {
				$doc->openDataRegion("SalCount")->setValue("��0.00");
			}
			
			$datatime = $rs->Fields["DataTime"]->value;
			date_default_timezone_set("Asia/Shanghai");
			if (isset($datatime) && !empty($datatime) && strlen(trim($datatime))>0) {
				$doc->openDataRegion("DataTime")->setValue(date($datatime));
			} else {
				$doc->openDataRegion("DataTime")->setValue("");
			}
		} else {
			$err = "<script>alert('δ��ø�Ա���Ĺ�����Ϣ��');location.href='index.php'</script>";
		}

	} else {
		$err = "<script>alert('δ��øù�����Ϣ��ID��');location.href='index.php'</script>";
	}

	$PageOfficeCtrl->setCaption("���ɹ�����");
	$PageOfficeCtrl->setCustomToolbar(false);
	$PageOfficeCtrl->setWriter($doc);
	
	//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docSubmitForm, "somebody");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>�鿴������Ϣ</title>

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
		<div style="width: auto; height: 700px;">
			<?php echo $err;?>
			<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
		</div>
	</body>
</html>
