<?php
	$idlist = $_REQUEST["ids"];
	if ( !isset($idlist) || empty($idlist) || strlen(trim($idlist))==0) {
		return;
	}
	$idlist = trim($idlist);

	//从数据库中读取数据
	$strSql = "select * from Salary where ID in(".$idlist.") order by ID";
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
	$conn->Open($connstr);  
	$rs = $conn->Execute($strSql);  

	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$dataRegionInsertType = new Java("com.zhuozhengsoft.pageoffice.wordwriter.DataRegionInsertType");
	$i = 0;	
	while (!$rs->EOF) {
		$data = $doc->createDataRegion("reg".$i, $dataRegionInsertType->Before, "[End]");
		$data->setValue("[word]doc/template.doc[/word]");

		$table = $data->openTable(1);
		$table->openCellRC(2, 1)->setValue($rs->Fields["ID"]->value);

		//给单元格赋值
		$table->openCellRC(2, 2)->setValue($rs->Fields["UserName"]->value);
		$table->openCellRC(2, 3)->setValue($rs->Fields["DeptName"]->value);

		$saltotal = $rs->Fields["SalTotal"]->value;
		if (isset($saltotal) && !empty($saltotal) && strlen(trim($saltotal))>0) {
			$table->openCellRC(2, 4)->setValue("￥".$saltotal);
		} else {
			$table->openCellRC(2, 4)->setValue("￥0.00");
		}

		$saldeduct = $rs->Fields["SalDeduct"]->value;
		if (isset($saldeduct) && !empty($saldeduct) && strlen(trim($saldeduct))>0) {
			$table->openCellRC(2, 5)->setValue("￥".$saldeduct);
		} else {
			$table->openCellRC(2, 5)->setValue("￥0.00");
		}
		
		$salcount = $rs->Fields["SalCount"]->value;
		if (isset($salcount) && !empty($salcount) && strlen(trim($salcount))>0) {
			$table->openCellRC(2, 6)->setValue("￥".$salcount);
		} else {
			$table->openCellRC(2, 6)->setValue("￥0.00");
		}
		
		$datatime = $rs->Fields["DataTime"]->value;
		if (isset($datatime) && !empty($datatime) && strlen(trim($datatime))>0) {
			$table->openCellRC(2, 7)->setValue("￥".$datatime);
		} else {
			$table->openCellRC(2, 7)->setValue("");
		}
		$i++;
		$rs->MoveNext();
	}


	$PageOfficeCtrl->setWriter($doc);
	$PageOfficeCtrl->setCaption("生成工资条");
	$PageOfficeCtrl->setCustomToolbar(false);
	
	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test.doc", $OpenMode->docNormalEdit, "somebody");//此行必须
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>生成工资条</title>

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
