<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if( !isset($userName) || empty($userName) || strlen(trim($userName))==0){
		header("Location:login.php?tz=true");
	}
	//ɾ��
	$id = $_REQUEST["ID"];
    if(isset($id) && !empty($id) && strlen(trim($id))>0){
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);	   
		$query = "delete from OrderMaster where ID=".$id;
		$result = $conn->Execute($query); 
		if($result>0){
			$conn->Execute("delete from OrderDetail where OrderID=".$id); 
			echo "<script>alert('ɾ���ɹ���');location.href='OrderList.php'</script>";
		}else{
			echo "<script>alert('ɾ��ʧ�ܣ�');</script>";
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
    <title>��¼�б�</title>

    <script type="text/javascript">
        function Delete(id) {
            if (confirm("��ȷ��Ҫɾ���ÿͻ���Ϣ������ض�����Ϣ��")) {
                location.href = "OrderList.php?ID=" + id;
                return true;
            }
            else {
                return false;
            }
        }
    </script>

</head>
<body>
    <!--header-->
    <div class="zz-headBox clearfix">
        <div class="zz-head mc">
            <!--logo-->
            <div class="logo fl">
                <a href="home.html">
                    <img src="images/logo.png" alt="" /></a></div>
            <!--logo end-->
            <ul class="head-rightUl fr">
                <li><a href="http://www.zhuozhengsoft.com" target="_blank">׿����վ</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">�ͻ��ʰ�</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">��ϵ����</a></li>
            </ul>
        </div>
    </div>
    <!--header end-->
    <!--a title-->
    <div class=" topTitle">
        <ul>
            <li class="pd-left">���۶�������ϵͳʾ��</li>
            <li><font>��ǰ�û���</font><?php echo $userName;?></li>
            <li><font>��ǰϵͳ���ڣ�</font><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d h:i:sa");?></li>
            <li><font>��ǰģ�飺</font>�����б�</li>
        </ul>
    </div>
    <!--content-->
    <div class="zz-content mc clearfix pd-28">
        <!--left-->
        <div class="zz-contentLeft fl">
            <ul class="left-ul">
                <h2 class="fs-12">
                    �û�������</h2>
                <li style="background: #d0eaf7; display: block;"><a href="OrderList.php">�����б�</a></li>
                <li><a href="NewOrder.php">�½�����</a></li>
                <li><a href="OrderStat.php">ͳ��ͼ��</a></li>
                <li><a href="OrderStat2.php">��ѯ��</a></li>
                <li class="bo-n"><a href="logout.php">�˳�ϵͳ</a></li>
            </ul>
        </div>
        <div class="zz-contentRight fl">
            <!--�������-->
            <table class="zz-talbe">
                <thead>
                    <tr>
                        <th class="text-cent" style="width: 15%">
                            �������
                        </th>
                        <th class="text-cent" style="width: 11%">
                            ����
                        </th>
                        <th class="text-cent">
                            �ͻ�����
                        </th>
                        <th class="text-cent" style="width: 9%">
                            ҵ��Ա
                        </th>
                        <th class="text-cent" style="width: 12%">
                            �������
                        </th>
                        <th class="text-cent" style="width: 26%">
                            ����
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                <?php
					$conn = new com("ADODB.Connection");
					$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
					$conn->Open($connstr);	   
					$query = "select * from OrderMaster order by id desc";
					$rs = $conn->Execute($query); 
					while(!$rs->EOF){	
				?>				
                <td><?php echo $rs->Fields["OrderNum"]->value;?></td>
                <?php
					$orderdate = $rs->Fields["OrderDate"]->value;
                	if (isset($orderdate) && !empty($orderdate) && strlen(trim($orderdate))>0){
					//�������ڸ�ʽ
                ?>
                    <td><?php date_default_timezone_set("Asia/Shanghai"); echo date( "Y-m-d", strtotime($orderdate)); ?></td>
                <?php
					}
					else
					{
                ?>
                    <td>&nbsp;</td>
                <?php
					}
                ?>
                <td><?php echo $rs->Fields["CustName"]->value;?></td>
                <td><?php echo $rs->Fields["SalesName"]->value;?></td>
                <?php
					$amount = $rs->Fields["Amount"]->value;
					if(isset($amount) && !empty($amount) && strlen(trim($amount))>0){
                ?>
                 	<td><?php echo "��".sprintf("%.2f", $amount);?></td>
				<?php
					}else{
				?>
				<td>&nbsp;</td>
				<?php
				}
                ?>
                <td>
                <div class='ul-page'>
                <?php
					$mid=$rs->Fields["ID"]->value;
                ?>
                <a href="OpenOrder.php?ID=<?php echo $mid;?>">�޸�</a>|<a href="ViewOrder.php?ID=<?php echo $mid;?>">ֻ���鿴^��ӡ</a>|<a  onclick="Delete(<?php echo $mid;?>)" >ɾ��</a>
                </div>
                </td>
  
                 </tr>
                 <?php
						$rs -> MoveNext();
					}

                ?>
                </tbody>
            </table>
        </div>
        <!--������-->
    </div>
    <!--content end-->
    <!--footer-->
    <div class="login-footer clearfix">
        Copyright copy 2012 ����׿��־Զ������޹�˾</div>
    <!--footer end-->
</body>
</html>
