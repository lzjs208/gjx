<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
	$conn->Open($connstr);  
   
	$query = "select * from Salary  order by ID";
	$rs = $conn->Execute($query);  
	
	$flg = false;//��ʶ�Ƿ�������
	$strHtmls = "";
	while (!$rs->EOF) {
		$flg = true;
		$pID = $rs->Fields["ID"]->value;
		$strHtmls .="<tr  style='height:40px; text-indent:10px; padding:0; border-right:1px solid #a2c5d9; border-bottom:1px solid #a2c5d9; color:#666;'>";
		$strHtmls .="<td style=' text-align:center;'><input id='check".$pID."'  type='checkbox' /></td>";
        $strHtmls .="<td style=' text-align:left;'>".$pID."</td>";
        $strHtmls .="<td style=' text-align:left;'>".$rs->Fields["UserName"]->value."</td>";
        $strHtmls .="<td style=' text-align:left;'>".$rs->Fields["DeptName"]->value."</td>";

        $strHtmls .="<td style=' text-align:left;'>��".sprintf("%.2f", $rs->Fields["SalTotal"]->value)."</td>";
		$strHtmls .="<td style=' text-align:left;'>��".sprintf("%.2f",$rs->Fields["SalDeduct"]->value)."</td>";
		$strHtmls .="<td style=' text-align:left;'>��".sprintf("%.2f",$rs->Fields["SalCount"]->value)."</td>";
		$strHtmls .="<td style=' text-align:center;'>".$rs->Fields["DataTime"]->value."</td>";
		$strHtmls .="<td style=' text-align:center;'><a href='View.php?ID=".$pID."' target='_blank'>�鿴</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='Openfile.php?ID=".$pID."' target='_blank'>�༭</a></td>";
		$strHtmls .="</tr>";
		
		$rs->MoveNext();
	}

	if (!$flg) {
		$strHtmls .="<tr>\r\n";
		$strHtmls .="<td width='100%' height='100' align='center'>�Բ�����ʱû�п��Բ��������ݡ�\r\n";
		$strHtmls .="</td></tr>\r\n";
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>��̬���ɹ�����</title>

		<script type="text/javascript">
        function getID() {
            var ids = "";
            for (var i = 1; i < 11; i++) {
                if (document.getElementById("check" + i.toString()).checked) {
                    ids += i.toString() + ",";
                }
            }
            
            if (ids == "")
                alert("����ѡ��Ҫ���ɹ������ļ�¼");
            else
                location.href = "Compose.php?ids=" + ids.substr(0, ids.length - 1);
        }

    </script>

	</head>
	<body>
		<div style="text-align: center;">
			<p style="color: Red; font-size: 14px;">
				1.���Ե�������������еġ��༭�����༭����Ա���Ĺ�����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br />
				2.���Ե�������������еġ��鿴�����鿴����Ա���Ĺ�����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br />
				3.��ѡ��������ʼ�¼���㡰���ɹ���������ť�����ɹ�����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
			<table	style="width: 60%; font-size: 12px; text-align: center; border: solid 1px #a2c5d9;">
				<tr style='height:40px; text-indent:10px; padding:0; border-right:1px solid #a2c5d9; border-bottom:1px solid #a2c5d9; color:#666;'>
					<td></td><td style="text-align:center;">Ա�����</td><td style="text-align:center;">Ա������</td><td style="text-align:center;">��������</td><td style="text-align:center;">Ӧ������</td><td style="text-align:center;">�۳����</td><td style="text-align:center;">ʵ������</td><td style="text-align:center;">����ʱ��</td><td style="text-align:center;">����</td>
				</tr>
				<?php echo $strHtmls;?>
			</table>
			<br />
			<input type="button" value="���ɹ�����" onclick="getID()" />
		</div>
	</body>
</html>
