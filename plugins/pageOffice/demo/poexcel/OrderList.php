<?php
	session_start();
	$userName = $_SESSION['UserName'];
	if( !isset($userName) || empty($userName) || strlen(trim($userName))==0){
		header("Location:login.php?tz=true");
	}
	//删除
	$id = $_REQUEST["ID"];
    if(isset($id) && !empty($id) && strlen(trim($id))>0){
		$conn = new com("ADODB.Connection");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=". realpath("demodata/demo.mdb");
		$conn->Open($connstr);	   
		$query = "delete from OrderMaster where ID=".$id;
		$result = $conn->Execute($query); 
		if($result>0){
			$conn->Execute("delete from OrderDetail where OrderID=".$id); 
			echo "<script>alert('删除成功！');location.href='OrderList.php'</script>";
		}else{
			echo "<script>alert('删除失败！');</script>";
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
    <title>登录列表</title>

    <script type="text/javascript">
        function Delete(id) {
            if (confirm("你确认要删除该客户信息及其相关订单信息吗？")) {
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
                <li><a href="http://www.zhuozhengsoft.com" target="_blank">卓正网站</a></li>
                <li><a href="http://www.zhuozhengsoft.com/poask/index.asp" target="_blank">客户问吧</a></li>
                <li class="bor-0"><a href="http://www.zhuozhengsoft.com/contact-us.html" target="_blank">联系我们</a></li>
            </ul>
        </div>
    </div>
    <!--header end-->
    <!--a title-->
    <div class=" topTitle">
        <ul>
            <li class="pd-left">销售订单管理系统示例</li>
            <li><font>当前用户：</font><?php echo $userName;?></li>
            <li><font>当前系统日期：</font><?php date_default_timezone_set("Asia/Shanghai"); echo date("Y-m-d h:i:sa");?></li>
            <li><font>当前模块：</font>订单列表</li>
        </ul>
    </div>
    <!--content-->
    <div class="zz-content mc clearfix pd-28">
        <!--left-->
        <div class="zz-contentLeft fl">
            <ul class="left-ul">
                <h2 class="fs-12">
                    用户功能区</h2>
                <li style="background: #d0eaf7; display: block;"><a href="OrderList.php">订单列表</a></li>
                <li><a href="NewOrder.php">新建订单</a></li>
                <li><a href="OrderStat.php">统计图表</a></li>
                <li><a href="OrderStat2.php">查询表</a></li>
                <li class="bo-n"><a href="logout.php">退出系统</a></li>
            </ul>
        </div>
        <div class="zz-contentRight fl">
            <!--表格内容-->
            <table class="zz-talbe">
                <thead>
                    <tr>
                        <th class="text-cent" style="width: 15%">
                            订单编号
                        </th>
                        <th class="text-cent" style="width: 11%">
                            日期
                        </th>
                        <th class="text-cent">
                            客户名称
                        </th>
                        <th class="text-cent" style="width: 9%">
                            业务员
                        </th>
                        <th class="text-cent" style="width: 12%">
                            订单金额
                        </th>
                        <th class="text-cent" style="width: 26%">
                            操作
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
					//设置日期格式
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
                 	<td><?php echo "￥".sprintf("%.2f", $amount);?></td>
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
                <a href="OpenOrder.php?ID=<?php echo $mid;?>">修改</a>|<a href="ViewOrder.php?ID=<?php echo $mid;?>">只读查看^打印</a>|<a  onclick="Delete(<?php echo $mid;?>)" >删除</a>
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
        <!--内容区-->
    </div>
    <!--content end-->
    <!--footer-->
    <div class="login-footer clearfix">
        Copyright copy 2012 北京卓正志远软件有限公司</div>
    <!--footer end-->
</body>
</html>
