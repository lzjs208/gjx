<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	$content = "";
	$content = $content."testA1：".$sheet->openCellByDefinedName("testA1")->getValue()."<br/>";
    $content = $content."testB1：".$sheet->openCellByDefinedName("testB1")->getValue()."<br/>";
	
    $workBook->showPage(500, 400);
    echo $workBook->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form id="form1">
			<div style="border: solid 1px gray;">
				<div class="errTopArea"
					style="text-align: left; border-bottom: solid 1px gray;">
					[提示标题：这是一个开发人员可自定义的对话框]
				</div>
				<div class="errTxtArea" style="height: 88%; text-align: left">
					<b class="txt_title">
						<div style=" color:#FF0000;" >
							提交的信息如下：
						</div> <?php echo $content;?> </b>
				</div>
				<div class="errBtmArea" style="text-align: center;">
					<input type="button" class="btnFn" value=" 关闭 "
						onclick="window.opener=null;window.open('','_self');window.close();" />
				</div>
			</div>
		</form>
	</body>
</html>