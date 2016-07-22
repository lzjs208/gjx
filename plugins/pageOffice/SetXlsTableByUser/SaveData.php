<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	
	$tableA = $sheet->openTable("tableA");
	$tableB = $sheet->openTable("tableB");

	//输出提交的数据
	echo "提交的数据为：";
	echo "<table>";
	echo "<tr><td col='2'>A部门</td></tr>";
	$flg = true;
	while ($flg) {
		$temp = java_values($tableA->getEOF());//java_values($param)，方法中，$param的参数值为true时，返回值为1，$param为 false时，返回值为空，什么都不返回
		if($temp == 1){
			//无提交数据
			$flg = false;
			//echo "1111111";
		}else{
			//有提交数据
			$flg = true;
			//echo "000000";
			//获取提交的数值
			if(java_values($tableA->getDataFields()->getIsEmpty()) == 1){
				//提交的数据为空
			}else {
				echo "<tr>";
				//提交的数据不为空
				for ($i = 0; $i < java_values($tableA->getDataFields()->size()); $i++) {
					$data = java_values($tableA->getDataFields()->get($i)->getValue());
					echo "<td>".$data."</td>";
				}
			}
		}
		
		echo "</tr>";
		//循环进入下一行
		$tableA->nextRow();		
	}

	echo "<tr><td col='2'>B部门</td></tr>";
	$flg = true;
	while ($flg) {
		$temp = java_values($tableB->getEOF());//java_values($param)，方法中，$param的参数值为true时，返回值为1，$param为 false时，返回值为空，什么都不返回
		if($temp == 1){
			//无提交数据
			$flg = false;
			//echo "1111111";
		}else{
			//有提交数据
			$flg = true;
			//echo "000000";
			//获取提交的数值
			if(java_values($tableB->getDataFields()->getIsEmpty()) == 1){
				//提交的数据为空
			}else {
				echo "<tr>";
				//提交的数据不为空
				for ($i = 0; $i < java_values($tableB->getDataFields()->size()); $i++) {
					$data = java_values($tableB->getDataFields()->get($i)->getValue());
					echo "<td>".$data."</td>";
				}
			}
		}
		echo "</tr>";
		//循环进入下一行
		$tableB->nextRow();		
	}
	
	echo "</table>";
    $workBook->showPage(300, 300);
    echo $workBook->close();
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
