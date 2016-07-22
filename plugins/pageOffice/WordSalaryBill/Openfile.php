
<?php
	$err = "";
	$id = $_REQUEST["ID"];
	
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码	
	
	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$id = trim($id);
		$strSql = "select * from Salary where id =".$id." order by ID";
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
		$conn->Open($connstr);  
		$rs = $conn->Execute($strSql);  

		//创建WordDocment对象
		$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");
		//打开数据区域
		$datareg = $doc->openDataRegion("PO_table");

		if (!$rs->EOF) {
			//给数据区域赋值
			$doc->openDataRegion("PO_ID")->setValue($id);

			//设置数据区域的可编辑性
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
				$doc->openDataRegion("SalTotal")->setValue("￥".sprintf("%.2f", $saltotal));
			} else {
				$doc->openDataRegion("SalTotal")->setValue("￥0.00");
			}

			$saldeduct = $rs->Fields["SalDeduct"]->value;
			if (isset($saldeduct) && !empty($saldeduct) && strlen(trim($saldeduct))>0) {
				$doc->openDataRegion("SalDeduct")->setValue("￥".sprintf("%.2f", $saldeduct));
			} else {
				$doc->openDataRegion("SalDeduct")->setValue("￥0.00");
			}
			
			$salcount = $rs->Fields["SalCount"]->value;
			if (isset($salcount) && !empty($salcount) && strlen(trim($salcount))>0) {
				$doc->openDataRegion("SalCount")->setValue("￥".sprintf("%.2f", $salcount));
			} else {
				$doc->openDataRegion("SalCount")->setValue("￥0.00");
			}
			
			$datatime = $rs->Fields["DataTime"]->value;
			date_default_timezone_set("Asia/Shanghai");
			if (isset($datatime) && !empty($datatime) && strlen(trim($datatime))>0) {
				$doc->openDataRegion("DataTime")->setValue(date($datatime));
			} else {
				$doc->openDataRegion("DataTime")->setValue("");
			}

		} else {
			$err = "<script>alert('未获得该员工的工资信息！');location.href='index.php'</script>";
		}

		$PageOfficeCtrl->addCustomToolButton("保存", "Save()", 1);
		$PageOfficeCtrl->setSaveDataPage("SaveData.php?ID=".$id);
		$PageOfficeCtrl->setWriter($doc);
	} else {
		$err = "<script>alert('未获得该工资信息的ID！');location.href='index.php'</script>";
	}

		//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/template.doc", $OpenMode->docSubmitForm, "somebody");//此行必须
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
