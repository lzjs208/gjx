<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	
	$table = $sheet->openTable("B4:D8");
	$content = "";
	$result = 0;
	$flg = true;
	while ($flg) {
		$temp = java_values($table->getEOF());
		if($temp == 1){
			//���ύ����
			$flg = false;
			//echo "1111111";
		}else{
			//���ύ����
			$flg = true;
			//echo "000000";
			//��ȡ�ύ����ֵ
			if(java_values($table->getDataFields()->getIsEmpty()) == 1){
				//�ύ������Ϊ��
			}else {
				//�ύ�����ݲ�Ϊ��
				$content .= "<br/>�·����ƣ�".$table->getDataFields()->get(0)->getText();
				$content .= "<br/>�ƻ��������".$table->getDataFields()->get(1)->getText();
				$content .= "<br/>ʵ���������".$table->getDataFields()->get(2)->getText();
				$content .= "<br/>*********************************************";
			}
		}
		
		//ѭ��������һ��
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
					[��ʾ���⣺����һ��������Ա���Զ���ĶԻ���]
				</div>
				<div class="errTxtArea" style="height: 88%; text-align: left">
					<b class="txt_title">
						<div style=" color:#FF0000;" >
							�ύ����Ϣ���£�
						</div> <?php echo $content;?> </b>
				</div>
				<div class="errBtmArea" style="text-align: center;">
					<input type="button" class="btnFn" value=" �ر� "
						onclick="window.opener=null;window.open('','_self');window.close();" />
				</div>
			</div>
		</form>
	</body>
</html>