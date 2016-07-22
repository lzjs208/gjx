<?php
	$errMsg="";//错误信息
	$id = $_REQUEST["ID"];
	session_start();
	$userName = $_SESSION['UserName'];
	if (!isset($userName) || empty($userName) || strlen(trim($userName))==0) {
		header("Location:login.php?tz=true");
	}else{
		//******************************卓正PageOffice组件的使用*******************************	
		$ip = GetHostByName($_SERVER['SERVER_NAME']);//获取本机IP
		require_once("http://".$ip.":8080/JavaBridge/java/Java.inc");//此行必须
		$PageOfficeCtrl = new Java("com.zhuozhengsoft.pageoffice.PageOfficeCtrlPHP");//此行必须
		$PageOfficeCtrl->setServerPage("http://".$ip.":8080/JavaBridge/poserver.zz");//此行必须，设置服务器页面
		
		java_set_file_encoding("GBK");//设置中文编码，若涉及到中文必须设置中文编码
		$workBook = new Java("com.zhuozhengsoft.pageoffice.excelreader.WorkbookPHP");
		$workBook->load(file_get_contents("php://input"));
		//定义Sheet对象，"Sheet1"是打开的Excel表单的名称
		$sheet = $workBook->openSheet("销售订单");
		
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);
		$sql="";
		//客户信息
		$orderNum = java_values($sheet->openCell("OrderNum")->getValue());
		$custName = java_values($sheet->openCell("CustName")->getValue());
		$district = java_values($sheet->openCell("CustDistrict")->getValue());
		$salesName = java_values($sheet->openCell("SalesName")->getValue());
		$date = java_values($sheet->openCell("OrderDate")->getValue());
		$amount = java_values($sheet->openCell("Amount")->getValue());
		if(strlen($custName)<=0)
			$errMsg.="请输入客户名称！";
		else{
			if(isset($id) && !empty($id) && strlen(trim($id))>0){
				//更新客户信息
				$sql= "Update OrderMaster set orderNum = '" . $orderNum . "',MakerName = '" . $userName
					. "',CustName='" . $custName . "',CustDistrict='" . $district . "',SalesName = '" . $salesName 
					. "' ,Amount= " . $amount . " where ID = ".$id;
			}else{
				//添加客户信息
				$maxId = 0;//OrderMaster表中最大ID号
				$sql = "select max(ID) as maxID from OrderMaster ";
				$rs = $conn->Execute($sql);
				if(!$rs->EOF){
					$maxId= (int)($rs->Fields(0)->value);
					$sql = "Insert into OrderMaster values(" . (int)($maxId + 1) . ",'" . $orderNum . "'," . $date . ",'" 
					. $custName . "','" . $district . "','" . $userName . "','" . $salesName . "'," . $amount . ")";
					$id = (int)($maxId + 1);
				}
				else{
					$errMsg.="添加客户信息失败！";
				}
			}
			//保存客户信息
			$result = $conn->Execute($sql); 
			if($result>0){
				$table=$sheet->openTable("OrderDetail");
				$sql = "select * from OrderDetail where OrderID = ".$id; 
				echo "select * from OrderDetail where OrderID = ".$id; 
				$rs = $conn->Execute($sql);
				if(!$rs->EOF){
					//删除该客户的相应订单信息
					$sql="Delete from OrderDetail where OrderID = ".$id;
					if($conn->Execute($sql)<=0){
						$errMsg.="删除客户相应的订单信息失败！";
					}	
				}
				//提交的table中有数据时,根据客户的ID将订单信息插入数据库
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
						}else {
							//提交的数据不为空
							$sql = "insert into OrderDetail(OrderID, ProductCode, ProductName, ProductType, Unit, Quantity, Price) values(" . $id;
							$qua=0;
							$strQua=trim(java_values($table->getDataFields()->get(4)->getValue()));//数量  
							//判断是否为数字
							if( is_numeric($strQua)){
								$qua=$strQua;
							}else{
								$errMsg.="请输入正确的数量值（需为整数数字）！";
							}
								   
							$price=0.00;
							$strPrice= trim(java_values($table->getDataFields()->get(5)->getValue()));//单价
							if( is_numeric($strPrice)){
								$price=$strPrice;
							}else{
								$errMsg.="请输入正确的单价（需为数字）！";
							}
							$sql.=",'" . java_values($table->getDataFields()->get(0)->getValue()) . "','" . trim(java_values($table->getDataFields()->get(1)->getValue())) . "','" .
								trim(java_values($table->getDataFields()->get(2)->getValue())) . "','" . trim(java_values($table->getDataFields()->get(3)->getValue())) . "'," .
								$qua . ",'" . $price . "')";
							if($conn->Execute($sql)<=0)
								$errMsg.="相应客户的订单信息更新失败！";
						}
					}
					
					//循环进入下一行
					$table->nextRow();		
				}				
			}else{
				$errMsg.="客户信息保存失败！";
			}   
		}	


							
		//保存失败
		if(strlen($errMsg)>0){
			$workBook->showPage(800,800);//显示错误信息提示框
			$workBook->setCustomSaveResult("error");//返回操作结果
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
            [提示标题：这是一个开发人员可自定义的对话框]</div>
        <div class="errTxtArea" style="height: 150px; text-align: left">
            <b class="txt_title">
                <div style="color: #FF0000;">
                    错误信息如下：
                    <?php echo $errMsg;?>
                </div>
                
            </b>
        </div>
        <div class="errBtmArea">
            <input type="button" class="btnFn" value=" 关闭 " onclick="window.opener=null;window.open('','_self');window.close();" /></div>
    </div>
    </form>
</body>
</html>

