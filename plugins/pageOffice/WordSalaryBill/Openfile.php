
<?php
	$err = "";
	$id = $_REQUEST["ID"];
	
	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���	
	
	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$id = trim($id);
		$strSql = "select * from Salary where id =".$id." order by ID";
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
		$conn->Open($connstr);  
		$rs = $conn->Execute($strSql);  

		//����WordDocment����
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");
		//����������
		$datareg = $doc->openDataRegion("PO_table");

		if (!$rs->EOF) {
			//����������ֵ
			$doc->openDataRegion("PO_ID")->setValue($id);

			//������������Ŀɱ༭��
			$doc->openDataRegion("PO_UserName")->setEditing(true);
			$doc->openDataRegion("PO_DeptName")->setEditing(true);
			$doc->openDataRegion("PO_SalTotal")->setEditing(true);
			$doc->openDataRegion("PO_SalDeduct")->setEditing(true);
			$doc->openDataRegion("PO_SalCount")->setEditing(true);
			$doc->openDataRegion("PO_DataTime")->setEditing(true);

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

		$PageOfficeCtrl->addCustomToolButton("����", "Save()", 1);
		$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=".$id);
		$PageOfficeCtrl->setWriter($doc);
	} else {
		$err = "<script>alert('δ��øù�����Ϣ��ID��');location.href='index.php'</script>";
	}

		//��Word�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docSubmitForm, "somebody");//���б���
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title></title>
		<script type="text/javascript">
        function Save() {
            document.getElementById("PageOfficeCtrl1").WebSave();
        }
    </script>
	</head>
	<body>
		<form id="form1">
			<div style="width: auto; height: 600px;">
				<?php echo $err;?>
				<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
			</div>
		</form>
	</body>
</html>
