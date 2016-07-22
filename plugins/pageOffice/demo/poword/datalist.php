<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$id = $_REQUEST["ID"];
	$query = "select * from leaveRecord where ID = " . $id;
	$rs = $conn->Execute($query); 

	$docSubject = ""; $docName = ""; $docDept = ""; $docCause = ""; $docNum = ""; $docDate = "";
	if (!$rs->EOF) {
		$docSubject = $rs->Fields["Subject"]->value;
		$docName = $rs->Fields["Name"]->value;
		$docDept = $rs->Fields["Dept"]->value;
		$docCause = $rs->Fields["Cause"]->value;
		$docNum = $rs->Fields["Num"]->value;
		$docDate = $rs->Fields["SubmitTime"]->value;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
	<HEAD>
		<TITLE>PageOffice 平台 演示程序</TITLE>
		<META http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta name="GENERATOR" Content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" Content="C#">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema"
			content="http://schemas.microsoft.com/intellisense/ie5">
		<link rel="stylesheet" href="images/csstg.css" type="text/css"></link>
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
	</HEAD>
	<body>
		<form id="Form1" method="post">
		</form>

		<table width='98%' class="zz-talbe"
			style="margin-top: 20px; width: 460px;">
			<thead>
				<tr>
					<th width='20%' height='26' valign="middle">
						数据库字段
					</th>
					<th width='80%' height='23' valign="middle">
						字段值
					</th>
				</tr>
			</thead>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					主题
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docSubject;?></td>
			</tr>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					姓名
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docName;?></td>
			</tr>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					部门
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docDept;?></td>
			</tr>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					请假原因
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docCause;?></td>
			</tr>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					请假天数
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docNum;?></td>
			</tr>
			<tr>
				<td width='20%' height='26' valign="middle"
					style="background-color: #D7FFEE">
					申请日期
				</td>
				<td width='80%' height='23' valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;<?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d", strtotime($docDate));?></td>
			</tr>


		</table>

	</body>
</HTML>
