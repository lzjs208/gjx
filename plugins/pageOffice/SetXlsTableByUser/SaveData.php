<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	
	$tableA = $sheet->openTable("tableA");
	$tableB = $sheet->openTable("tableB");

	//����ύ������
	echo "�ύ������Ϊ��";
	echo "<table>";
	echo "<tr><td col='2'>A����</td></tr>";
	$flg = true;
	while ($flg) {
		$temp = java_values($tableA->getEOF());//java_values($param)�������У�$param�Ĳ���ֵΪtrueʱ������ֵΪ1��$paramΪ falseʱ������ֵΪ�գ�ʲô��������
		if($temp == 1){
			//���ύ����
			$flg = false;
			//echo "1111111";
		}else{
			//���ύ����
			$flg = true;
			//echo "000000";
			//��ȡ�ύ����ֵ
			if(java_values($tableA->getDataFields()->getIsEmpty()) == 1){
				//�ύ������Ϊ��
			}else {
				echo "<tr>";
				//�ύ�����ݲ�Ϊ��
				for ($i = 0; $i < java_values($tableA->getDataFields()->size()); $i++) {
					$data = java_values($tableA->getDataFields()->get($i)->getValue());
					echo "<td>".$data."</td>";
				}
			}
		}
		
		echo "</tr>";
		//ѭ��������һ��
		$tableA->nextRow();		
	}

	echo "<tr><td col='2'>B����</td></tr>";
	$flg = true;
	while ($flg) {
		$temp = java_values($tableB->getEOF());//java_values($param)�������У�$param�Ĳ���ֵΪtrueʱ������ֵΪ1��$paramΪ falseʱ������ֵΪ�գ�ʲô��������
		if($temp == 1){
			//���ύ����
			$flg = false;
			//echo "1111111";
		}else{
			//���ύ����
			$flg = true;
			//echo "000000";
			//��ȡ�ύ����ֵ
			if(java_values($tableB->getDataFields()->getIsEmpty()) == 1){
				//�ύ������Ϊ��
			}else {
				echo "<tr>";
				//�ύ�����ݲ�Ϊ��
				for ($i = 0; $i < java_values($tableB->getDataFields()->size()); $i++) {
					$data = java_values($tableB->getDataFields()->get($i)->getValue());
					echo "<td>".$data."</td>";
				}
			}
		}
		echo "</tr>";
		//ѭ��������һ��
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
