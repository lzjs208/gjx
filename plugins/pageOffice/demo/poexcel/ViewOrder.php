<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}
	$id = $_REQUEST["ID"];
	if (!isset($id) || empty($id) || strlen(trim($id))==0) {
		header("Location:OrderList.php");
	}
		//******************************׿��PageOffice�����ʹ��*******************************	
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	//����Sheet����"Sheet1"�Ǵ򿪵�Excel����������
	$sheet = $workbook->openSheet("���۶���");

	if (isset($id) && !empty($id) && strlen(trim($id))>0) {
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);	   
		$query = "select * from OrderMaster where ID=".$id;
		$rs = $conn->Execute($query); 

		if (!$rs->EOF) {
			$sheet->openCell("D5")->setValue($rs->Fields["CustName"]->value);
			$sheet->openCell("I5")->setValue($rs->Fields["OrderNum"]->value);
			$sheet->openCell("D6")->setValue($rs->Fields["CustDistrict"]->value);
			$sheet->openCell("I6")->setValue((string)($rs->Fields["OrderDate"]->value));
			$sheet->openCell("D18")->setValue($rs->Fields["MakerName"]->value);
			$sheet->openCell("H18")->setValue($rs->Fields["SalesName"]->value);

			$orderId = $rs->Fields["ID"]->value;
			
			$rs = $conn->Execute("select * from OrderDetail where OrderID=".$orderId); 
			$table = $sheet->openTable("C9:H15");

			$proCode = "";
			$type = "";
			$unit = "";
			$quantity = "";
			$price = "";

			while (!$rs->EOF) {
				$proCode = $rs->Fields["ProductCode"]->value;
				$type = $rs->Fields["ProductType"]->value;
				$unit = $rs->Fields["Unit"]->value;
				$quantity = $rs->Fields["Quantity"]->value;
				$price = $rs->Fields["Price"]->value;

				$table->getDataFields()->get(0)->setValue($proCode);
				$table->getDataFields()->get(2)->setValue($type);
				$table->getDataFields()->get(3)->setValue($unit);
				$table->getDataFields()->get(4)->setValue($quantity);
				$table->getDataFields()->get(5)->setValue((float)$price);
				//ѭ����һ��
				$table->nextRow();
				
				$rs->MoveNext();
			}
			$table->close();
		}		
	}
	
	//�����Ҽ���˫��
	$workbook->setDisableSheetDoubleClick(true);	
	$workbook->setDisableSheetRightClick(true);

	$fileName = "OrderForm.xls";
	$PageOfficeCtrl->setWriter($workbook);
	// �����Զ���˵���
	$PageOfficeCtrl->addCustomToolButton("��ӡ", "Print()", 6);
	$PageOfficeCtrl->addCustomToolButton("ҳ������", "SetPage()", 3);
	$PageOfficeCtrl->addCustomToolButton("��ӡԤ��", "PreViewShowPrint()", 7);
	$PageOfficeCtrl->addCustomToolButton("���浽����", "SaveAs()", 1);
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
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>��¼�б�</title>
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
				<li class="pd-left">
					���۶�������ϵͳʾ��
				</li>
				<li>
					<font>��ǰ�û���</font><?php echo $userName;?></li>
				<li>
					<font>��ǰϵͳ���ڣ�</font><?php date_default_timezone_set("Asia/Shanghai"); echo date( "Y-m-d h:i:sa"); ?></li>
				<li>
					<font>��ǰģ�飺</font>ֻ���鿴^��ӡ����
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
					<li>
						<a href="OrderStat2.php">��ѯ��</a>
					</li>
					<li class="bo-n">
						<a href="logout.php">�˳�ϵͳ</a>
					</li>
				</ul>
			</div>
			<div class="zz-contentRight fl">
				<div style="width: 860px; height: 750px;">
					<!-- **************************pageoffice���ʹ��**************************** -->
					<script language="javascript">
	function SaveDocument(data) {
		document.getElementById("PageOfficeCtrl1").WebSave();
		if (document.getElementById("PageOfficeCtrl1").CustomSaveResult != "error") {
			alert('����ɹ���');
			location.href = "OrderList.php";
		}
	}

	//��ӡ
	function Print() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(4);
	}

	//��ӡԤ��
	function PreViewShowPrint() {
		document.getElementById("PageOfficeCtrl1").PrintPreview();
	}

	//ҳ������
	function SetPage() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(5);
	}

	//���浽����
	function SaveAs() {
		document.getElementById("PageOfficeCtrl1").ShowDialog(2);
	}

	//ȫ��/��ԭ
	function SetFullScreen() {
		document.getElementById("PageOfficeCtrl1").FullScreen = !document
				.getElementById("PageOfficeCtrl1").FullScreen;
	}
</script>
					<!-- **************************pageoffice���ʹ��**************************** -->
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
				</div>
			</div>
			<!--������-->
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright 2013 ����׿��־Զ�������޹�˾
		</div>
		<!--footer end-->
	</body>
</html>
