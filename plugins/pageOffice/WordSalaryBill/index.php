<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo_salary.mdb");
	$conn->Open($connstr);  
   
	$query = "select * from Salary  order by ID";
	$rs = $conn->Execute($query);  
	
	$flg = false;//标识是否有数据
	$strHtmls = "";
	while (!$rs->EOF) {
		$flg = true;
		$pID = $rs->Fields["ID"]->value;
		$strHtmls .="<tr  style='height:40px; text-indent:10px; padding:0; border-right:1px solid #a2c5d9; border-bottom:1px solid #a2c5d9; color:#666;'>";
		$strHtmls .="<td style=' text-align:center;'><input id='check".$pID."'  type='checkbox' /></td>";
        $strHtmls .="<td style=' text-align:left;'>".$pID."</td>";
        $strHtmls .="<td style=' text-align:left;'>".$rs->Fields["UserName"]->value."</td>";
        $strHtmls .="<td style=' text-align:left;'>".$rs->Fields["DeptName"]->value."</td>";

        $strHtmls .="<td style=' text-align:left;'>￥".sprintf("%.2f", $rs->Fields["SalTotal"]->value)."</td>";
		$strHtmls .="<td style=' text-align:left;'>￥".sprintf("%.2f",$rs->Fields["SalDeduct"]->value)."</td>";
		$strHtmls .="<td style=' text-align:left;'>￥".sprintf("%.2f",$rs->Fields["SalCount"]->value)."</td>";
		$strHtmls .="<td style=' text-align:center;'>".$rs->Fields["DataTime"]->value."</td>";
		$strHtmls .="<td style=' text-align:center;'><a href='View.php?ID=".$pID."' target='_blank'>查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='Openfile.php?ID=".$pID."' target='_blank'>编辑</a></td>";
		$strHtmls .="</tr>";
		
		$rs->MoveNext();
	}

	if (!$flg) {
		$strHtmls .="<tr>\r\n";
		$strHtmls .="<td width='100%' height='100' align='center'>对不起，暂时没有可以操作的数据。\r\n";
		$strHtmls .="</td></tr>\r\n";
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>动态生成工资条</title>

		<script type="text/javascript">
        function getID() {
            var ids = "";
            for (var i = 1; i < 11; i++) {
                if (document.getElementById("check" + i.toString()).checked) {
                    ids += i.toString() + ",";
                }
            }
            
            if (ids == "")
                alert("请先选择要生成工资条的记录");
            else
                location.href = "Compose.php?ids=" + ids.substr(0, ids.length - 1);
        }

    </script>

	</head>
	<body>
		<div style="text-align: center;">
			<p style="color: Red; font-size: 14px;">
				1.可以点击“操作”栏中的“编辑”来编辑各个员工的工作条&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br />
				2.可以点击“操作”栏中的“查看”来查看各个员工的工作条&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br />
				3.可选择多条工资记录，点“生成工资条”按钮，生成工资条&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</p>
			<table	style="width: 60%; font-size: 12px; text-align: center; border: solid 1px #a2c5d9;">
				<tr style='height:40px; text-indent:10px; padding:0; border-right:1px solid #a2c5d9; border-bottom:1px solid #a2c5d9; color:#666;'>
					<td></td><td style="text-align:center;">员工编号</td><td style="text-align:center;">员工姓名</td><td style="text-align:center;">所属部门</td><td style="text-align:center;">应发工资</td><td style="text-align:center;">扣除金额</td><td style="text-align:center;">实发工资</td><td style="text-align:center;">发放时间</td><td style="text-align:center;">操作</td>
				</tr>
				<?php echo $strHtmls;?>
			</table>
			<br />
			<input type="button" value="生成工资条" onclick="getID()" />
		</div>
	</body>
</html>
