<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	
	
	$id = $_REQUEST["ID"];
	$ErrorMsg = "";
	$BaseUrl = "";
	//-----------  PageOffice 服务器端编程开始  -------------------//
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须 
	java_set_file_encoding("GBK");
	
	$doc = new Java("com.zhuozhengsoft.pageoffice.wordreader.WordDocumentPHP");
	$doc->load(file_get_contents("php://input"));
	//获取提交的数值
	$sName = $doc->openDataRegion("PO_name")->getValue();
	$sDept = $doc->openDataRegion("PO_dept")->getValue();
	$sCause = $doc->openDataRegion("PO_cause")->getValue();
	$sNum = $doc->openDataRegion("PO_num")->getValue();
	$sDate = $doc->openDataRegion("PO_date")->getValue();

	if (strcasecmp($sName,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>申请人</li>";
	}
	if (strcasecmp($sDept,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>部门名称</li>";
	}
	if (strcasecmp($sCause,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>请假原因</li>";
	}
	if (strcasecmp($sDate,"")==0) {
		$ErrorMsg = $ErrorMsg . "<li>日期</li>";
	}
	try {
		if ($sNum != "") {
			if ((int)$sNum < 0) {
				$ErrorMsg = $ErrorMsg . "<li>请假天数不能是负数</li>";
			}
		} else {
			$ErrorMsg = $ErrorMsg . "<li>请假天数</li>";
		}
	} catch (Exception $Ex) {
		$ErrorMsg = $ErrorMsg . "<li><font color=red>注意：</font>请假天数必须是数字</li>";
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
	//-----------  PageOffice 服务器端编程结束  -------------------//
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
		<div class="errMainArea" id="error163"><div class="errTopArea" style="TEXT-ALIGN:left">[提示标题：这是一个开发人员可自定义的对话框]</div>
			<div class="errTxtArea" style="HEIGHT:150px; TEXT-ALIGN:left">
				<b class="txt_title">
					<div style="color:#FF0000;">请填写以下信息：</div>
					<ul>
					<?php echo $ErrorMsg;?>
					</ul>
					
				</b>
				
			</div>
			<div class="errBtmArea"><input type="button" class="btnFn" value=" 关闭 " onClick="window.opener=null;window.close();"></div>
		</div>
	</body>
</HTML>

