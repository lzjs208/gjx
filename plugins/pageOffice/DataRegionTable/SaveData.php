<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	java_set_file_encoding("GBK");

	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	
	$dataReg = $doc->openDataRegion("PO_table");
	$table = $dataReg->openTable(1);
     
    //输出提交的table中的数据
    echo "表格中的各个单元的格数据为：<br/><br/>";
    $dataStr = "";
    for ($i = 1; $i <= java_values($table->getRowsCount()); $i++)
    {
        $dataStr .= "<div style='width:220px;'>";
        for ($j = 1; $j <= java_values($table->getColumnsCount()); $j++)
        {
            $dataStr .= "<div style='float:left;width:70px;border:1px solid red;'>".$table->openCellRC($i,$j)->getValue()."</div>";
        }
        $dataStr .= "</div>";
    }
    echo $dataStr;
   
	//向客户端显示提交的数据
	$doc->showPage(300, 300);
	echo $doc->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>

		<title>My JSP 'SaveFile.jsp' starting page</title>

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
	</body>
</html>
