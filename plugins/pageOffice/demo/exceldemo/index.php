<?php
$action = $_REQUEST["action"];
if ( isset($action) && !empty($action) && strlen(trim($action))>0) {
	$conn = new com("ADODB.Connection");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
	$conn->Open($connstr);  
   
	$query = "select Max(ID) from excel";
	$rs = $conn->Execute($query);  

	$newID = 1;
	if (!$rs->EOF) {
		$newID = (int)($rs->Fields(0)->value) + 1;
	}

	$fileName = "bbcc" . $newID . ".xls";
	$FileSubject = "请输入文档主题";
	$getFile = $_REQUEST["FileSubject"];
	if (isset($getFile) && !empty($getFile) && strlen(trim($getFile))>0)
		$FileSubject = $getFile;
	$strsql = "Insert into excel(ID,FileName,Subject,SubmitTime) values("
			. $newID . ",'" . $fileName . "','" . $FileSubject . "','" . date("Y-m-d h:i:sa") . "')";
	$result = $conn->Execute($strsql);  
    //操作执行成功
	if($result){ 
		//拷贝文件
		$filepath=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
		$oldPath = $filepath."\\doc\\".$_REQUEST["TemplateName"];
		$newPath = $filepath."\\doc\\".$fileName;
		
		copy($oldPath, $newPath);
		header("Location:excel.php?id=".$newID);
	}
	else{
		echo "保存失败"; 
	}
}
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
	function openHtml(filename) {
		window.open("doc/" + filename);
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
					<li>
						<a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a>
					</li>
					<li>
						<a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a>
					</li>
					<li class="bor-0">
						<a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a>
					</li>
				</ul>
			</div>
		</div>
		<!--header end-->


		<!--content-->
		<div class="zz-content mc clearfix pd-28">
			<div class="demo mc">
				<h2 class="fs-16">
					PageOffice组件 在Excel在线编辑中的应用
				</h2>
				<h3 class="fs-12">
					演示说明:
				</h3>

				<p>
					提示1：正确运行本演示前，您首先要确定您的机器上已安装Microsoft Office。
				</p>
				<p>
					提示2：如果您是第一次使用PageOffice，在打开文件的时候会提示安装控件，请点允许安装。
				</p>
			</div>
			<div class="demo mc">
				<h3 class="fs-12">
					新建文件
				</h3>
				<form name="form1" id="form1" action="index.php?action=copy" method="post">
					<table class="text" cellSpacing="0" cellPadding="0" border="0">
						<tr>
							<td style="font-size: 9pt" align="left">
								<select name="TemplateName">
									<option value='redhead00.xls'>
										------不使用模板------
									</option>
									<option value='redhead01.xls' selected>
										公司销售情况月报模板
									</option>
								</select>
							</td>
							<td align="center">
								<input name="FileSubject" type="text" class="boder"
									style="width: 180px;" value="请输入文档主题" />
							</td>
							<td width="221">
								&nbsp;
								<input type="image" name="ImageButton1" id="ImageButton1"
									src="images/newword.gif" alt="" border="0" />
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="zz-talbeBox mc">
				<h2 class="fs-12">
					文档列表
				</h2>
				<table class="zz-talbe">
					<thead>
						<tr>
							<th width="7%">
								类型
							</th>
							<th width="32%">
								文档名称
							</th>
							<th width="19%">
								创建日期
							</th>
							<th width="30%">
								操作模式
							</th>
							<th width="8%">
								&nbsp;
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$conn = new com("ADODB.Connection");
							$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
							$conn->Open($connstr);  
						   
							$query = "select * from  excel order by ID DESC";
							$rs = $conn->Execute($query);  

							while (!$rs->EOF) {
								$str0 = $rs->Fields(0)->value;
								if (isset($str0) && !empty($str0) && strlen(trim($str0))>0) {
						?>
						<tr onmouseover='onColor(this);' onmouseout='offColor(this);'>
							<td>
								<img src='images/office-2.jpg' />
							</td>
							<td><?php echo $rs->Fields(2)->value;?></td>
							<?php
								//显示时间
								$str3 = $rs->Fields(3)->value;
								if (isset($str3) && !empty($str3) && strlen(trim($str3))>0) {
							?>
							<td><?php echo $str3;?></td>
							<?php
								} else {
							?>
							<td>
								&nbsp;
							</td>
							<?php
								}		
							?>
							<td>
								<a href='excel.php?id=<?php echo $str0;?>'>在线编辑</a> <a href='excel2.php?id=<?php echo $str0;?>'>只读打开</a>
							</td>
							<?php
								}
							?>
							<td>
								&nbsp;
							</td>
						</tr>
						<?php
								$rs->MoveNext();
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!--content end-->
		<!--footer-->
		<div class="login-footer clearfix">
			Copyright copy 2013 北京卓正志远软件有限公司
		</div>
		<!--footer end-->
	</body>
</html>
