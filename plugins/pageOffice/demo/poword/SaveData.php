<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	
	
	$id = $_REQUEST["ID"];
	$ErrorMsg = "";
	$BaseUrl = "";
	//-----------  PageOffice �������˱�̿�ʼ  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б��� 
	java_set_file_encoding("GBK");
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	//��ȡ�ύ����ֵ
	$sName = $doc->openDataRegion("PO_name")->getValue();
	$sDept = $doc->openDataRegion("PO_dept")->getValue();
	$sCause = $doc->openDataRegion("PO_cause")->getValue();
	$sNum = $doc->openDataRegion("PO_num")->getValue();
	$sDate = $doc->openDataRegion("PO_date")->getValue();

	if (strcasecmp($sName,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>������</li>";
	}
	if (strcasecmp($sDept,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>��������</li>";
	}
	if (strcasecmp($sCause,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>���ԭ��</li>";
	}
	if (strcasecmp($sDate,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>����</li>";
	}
	try {
		if ($sNum != "") {
			if ((int)$sNum < 0) {
				$ErrorMsg = $ErrorMsg . "<li>������������Ǹ���</li>";
			}
		} else {
			$ErrorMsg = $ErrorMsg . "<li>�������</li>";
		}
	} catch (Exception $Ex) {
		$ErrorMsg = $ErrorMsg . "<li><font color=red>ע�⣺</font>�����������������</li>";
	}

	if ($ErrorMsg == "") {
		$strsql = "update leaveRecord set Name='" . $sName
				."', Dept='" .$sDept ."', Cause='" .$sCause
				."', Num=" .$sNum .", SubmitTime='" .$sDate
				."' where  ID=" .$id;
		$conn->Execute($strsql);
	} else {
		$doc->showPage(578, 380);
	}
		
	echo $doc->close();
	//-----------  PageOffice �������˱�̽���  -------------------//
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<title>SaveData</title>
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="C#" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">

	</HEAD>
	<body>
		<div class="errMainArea" id="error163"><div class="errTopArea" style="TEXT-ALIGN:left">[��ʾ���⣺����һ��������Ա���Զ���ĶԻ���]</div>
			<div class="errTxtArea" style="HEIGHT:150px; TEXT-ALIGN:left">
				<b class="txt_title">
					<div style="color:#FF0000;">����д������Ϣ��</div>
					<ul>
					<?php echo $ErrorMsg;?>
					</ul>
					
				</b>
				
			</div>
			<div class="errBtmArea"><input type="button" class="btnFn" value=" �ر� " onClick="window.opener=null;window.close();"></div>
		</div>
	</body>
</HTML>

