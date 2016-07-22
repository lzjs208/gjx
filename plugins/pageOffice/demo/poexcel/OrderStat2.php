<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}

	//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$xlHAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlHAlign");
	$xlVAlign = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlVAlign");
	$xlBorderType = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderType");
	$xlBorderWeight = new Java("com.zhuozhengsoft.pageoffice.excelwriter.XlBorderWeight");
	
	//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$sheet = $workbook->openSheet("��ѯ��");

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	
	$sql = "SELECT OrderNum,OrderDate,CustName,SalesName,Amount from OrderMaster order by ID desc";
	$rs = $conn->Execute($sql);

	$rowCount = 0;//��¼����
	$salesName = "";
	$date = "";
	$orderNum = "";
	$custName = "";
	$amount = "";
	$totalMoney = 0.00;

	while (!$rs->EOF) {
		$orderNum = (string)($rs->Fields["OrderNum"]->value);
		$date = (string)($rs->Fields["OrderDate"]->value);
		$custName = (string)($rs->Fields["CustName"]->value);
		$salesName = (string)($rs->Fields["SalesName"]->value);
		$amount = (string)($rs->Fields["Amount"]->value);

		$sheet->openCell("B" .(5 + $rowCount))->setValue($orderNum);
		if (isset($date) && !empty($date) && strlen(trim($date))>0) {
			$sheet->openCell("C" .(5 + rowCount))->setValue($date);
		}
		$sheet->openCell("D" .(5 + $rowCount))->setValue($custName);
		$sheet->openCell("E" .(5 + $rowCount))->setValue($salesName);
		$sheet->openCell("F" .(5 + $rowCount))->setValue("��".sprintf("%.2f", $amount));
		$totalMoney += (double)$amount;

		if ($rowCount % 2 == 0) {
			//���ñ���ɫ
			$color = new Java("java.awt.Color",253, 233, 217 );
			$sheet->openTable("B" .(5 + $rowCount) .":F" .(5 + $rowCount))->setBackColor($color);
		}
		$rowCount++;
		$rs->MoveNext();
	}

	//����ǰ��ɫ
	$color2 = new Java("java.awt.Color",148, 138, 84 );
	$sheet->openTable("B5:F" .($rowCount + 4))->setForeColor($color2);

	//ˮƽ������뷽ʽ
	$sheet->openTable("B5:F" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignLeft);
	$sheet->openTable("C5:C" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignCenter);
	$sheet->openTable("E5:E" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignCenter);
	$sheet->openTable("F5:F" .($rowCount + 4))->setHorizontalAlignment(
			$xlHAlign->xlHAlignRight);
	//��ֱ������뷽ʽ
	$sheet->openTable("B5:F" .($rowCount + 4))->setVerticalAlignment(
			$xlVAlign->xlVAlignCenter);

	//�ϼƣ�

	//�ϲ���Ԫ��
	$sheet->openTable("B" .($rowCount + 5) .":F" .($rowCount + 5))->merge();
	//�и�
	$sheet->openTable("B5:F" .($rowCount + 6))->setRowHeight(18);
	$sheet->openTable("B" .($rowCount + 5) .":F" .($rowCount + 6))
			->setHorizontalAlignment($xlHAlign->xlHAlignLeft);
	$sheet->openTable("B" .($rowCount + 5) .":F" . ($rowCount + 6))
			->setVerticalAlignment($xlVAlign->xlVAlignCenter);
			
	$sheet->openCell("B" .($rowCount + 6))->setValue("�ϼ�");
	$sheet->openTable("C" .($rowCount + 6) .":E" .($rowCount + 6))->merge();

	$sheet->openCell("F" .($rowCount + 6))->setValue("��".sprintf("%.2f", $totalMoney));
	$sheet->openTable("F" .($rowCount + 6) .":F" .($rowCount + 6))
			->setHorizontalAlignment($xlHAlign->xlHAlignRight);
	$sheet->openTable("B" .($rowCount + 6) .":F" .($rowCount + 6))
			->setVerticalAlignment($xlVAlign->xlVAlignCenter);

	//�������壺��С������
	$sheet->openTable("B5:F" .($rowCount + 6))->getFont()->setSize(9);
	$sheet->openTable("B5:F" .($rowCount + 6))->getFont()->setName("����");

	//����Table�ı߿���ʽ����ʽ����ȡ���ɫ(���ֱ߿���ʽ�ص�ʱ���贴��Table����ſ�ʵ����ʽ�ĵ��Ӹ���)
	$table = $sheet->openTable("B" .($rowCount + 6) .":F".($rowCount + 6));
	$table->getBorder()->setBorderType($xlBorderType->xlTopEdge);
	$table->getBorder()->setWeight($xlBorderWeight->xlThin);
	$color3 = new Java("java.awt.Color", 148, 138, 84);
	$table->getBorder()->setLineColor($color3);

	$table->close();
		
	//�����Ҽ���˫��
	$workbook->setDisableSheetDoubleClick(true);	
	$workbook->setDisableSheetRightClick(true);

	$fileName = "OrderQuery.xls";
	$PageOfficeCtrl->setWriter($workbook);
	// �����Զ���˵���
	$PageOfficeCtrl->addCustomToolButton("ҳ������", "SetPage()", 3);
	$PageOfficeCtrl->addCustomToolButton("��ӡ", "Print()", 6);
	$PageOfficeCtrl->addCustomToolButton("��ӡԤ��", "PreViewShowPrint()", 7);
	$PageOfficeCtrl->addCustomToolButton("��浽����", "SaveAs()", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ���л�", "SetFullScreen()", 4);

	$PageOfficeCtrl->setMenubar(false);//���ز˵���
	$PageOfficeCtrl->setOfficeToolbars(false);//���ع�����
	
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveDataPage("Update.php");

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsReadOnly, "");//���б���
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>��ѯ��</title>
	</head>
	<body>
		<!--header-->
		<div class="zz-headBox clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="home.html"> <img src="images/logo.png" alt="" />
					</a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
                <li><a target="_blank" href="http://www.zhuozhengsoft.com">׿����վ</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/poask/index.asp">�ͻ��ʰ�</a></li>
                <li><a target="_blank" href="http://www.zhuozhengsoft.com/contact-us.html">��ϵ����</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li>
					<font>��ǰ�û���</font><?php echo $userName;?></li>
				<li>
					<font>��ǰϵͳ���ڣ�</font><?php date_default_timezone_set("Asia/Shanghai"); echo date( "Y-m-d h:i:sa"); ?></li>
				<li>
					<font>��ǰģ�飺</font>�޸Ķ���
				</li>
			</ul>
		</div>
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<!--left-->
			<div class="zz-contentLeft fl">
				<ul class="left-ul">
					<h2 class="fs-12">
						�û�������
					</h2>
					<li>
						<a href="OrderList.php">�����б�</a>
					</li>
					<li>
						<a href="NewOrder.php">�½�����</a>
					</li>
					<li>
						<a href="OrderStat.php">ͳ��ͼ��</a>
					</li>
					<li style="background: #d0eaf7; display: block;">
						<a href="OrderStat2.php">��ѯ��</a>
					</li>
					<li class="bo-n">
						<a href="logout.php">�˳�ϵͳ</a>
					</li>
				</ul>
			</div>
			<div class="zz-contentRight fl">
				<div style="width: 860px; height: 750px;">
					<!-- *********************pageoffice�����ʹ�� **************************-->
					<script language="javascript">
	//��浽����
	function SaveAs() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(2);
	}
	//ҳ������
	function ShowPageSetupDlg() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(5);
	}
	//��ӡ
	function ShowPrintDlg() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(4);
	}
	//��ӡԤ��
	function PrintPreView() {
		document.getElementById("PageOfficeCtrl1").PrintPreview();
	}
	//ȫ��
	function SetFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document
				.getElementById("PageOfficeCtrl1").FullScreen;
	}
</script>
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<!-- *********************pageoffice�����ʹ�� **************************-->
				</div>
			</div>
			<!--������-->
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright 2013 ����׿��־Զ������޹�˾
		</div>
		<!--footer end-->
	</body>
</html>
