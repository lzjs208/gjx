<?php
	//******************************卓正PageOffice组件的使用*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
	
	java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordwriter.WordDocument");//声明WordDocument变量
	$table1 = $doc->openDataRegion("PO_T001")->openTable(1);
 
    $table1->openCellRC(1,1)->setValue("PageOffice组件");
	$dataRowCount = 5;//需要插入数据的行数
	$oldRowCount = 3;//表格中原有的行数
	// 扩充表格
    for ($j = 0; $j < $dataRowCount - $oldRowCount; $j++)
    {
        $table1->insertRowAfter($table1->openCellRC(2, 5));  //在第2行的最后一个单元格下插入新行
    }
	// 填充数据
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

	//打开Word文档
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//若使用谷歌浏览器此行代码必须有，其他浏览器此行代码可不加
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/test_table.doc", $OpenMode->docNormalEdit, "张三");//此行必须
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>Word中的Table的数据填充</title>
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
