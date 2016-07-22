<?php
	$errMsg="";//������Ϣ
	$id = $_REQUEST["ID"];
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}else{
		//******************************׿��PageOffice�����ʹ��*******************************	
		$ip = GetHostByName($_SERVER['SERVER_NAME']);//��ȡ����IP
		require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//���б���
		$PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//���б���
		$PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//���б��룬���÷�����ҳ��
		
		java_set_file_encoding("GBK");//�������ı��룬���漰�����ı����������ı���
		$workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
		$workBook->load(file_get_contents("php://input"));
		//����Sheet����"Sheet1"�Ǵ򿪵�Excel��������
		$sheet = $workBook->openSheet("���۶���");
		
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);
		$sql="";
		//�ͻ���Ϣ
		$orderNum = java_values($sheet->openCell("OrderNum")->getValue());
		$custName = java_values($sheet->openCell("CustName")->getValue());
		$district = java_values($sheet->openCell("CustDistrict")->getValue());
		$salesName = java_values($sheet->openCell("SalesName")->getValue());
		$date = java_values($sheet->openCell("OrderDate")->getValue());
		$amount = java_values($sheet->openCell("Amount")->getValue());
		if(strlen($custName)<=0)
			$errMsg.="������ͻ����ƣ�";
		else{
			if(isset($id) && !empty($id) && strlen(trim($id))>0){
				//���¿ͻ���Ϣ
				$sql= "Update OrderMaster set orderNum = '" . $orderNum . "',MakerName = '" . $userName
					. "',CustName='" . $custName . "',CustDistrict='" . $district . "',SalesName = '" . $salesName 
					. "' ,Amount= " . $amount . " where ID = ".$id;
			}else{
				//��ӿͻ���Ϣ
				$maxId = 0;//OrderMaster�������ID��
				$sql = "select max(ID) as maxID from OrderMaster ";
				$rs = $conn->Execute($sql);
				if(!$rs->EOF){
					$maxId= (int)($rs->Fields(0)->value);
					$sql = "Insert into OrderMaster values(" . (int)($maxId + 1) . ",'" . $orderNum . "'," . $date . ",'" 
					. $custName . "','" . $district . "','" . $userName . "','" . $salesName . "'," . $amount . ")";
					$id = (int)($maxId + 1);
				}
				else{
					$errMsg.="��ӿͻ���Ϣʧ�ܣ�";
				}
			}
			//����ͻ���Ϣ
			$result = $conn->Execute($sql); 
			if($result>0){
				$table=$sheet->openTable("OrderDetail");
				$sql = "select * from OrderDetail where OrderID = ".$id; 
				echo "select * from OrderDetail where OrderID = ".$id; 
				$rs = $conn->Execute($sql);
				if(!$rs->EOF){
					//ɾ���ÿͻ�����Ӧ������Ϣ
					$sql="Delete from OrderDetail where OrderID = ".$id;
					if($conn->Execute($sql)<=0){
						$errMsg.="ɾ���ͻ���Ӧ�Ķ�����Ϣʧ�ܣ�";
					}	
				}
				//�ύ��table��������ʱ,���ݿͻ���ID��������Ϣ�������ݿ�
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
						}else {
							//�ύ�����ݲ�Ϊ��
							$sql = "insert into OrderDetail(OrderID, ProductCode, ProductName, ProductType, Unit, Quantity, Price) values(" . $id;
							$qua=0;
							$strQua=trim(java_values($table->getDataFields()->get(4)->getValue()));//����  
							//�ж��Ƿ�Ϊ����
							if( is_numeric($strQua)){
								$qua=$strQua;
							}else{
								$errMsg.="��������ȷ������ֵ����Ϊ�������֣���";
							}
								   
							$price=0.00;
							$strPrice= trim(java_values($table->getDataFields()->get(5)->getValue()));//����
							if( is_numeric($strPrice)){
								$price=$strPrice;
							}else{
								$errMsg.="��������ȷ�ĵ��ۣ���Ϊ���֣���";
							}
							$sql.=",'" . java_values($table->getDataFields()->get(0)->getValue()) . "','" . trim(java_values($table->getDataFields()->get(1)->getValue())) . "','" .
								trim(java_values($table->getDataFields()->get(2)->getValue())) . "','" . trim(java_values($table->getDataFields()->get(3)->getValue())) . "'," .
								$qua . ",'" . $price . "')";
							if($conn->Execute($sql)<=0)
								$errMsg.="��Ӧ�ͻ��Ķ�����Ϣ����ʧ�ܣ�";
						}
					}
					
					//ѭ��������һ��
					$table->nextRow();		
				}				
			}else{
				$errMsg.="�ͻ���Ϣ����ʧ�ܣ�";
			}   
		}	


							
		//����ʧ��
		if(strlen($errMsg)>0){
			$workBook->showPage(800,800);//��ʾ������Ϣ��ʾ��
			$workBook->setCustomSaveResult("error");//���ز������
		}
		echo $workBook->close();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="css/error.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" action="post";>
    <div>
        <div class="errTopArea" style="text-align: left">
            [��ʾ���⣺����һ��������Ա���Զ���ĶԻ���]</div>
        <div class="errTxtArea" style="height: 150px; text-align: left">
            <b class="txt_title">
                <div style="color: #FF0000;">
                    ������Ϣ���£�
                    <?php echo $errMsg;?>
                </div>
                
            </b>
        </div>
        <div class="errBtmArea">
            <input type="button" class="btnFn" value=" �ر� " onclick="window.opener=null;window.open('','_self');window.close();" /></div>
    </div>
    </form>
</body>
</html>

