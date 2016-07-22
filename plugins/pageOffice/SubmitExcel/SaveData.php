<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须 
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	$table = $sheet->openTable("Info");
	$content = "";
	$flg = true;
	while ($flg) {
		$temp = java_values($table->getEOF());//java_values($param)，方法中，$param的参数值为true时，返回值为1，$param为 false时，返回值为空，什么都不返回
		if($temp == 1){
			//无提交数据
			$flg = false;
			//echo "1111111";
		}else{
			//有提交数据
			$flg = true;
			//echo "000000";
			//获取提交的数值
			if(java_values($table->getDataFields()->getIsEmpty()) == 1){
				//提交的数据为空
				//echo "提交的数据为空";
			}else {
				//提交的数据不为空
				//echo "提交的数据不为空";
				$content .= "<br/>月份名称：".$table->getDataFields()->get(0)->getText();
				$content .= "<br/>计划完成量：".$table->getDataFields()->get(1)->getText();
				$content .= "<br/>实际完成量：".$table->getDataFields()->get(2)->getText();
				$content .= "<br/>累计完成量：".$table->getDataFields()->get(3)->getText();
				$temp = $table->getDataFields()->get(2)->getText();
				if ( !isset($temp) || strlen(trim($temp))==0) {
					$content .= "<br/>完成率：0%";
				} else {
					$f2 = java_values($table->getDataFields()->get(2)->getText());
					$f1 = java_values($table->getDataFields()->get(1)->getText());
					//echo "f2=".$f2;
					//echo "f1=".$f1."<br/>";
					$content .= "<br/>完成率：".round( $f2 / $f1 * 100 , 2) . "％";
				}
				$content .= "<br/>*********************************************";
			}
		}
		
		//循环进入下一行
		$table->nextRow();		
	}
	$table->close();
	
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