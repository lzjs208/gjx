<?php 
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	
	$sID = $_REQUEST["id"];
	$fileName = "";
	if ( !isset($sID) || empty($sID) || strlen(trim($sID))==0) {
		echo "<script>alert('Ϊ����ļ�ID�ţ�');location.href='index.php'</script>";
	}

	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);  
   
	$query = "select * from excel where id = " . $sID;
	$rs = $conn->Execute($query);  
	
	if (!$rs->EOF) {
		$fileName = $rs->Fields["FileName"]->value;
	}

	$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
	$file = new Java("java.io.File", $filepath."\\doc\\".$fileName);
	if ( java_values($file->exists()) > 0) {
	
	}else{
		echo "<script>alert('���ļ������ڣ�');location.href='index.php'</script>";
	} 
			
	//******************************׿��PageOffice�����ʹ��*******************************	
    $PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
    $PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
	
	java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
	$workbook = new Java("com.zhuozhengsoft.pageoffice.excelwriter.Workbook");//����Workbook����
	$workbook->setDisableSheetDoubleClick(true);//��ֹ˫����Ԫ��
	$workbook->setDisableSheetRightClick(true);//��ֹ�һ���Ԫ��
	$PageOfficeCtrl->setWriter($workbook);
	
	$PageOfficeCtrl->setSaveFilePage("savefile.php?id=".$sID);
	
	//����Զ��幤����
	$PageOfficeCtrl->addCustomToolButton("���Ϊ","saveAs()",1);
	$PageOfficeCtrl->addCustomToolButton("��ӡ����","setPrint()",6);
	$PageOfficeCtrl->addCustomToolButton("ȫ��/��ԭ","setFullScreen()",4);
		
	$PageOfficeCtrl->setMenubar(false);//�����Զ���˵���
	$PageOfficeCtrl->setOfficeToolbars(false);//����Office������

	//��excel�ĵ�
    $PageOfficeCtrl->UserAgent = $_SERVER['HTTP_USER_AGENT'];//��ʹ�ùȸ���������д�������У�������������д���ɲ���
    $OpenMode = new Java("com.zhuozhengsoft.pageoffice.OpenModeType");
    $PageOfficeCtrl->webOpen("doc/".$fileName, $OpenMode->xlsReadOnly, "somebody");//���б���
	
	//************************PageOffice�����ʹ��*****************************
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>ֻ�����ļ�</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
	</head>
	<body>
		<!--header-->
		<div class="zz-headBox clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="#"><img src="images/logo.png" alt="" />
					</a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
					<li>
						<a href="http://www.zhuozhengsoft.com" target="_blank">׿����վ</a>
					</li>
					<li>
						<a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">�ͻ��ʰ�</a>
					</li>
					<li class="bor-0">
						<a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">��ϵ����</a>
					</li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<!--a title-->
		<div class=" topTitle">
			<ul>
				<li class="pd-left">
					<a href="index.php" style="color: White;"><font>�����ļ��б�</font>
					</a>
				</li>
				<li>
					<font>��ǰģʽ��</font>���߱༭
				</li>
				<li>
					<font>��ǰϵͳ���ڣ�</font><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d");?>
				</li>
			</ul>
		</div>
		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<form id="form1">
				<div style="height: 700px;">
					<!-- *************************PageOffice�����ʹ��************************************ -->
					<?php echo $PageOfficeCtrl->getDocumentView("PageOfficeCtrl1") ?>
					<script type="text/javascript">
					
					    function saveAs() {
				            document.getElementById("PageOfficeCtrl1").ShowDialog(2);
				        }
				        function setPrint() {
				            document.getElementById("PageOfficeCtrl1").ShowDialog(5);
				        }
				        function setFullScreen() {
				            document.getElementById("PageOfficeCtrl1").FullScreen = !document.getElementById("PageOfficeCtrl1").FullScreen;
				        }
			
			    	</script>
			    <!-- *************************PageOffice�����ʹ��************************************ -->
				</div>
			</form>
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright copy 2013 ����׿��־Զ������޹�˾
		</div>
		<!--footer end-->
	</body>
</html>
