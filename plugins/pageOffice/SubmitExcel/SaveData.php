<?php
	$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
	require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б��� 
	java_set_file_encoding("GBK");

    $workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
    $workBook->load(file_get_contents("php://input"));
    $sheet = $workBook->openSheet("Sheet1");
	$table = $sheet->openTable("Info");
	$content = "";
	$flg = true;
	while ($flg) {
		$temp = java_values($table->getEOF());//java_values($param)�������У�$param�Ĳ���ֵΪtrueʱ������ֵΪ1��$paramΪ falseʱ������ֵΪ�գ�ʲô��������
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
				//echo "�ύ������Ϊ��";
			}else {
				//�ύ�����ݲ�Ϊ��
				//echo "�ύ�����ݲ�Ϊ��";
				$content .= "<br/>�·����ƣ�".$table->getDataFields()->get(0)->getText();
				$content .= "<br/>�ƻ��������".$table->getDataFields()->get(1)->getText();
				$content .= "<br/>ʵ���������".$table->getDataFields()->get(2)->getText();
				$content .= "<br/>�ۼ��������".$table->getDataFields()->get(3)->getText();
				$temp = $table->getDataFields()->get(2)->getText();
				if ( !isset($temp) || strlen(trim($temp))==0) {
					$content .= "<br/>����ʣ�0%";
				} else {
					$f2 = java_values($table->getDataFields()->get(2)->getText());
					$f1 = java_values($table->getDataFields()->get(1)->getText());
					//echo "f2=".$f2;
					//echo "f1=".$f1."<br/>";
					$content .= "<br/>����ʣ�".round( $f2 / $f1 * 100 , 2) . "��";
				}
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