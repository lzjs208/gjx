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
	//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$sheet = $workbook->openSheet("ͳ��ͼ��");

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	
	$sql = "SELECT OrderMaster.SalesName, OrderDetail.ProductName, sum(OrderDetail.Quantity) as Quantity, sum(OrderDetail.Price * OrderDetail.Quantity) as amount "
			. "from OrderMaster,OrderDetail "
			. " where OrderMaster.ID = OrderDetail.OrderID  and OrderMaster.SalesName in('������','�𱴱�','Ǯ����','��С��')  "
			. " group by OrderMaster.SalesName, OrderDetail.ProductName";
	$rs = $conn->Execute($sql);
	
	$columnId = 5;
	$n = 0;
	$salesName = "";
	$preSalesName = "";
	$qua = "";
	$proName = "";
	$amount = "";
	while (!$rs->EOF) {
		$salesName = (string)($rs->Fields["SalesName"]->value);
		$qua = (string)($rs->Fields["Quantity"]->value);
		$proName = (string)($rs->Fields["ProductName"]->value);
		$amount = (string)($rs->Fields["amount"]->value);

		if (strcasecmp($salesName, $preSalesName) <> 0) {
			$columnId = 5 + $n * 4;
			$n++;
		}
		$preSalesName = $salesName;

		$sheet->openCell("B" . $columnId)->setValue($salesName);
		if( strcasecmp($proName,"�ʼǱ�") == 0 ){
			$sheet->openCell("C" . $columnId)->setValue($proName);
			$sheet->openCell("D" . $columnId)->setValue($qua);
			$sheet->openCell("E" . $columnId)->setValue($amount);
		}
		
		if( strcasecmp($proName,"������")==0 ){
			$sheet->openCell("C" . ($columnId+1))->setValue($proName);
			$sheet->openCell("D" . ($columnId+1))->setValue($qua);
			$sheet->openCell("E" . ($columnId+1))->setValue($amount);
		}
		if( strcasecmp($proName,"·����")==0 ){
			$sheet->openCell("C" . ($columnId+2))->setValue($proName);
			$sheet->openCell("D" . ($columnId+2))->setValue($qua);
			$sheet->openCell("E" . ($columnId+2))->setValue($amount);
		}
		$rs->MoveNext();
	}
	
	//�����Ҽ���˫��
	$workbook->setDisableSheetDoubleClick(true);	
	$workbook->setDisableSheetRightClick(true);

	$fileName = "OrderReport.xls";
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
		<title>ͳ��ͼ��</title>
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
					<li><a href="http://www.zhuozhengsoft.com" target="_blank">׿����վ</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">�ͻ��ʰ�</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">��ϵ����</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li class="pd-left">
					���۶�������ϵͳʾ��
				</li>
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
					<li style="background: #d0eaf7; display: block;">
						<a href="OrderStat.php">ͳ��ͼ��</a>
					</li>
					<li>
						<a href="OrderStat2.php">��ѯ��</a>
					</li>
					<li class="bo-n">
						<a href="logout.php">�˳�ϵͳ</a>
					</li>
				</ul>
			</div>
			<div class="zz-contentRight fl">
				<div style="width: 1000px; height: 750px;">
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
			Copyright 2012 ����׿��־Զ������޹�˾
		</div>
		<!--footer end-->
	</body>
</html>
