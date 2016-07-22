<?php
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);	   
	$query = "select * from leaveRecord order by ID DESC";
	$rs = $conn->Execute($query); 
	
	$id = "";
	$strGrid = "";
	while (!$rs->EOF) {
		$id = $rs->Fields["ID"]->value;
		$strGrid .= "<tr onmouseover='onColor(this)' onmouseout='offColor(this)' class='XYDataGrid1-table-data-tr'>\r\n";
		$strGrid .= "<td width='7%' height='16' bgcolor='' class='XYDataGrid1-data-cell'><div align='center'><image src='images/word.gif' border='0'></image></div></td>\r\n";
		$strGrid .= "<td width='28%' height='16' bgcolor='' class='XYDataGrid1-data-cell'><div align='left'>" . $rs->Fields["Subject"]->value . "</div></td>\r\n";
		$strGrid .= "<td width='20%' height='16' bgcolor='' class='XYDataGrid1-data-cell'><div align='center'><font face='宋体'>" . $rs->Fields["SubmitTime"]->value . "</font></div></td>\r\n";
		$strGrid .= "<td width='45%' height='16' bgcolor='' class='XYDataGrid1-data-cell'><div align='center'>\r\n";
		$strGrid .= "<a class=OPLink href=\"javascript:openDataList('datalist.php','" . $id . "');\")>数据库中字段内容</a>&nbsp;\r\n";
		$strGrid .= "<a class=OPLink href=\"javascript:SetLinkUrl2('SubmitDataOfDoc.php','" . $id . "');\">用户填写请假条</a>&nbsp;\r\n";
		$strGrid .= "<a class=OPLink href=\"javascript:SetLinkUrl('GenDoc.php','" . $id . "');\">动态生成格式文档</a>&nbsp;\r\n";
		$strGrid .= "</div></td></tr>\r\n";
		
		$rs->MoveNext();
	}
	if (strlen($strGrid) <= 0) {
		$strGrid .= "<tr class='XYDataGrid1-table-data-tr'>\r\n";
		$strGrid .= "<td colspan=4 width='100%' height='100' class='XYDataGrid1-data-cell' align='center'>对不起，暂时没有可以操作的文档。\r\n";
		$strGrid .= "</td></tr>\r\n";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<link rel="stylesheet" href="css/style.css" type="text/css"></link>
		<link href="images/csstg.css" type="text/css" rel="stylesheet" />
		<!--[if lte IE 6]>
<script type="text/javascript" src="js/belatedPNG.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png_bg,.png_bg a:hover,img,li');
</script>
<![endif]-->
		<title>在线演示示例</title>
	</head>
	<body>
		<script type="text/javascript">
			function onColor(td) {
				td.style.backgroundColor = '#D7FFEE';
			}
			function offColor(td) {
				td.style.backgroundColor = '';
			}
			function SetLinkUrl(svrpage, fileid) {
				//location.href = svrpage+'?ID='+fileid;
				window.open(svrpage + '?ID=' + fileid);
			}
			function SetLinkUrl2(svrpage, fileid) {
				location.href = svrpage + '?ID=' + fileid;
				//window.open(svrpage+'?ID='+fileid);
			}
			function openDataList(svrpage, fileid) {
				window.open(
				svrpage + '?ID=' + fileid,"","fullscreen=0,toolbar=0,location=1,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width="
				+ 500 + ",height=" + 320 + " ,top=200,left=100",true);
		
			}
</script>
		<!--header-->
		<div class="zz-headBox br-5 clearfix">
			<div class="zz-head mc">
				<!--logo-->
				<div class="logo fl">
					<a href="#"><img src="images/logo.png" alt="" /> </a>
				</div>
				<!--logo end-->
				<ul class="head-rightUl fr">
					<li><a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a></li>
				</ul>
			</div>
		</div>
		<!--header end-->
		<form name="form1" id="form1" action="DocList.jsp" method="post">
			<input id="FileSubject" name="FileSubject" type="hidden" />
			<input id="TemplateName" name="TemplateName" type="hidden" />
		</form>
		<div id="content">

			<div style="margin: 25px 0; font-size: 20px; font-weight: bold;">
				PageOffice 使用模板生成文件
			</div>
			<div id="textcontent">
				<p>
					<strong>演示说明: </strong>
				</p>
				<div class="flow1">
					此示例演示：读取数据库中的数据填充模板文件，动态生成文件的效果。
				</div>
				<div class="flow1">
					<ul style="margin-left: 0;">
						<li>
							提示1：正确运行本演示前，您首先要确定您的机器上已安装MS Word。
						</li>

					</ul>
				</div>
				<div class="flow5">
					<img src="images/img_f_34.gif" />
					
				</div>
			</div>
			<div class="flow1">
				<table class="zz-talbe" style="width: 98%;">
					<caption style="font-size: 12px;">
						请假条列表
					</caption>
					<thead>
						<tr>
							<th width="50">
								类型
							</th>
							<th width="370">
								文档名称
							</th>
							<th width="80">
								创建日期
							</th>
							<th width="200">
								操作
							</th>
						</tr>
					</thead>

					<tbody>
						<?php echo $strGrid;?>
					</tbody>
				</table>
			</div>
		</div>
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright copy 2013 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
