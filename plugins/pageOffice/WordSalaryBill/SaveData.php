<?php
	$err = "";
	$id = $_REQUEST["ID"];
	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$strSql = "select * from Salary where id =".$id." order by ID";
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
		$conn->Open($connstr);  
		$rs = $conn->Execute($strSql);  

		$userName = "";	$deptName = ""; $salTotoal = "0"; $salDeduct = "0"; $salCount = "0"; $dateTime = "";
		//-----------  PageOffice �������˱�̿�ʼ  -------------------//
		$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
		require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
		java_set_file_encoding("GBK");
		
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
		$doc->load(file_get_contents("php://input"));
	
		$userName = $doc->openDataRegion("PO_UserName")->getValue();
		$deptName = $doc->openDataRegion("PO_DeptName")->getValue();
		$salTotoal = $doc->openDataRegion("PO_SalTotal")->getValue();
		$salDeduct = $doc->openDataRegion("PO_SalDeduct")->getValue();
		$salCount = $doc->openDataRegion("PO_SalCount")->getValue();
		$dateTime = $doc->openDataRegion("PO_DataTime")->getValue();

		$sql = "UPDATE Salary SET UserName='" . $userName
				. "',DeptName='" . $deptName . "',SalTotal='" . $salTotoal
				. "',SalDeduct='" . $salDeduct . "',SalCount='" . $salCount
				. "',DataTime='" . $dateTime . "' WHERE ID=" . $id;
				
		$count = $conn->Execute($sql);
		if ($count > 0) {
			//��ͻ��˿ؼ��������ϴ���ִ�гɹ�����Ϣ��
			$doc->setCustomSaveResult("ok");
		}
		echo $doc->close();
	} else {

		$err = "<script>alert('δ����ļ���ID������ʧ�ܣ�');location.href='Default.aspx'</script>";
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'SaveData.jsp' starting page</title>

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
		<?php echo $err;?>
	</body>
</html>
