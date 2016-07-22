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
	$wb = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
	$sheet = $wb->openSheet("���۶���");

	$sheet->openCell("D5")->setSubmitName("CustName");
	$sheet->openCell("I5")->setSubmitName("OrderNum");
	date_default_timezone_set("Asia/Shanghai");
	$sheet->openCell("I6")->setValue(date("Y/m/d"));
	$sheet->openCell("I6")->setReadOnly(true);
	$sheet->openCell("I6")->setSubmitName("OrderDate");
	$sheet->openCell("D6")->setSubmitName("CustDistrict");
	$sheet->openCell("D18")->setValue($userName);
	$sheet->openCell("H18")->setSubmitName("SalesName");
	$sheet->openCell("I16")->setSubmitName("Amount");
	$sheet->openCell("I16")->setReadOnly(true);

	$table = $sheet->openTable("C9:H15");
	$table->setSubmitName("OrderDetail");
	$sheet->openTable("D9:D15")->setReadOnly(true);
	
	//�����Ҽ���˫��
	$wb->setDisableSheetDoubleClick(true);
	$wb->setDisableSheetRightClick(true);
	
	$fileName = "OrderForm.xls";
	$PageOfficeCtrl->setWriter($wb);
	// �����Զ���˵���
	$PageOfficeCtrl->addCustomToolButton("����", "SaveDocument()", 1);
	$PageOfficeCtrl->addCustomToolButton("ȫ���л�", "SetFullScreen()", 4);

	$PageOfficeCtrl->setMenubar(false);//���ز˵���
	$PageOfficeCtrl->setOfficeToolbars(false);//���ع�����
	
	//���ñ���ҳ��
	$PageOfficeCtrl->setSaveDataPage("Update.php");

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsSubmitForm, "");//���б���
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
					<li style="background: #d0eaf7; display: block;">
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
				<!--�������-->
				<div style="width: 860px; height: 750px;">
					<!-- ****************************pageoffice���ʹ��****************************** -->
					<script type="text/javascript">
						function SaveDocument(data) {
							document.getElementById("PageOfficeCtrl1").WebSave();
							if (document.getElementById("PageOfficeCtrl1").CustomSaveResult != "error") {
							document.getElementById("PageOfficeCtrl1").Alert('����ɹ���');
							location.href = "OrderList.php";
							}
						}

						function SetFullScreen() {
							document.getElementById("PageOfficeCtrl1").FullScreen = !document
									.getElementById("PageOfficeCtrl1").FullScreen;
						}
					</script>
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<!-- ****************************pageoffice���ʹ��****************************** -->
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